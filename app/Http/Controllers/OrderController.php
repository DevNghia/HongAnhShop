<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\User;
use App\Models\Voucher;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
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
	public function print_order($checkout_code)
	{
		$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));

		return $pdf->stream();
	}
	public function print_order_convert($checkout_code)
	{
		$order = Order::where('order_code', $checkout_code)->get();
		$order_details = Orderdetail::where('order_code', $checkout_code)->get();
		$order = Order::where('order_code', $checkout_code)->get();
		foreach ($order as $key => $ord) {
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id', $customer_id)->first();
		$shipping = Shipping::where('shipping_id', $shipping_id)->first();
		$output = '';

		$output .= '<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h2><center>Công ty TNHH một thành viên ABCD</center></h2>
		<h4><center>Đơn hàng</center></h4>
		
		

		<p>Ship hàng tới</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Sdt</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';

		$output .= '		
					<tr>
						<td>' . $shipping->shipping_name . '</td>
						<td>' . $shipping->shipping_address . '</td>
						<td>' . $shipping->shipping_phone . '</td>
						<td>' . $shipping->shipping_email . '</td>
						<td>' . $shipping->shipping_message . '</td>
						
					</tr>';


		$output .= '				
				</tbody>
			
		</table>

		<p>Đơn hàng đặt</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Phí ship</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';

		$total = 0;

		foreach ($order_details as $key => $product) {

			$subtotal = $product->product_price * $product->product_sales_quantity;
			$total += $subtotal;

			if ($product->product_voucher != 'no') {
				$product_voucher = $product->product_voucher;
			} else {
				$product_voucher = 'không mã';
			}

			$output .= '		
					<tr>
						<td>' . $product->product_name . '</td>
						<td>' . $product_voucher . '</td>
						<td>' . number_format($product->product_fee, 0, ',', '.') . 'đ' . '</td>
						<td>' . $product->product_sales_quantity . '</td>
						<td>' . number_format($product->product_price, 0, ',', '.') . 'đ' . '</td>
						<td>' . number_format($subtotal, 0, ',', '.') . 'đ' . '</td>
						
					</tr>';
		}
		foreach ($order as $key => $ord) {
			$output .= '<tr>
				<td colspan="2">
					<p>Tổng:' . number_format($ord->order_total, 0, ',', '.') . 'đ' .  ' </p>
					<p>Thanh toán :' . number_format($ord->order_total_after, 0, ',', '.') . 'đ' . ' </p>
				</td>
		</tr>';
		}
		$output .= '				
				</tbody>
			
		</table>

		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
						
					</tr>
				</thead>
				<tbody>';

		$output .= '				
				</tbody>
			
		</table>

		';


		return $output;
	}
	public function show_order(Request $request)
	{


		$sort_by = $request->input('sort_by');
		if ($sort_by == '0') {
			$order_sort = Order::where('order_status', '=', 0);
		} else if ($sort_by == "1") {
			$order_sort = Order::where('order_status', '=', 1);
		} else if ($sort_by == "2") {
			$order_sort = Order::where('order_status', '=', 2);
		} else if ($sort_by == "3") {
			$order_sort = Order::where('order_status', '=', 3);
		} else {
			$order_sort = Order::orderBy('order_id', 'DESC');
		}
		$order = $order_sort->get();
		return view('admin.manage_order')->with(compact('order'));
	}
	public function view_order($order_code)
	{
		$order_details = Orderdetail::where('order_code', $order_code)->get();
		$order = Order::where('order_code', $order_code)->first();

		$customer_id = $order->customer_id;
		$shipping_id = $order->shipping_id;


		// $customer = User::where('id', $customer_id)->first();
		$shipping = Shipping::where('shipping_id', $shipping_id)->first();

		return view('admin.view_order')->with(compact('order_details', 'order', 'shipping'));
	}
	public function show_ordered(Request $request)
	{
		$cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
		$brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
		$meta_title = "Lịch sử mua hàng";
		$meta_desc = "các sản phẩm trong giỏ";
		$meta_keywords = "điện thoại, laptop, sp4, xbox one";
		$url_canonical = $request->url();
		$user = Auth::user();
		$user_id = $user->id;
		$productPurchasedByUser = DB::table('tbl_order_details')
			->join('tbl_order', 'tbl_order_details.order_code', '=', 'tbl_order.order_code')
			->join('users', 'tbl_order.customer_id', '=', 'users.id')
			->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')
			->select('tbl_order_details.product_id', 'tbl_order_details.product_name', 'tbl_order_details.product_price', 'tbl_order_details.product_sales_quantity', 'tbl_product.product_image', 'tbl_order.order_status')
			->where('users.id', '=', $user_id)
			->get();

		return view('pages.ordered.ordered')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical', 'productPurchasedByUser'));
	}
	public function unactive_order($order_code)
	{
		$this->AuthLogin();
		DB::table('tbl_order')->where('order_code', $order_code)->update(['order_status' => 1]);
		Session()->put('message', 'Chưa xử lý');
		return Redirect::to('all-order');
	}
	public function active_order($order_code)
	{
		$this->AuthLogin();
		DB::table('tbl_order')->where('order_code', $order_code)->update(['order_status' => 0]);
		Session()->put('message', 'Đã xử lý');
		return Redirect::to('all-order');
	}
	public function update_order(Request $request, $order_code)
	{
		$this->AuthLogin();
		$data['order_status'] = $request->edit_order;
		DB::table('tbl_order')->where('order_code', $order_code)->update($data);
		Session()->put('message', 'Cập nhật đơn hàng thành công');
		$order_details = Orderdetail::where('order_code', $order_code)->get();
		$order = Order::where('order_code', $order_code)->first();

		$customer_id = $order->customer_id;
		$shipping_id = $order->shipping_id;


		// $customer = User::where('id', $customer_id)->first();
		$shipping = Shipping::where('shipping_id', $shipping_id)->first();
		return Redirect::to('all-order');
	}
	public function delete_order($order_code)
	{
		$order = Order::find($order_code);
		$order->delete();
		Session()->put('message', 'Xóa đơn hàng thành công!');
		return Redirect::to('all-order');
	}
}
