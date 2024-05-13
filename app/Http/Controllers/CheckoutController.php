<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session()->get('admin_id');
        if ($admin_id) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    public function login_checkout(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        $meta_title = "Đăng nhập|Đăng ký";
        $meta_desc = "Đăng nhập khách hàng";
        $meta_keywords = "Tên, tài khoản, mật khẩu";
        $url_canonical = $request->url();
        return view('pages.checkout.login_checkout')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));
    }
    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session()->put('customer_id', $customer_id);
        Session()->put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }
    public function checkout(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        $meta_title = "Checkout";
        $meta_desc = "Khách hàng thanh toán";
        $meta_keywords = "...";
        $url_canonical = $request->url();
        $city = City::orderby('matp', 'ASC')->get();
        if (Cart::count() == 0) {
            return Redirect::to('/show-cart');
        }
        return view('pages.checkout.checkout')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical', 'city'));
    }
    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_message'] = $request->shipping_message;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session()->put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }
    public function payment(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        $meta_title = "Thanh toán";
        $meta_desc = "Khách hàng thanh toán";
        $meta_keywords = "...";
        $url_canonical = $request->url();
        return view('pages.checkout.payment')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));
    }
    public function order_place(Request $request)
    {
        //insert payment_method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session()->get('customer_id');
        $order_data['shipping_id'] = Session()->get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //insert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {
            echo 'Thanh toán thẻ ATM';
        } elseif ($data['payment_method'] == 2) {
            $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
            $meta_title = "Order";
            $meta_desc = "Khách hàng thanh toán";
            $meta_keywords = "...";
            $url_canonical = $request->url();
            return view('pages.checkout.handcash')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));
        } else {
            echo 'Thẻ ghi nợ';
        }
    }
    public function logout_checkout()
    {
        Session()->flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session()->put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout')->with('error', 'Email hoặc mật khẩu bị sai, vui lòng nhập lại');
        }
    }
    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->select('tbl_order.*', 'tbl_customers.customer_name')
            ->orderBy('tbl_order.order_id', 'desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
    public function view_order($order_id)
    {
        $this->AuthLogin();
        $order_detail = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')->where('tbl_order.order_id', $order_id)->get();
        return view('admin.view_order')->with('order_detail', $order_detail);
    }
    public function select_delivery_home(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Province::where('matp', $data['matp'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>-Chọn quận huyện-</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['matp'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>-Chọn xã phường-</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
    public function calculate_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['city']) {
            $feeship = Feeship::where('fee_matp', $data['city'])->where('fee_maqh', $data['province'])->where('fee_xaid', $data['wards'])->get();
            if ($feeship) {
                $count_feeship = $feeship->count();
                if ($count_feeship > 0) {
                    foreach ($feeship as $key => $fee) {
                        Session()->put('fee', $fee->fee_feeship);
                        Session()->save();
                    }
                } else {
                    Session()->put('fee', 10000);
                    Session()->save();
                }
            }
        }
    }
    public function del_fee()
    {
        Session()->forget('fee');
        return redirect()->back();
    }
    public function comfirm_order(Request $request)
    {

        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_message = $data['shipping_message'];
        $shipping->shipping_method = $data['payment_select'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;
        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);
        $order = new Order();
        $order->customer_id = auth()->user()->id;
        $order->shipping_id =  $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        $order->order_total = $data['order_total'];
        $order->order_total_after = $data['order_total_after'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();
        $content = Cart::content();
        $user_id = Auth::user()->id;
        $voucher = Voucher::where('voucher_code', $data['order_voucher'])->first();
        $userVoucher = new UserVoucher();
        if (isset($voucher) && isset($userVoucher)) {
            $userVoucher->user_id = $user_id;
            $userVoucher->voucher_id = $voucher->voucher_id;
            $voucher->decrement('voucher_time');
            $userVoucher->save();
        }

        if (Session()->get('cart') == true) {

            foreach ($content as $key => $cart) {
                $product = Product::find($cart->id);
                if ($product) {
                    // Cập nhật cột quantity của sản phẩm
                    $product->quantity = $product->quantity - $cart->qty;
                    $product->save();
                    $order_detail = new Orderdetail();
                    $order_detail->order_code = $checkout_code;
                    $order_detail->product_id = $cart->id;
                    $order_detail->product_name = $cart->name;
                    $order_detail->product_price = $cart->price;
                    $order_detail->product_voucher = $data['order_voucher'];
                    $order_detail->product_fee = $data['order_fee'];
                    $order_detail->product_sales_quantity = $cart->qty;
                    $order_detail->save();
                }
            }
            // if ($data['payment_select'] == 0) {
            //     // return 'ádadsassad';
            //     // $this->vnpay_payment();
            //     return Redirect::to("https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=20000000&vnp_Command=pay&vnp_CreateDate=20240512021926&vnp_CurrCode=VND&vnp_IpAddr=127.0.0.1&vnp_Locale=vn&vnp_OrderInfo=Thanh+to%C3%A1n+%C4%91%C6%A1n+test&vnp_OrderType=billpayment&vnp_ReturnUrl=http%3A%2F%2F127.0.0.1%3A8000%2Fcheckout&vnp_TmnCode=POZV3SM0&vnp_TxnRef=bfggd&vnp_Version=2.1.0&vnp_SecureHash=f868e509871e9a97a1c880b266b148caddae9b85f4af2482087c11a8f40b949b72ecd54886cd26d7840bff571b0fa51b8e37da49a19ea633784d3283bd382e61");
            // }
        }
        Session()->forget('voucher');
        Session()->forget('fee');
        Session()->forget('cart');
    }
    public function vnpay_payment(Request $request)
    {

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/checkout";
        $vnp_TmnCode = "POZV3SM0"; //Mã website tại VNPAY 
        $vnp_HashSecret = "E086N10NOML4XM9I26BEWWH2Z1OBHU3Y"; //Chuỗi bí mật

        $vnp_TxnRef = substr(md5(microtime()), rand(0, 26), 5); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang vnpay

        $vnp_OrderInfo = "Thanh toán đơn test";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total * 100;
        $vnp_Locale = 'vn';
        // $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,


        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            // return $returnData['data'];
            // return Redirect::to($returnData['data']);

            echo json_encode($returnData);
        }
    }



    public function show_delivery()
    {
        $cart = Session()->get('fee');
        $output = '';
        $output .= '<span class="delivery">' . number_format($cart) . ' ' . 'vnđ' . '</span>';
        echo $output;
    }
}
