
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$meta_desc}}">
	<meta name="keywords" content="{{$meta_keywords }}">
	<meta name="robots" content="INDEX.FOLLOW">
	<link rel="canonical" href="{{ $url_canonical}}">
    <meta name="author" content="">
	
    <title>{{$meta_title}}</title>
	<meta property="og:image" content="">
	<meta property="og:site_name" content="shop.com">
	<meta property="og:description" content="{{$meta_desc}}">
	<meta property="og:title" content="{{$meta_title}}">
	<meta property="og:url" content="{{$url_canonical}}">
	<meta property="og:type" content="website">
	{{-- <link  rel="icon" type="image/x-icon" href="https://www.thol.com.vn/pub/media/favicon/stores/5/favicon.png" /> --}}
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="https://cdn2.cellphones.com.vn/200x/media/favicon/default/logo-cps.png" >
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i>8888888888</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> honganh88@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="/trang-chu"><img src="{{asset('frontend/images/logo-shop-dien-thoai-7-removebg-preview.png')}}" width="200px" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								
								<?php
									$customer_id = Auth::check();
									if($customer_id!=NULL){
								?>
									<li><a href="/show-wishlist"><i class="fa fa-heart"></i> Yêu thích</a></li>
								
									<li><a href="/checkout"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								
								
								<li class="quanlity"><a href="/show-cart"><i class="fa fa-shopping-cart"></i> 
									
									
									Giỏ hàng</a></li>
									<li>
										
										<div class="dropdown">
						<a id="dLabel" data-target="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user"></i>{{ Auth::user()->name}}
							
						</a>

						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li><a href="/show-ordered">Lịch sử mua hàng</a></li><br>
							<li><a href="/profile">Thông tin tài khoản</a></li>
																<li>
												<form method="POST" action="{{ route('logout') }}">
													@csrf
												
										<x-responsive-nav-link :href="route('logout')"
											onclick="event.preventDefault();
														this.closest('form').submit();">
														Đăng xuất
														
										</x-responsive-nav-link>
										</form>
									</li>
						</ul>
						</div>
									</li>
									

								
								<?php
								}else{
								?>
								<li><a href="/show-wishlist"><i class="fa fa-heart"></i> Yêu thích</a></li>
								<li><a href="/checkout"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<li class="quanlity"><a href="/show-cart"><i class="fa fa-shopping-cart"></i> 
									
									
									Giỏ hàng</a></li>

									<li>
										
										<div class="dropdown">
						<a id="dLabel" data-target="#"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-lock"></i>Tài Khoản
							
						</a>

						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li><a href="/login">Đăng nhập</a></li><br>
							<li><a href="/register"> Đăng ký</a></li>
						</ul>
						</div>
									</li>
								{{-- <li><a href="/login"><i class="fa fa-lock"></i> Đăng nhập</a></li> --}}
								<?php
								}
								?>
							</ul>
								
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
		
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/trang-chu" class="active">Trang Chủ</a></li>
								<li class="dropdown"><a href="/shop">Cửa Hàng</i></a>
                                    {{-- <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.html">Login</a></li> 
                                    </ul> --}}
                                </li> 
								<li class="dropdown"><a href="/blog">Bài viết</i></a>
                                    {{-- <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul> --}}
                                </li> 
							
								<li><a href="/contact-us">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form action="/search-product" method="GET">
								@csrf
							<input type="text" name="keyword_submit" placeholder="Search" required=""/>
							<button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	@yield('cart')
	{{-- ---------------slide----------------- --}}
	@yield('slide')
	<section>
		<div class="container">
			<div class="row">
			@yield('sibar_left')
				
				<div class="col-sm-9 padding-right">
					@yield('content')
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Hỗ trợ - dịch vụ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Mua hàng trả góp</a></li>
								<li><a href="/contact-us">Tra cứu hóa đơn</a></li>
								<li><a href="#">Chính sách bảo hành</a></li>
								<li><a href="#">Chính sách bảo mật</a></li>
								<li><a href="#">Câu hỏi thường gặp</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Thông tin liên hệ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Bán hàng Online</a></li>
								<li><a href="#">Chăm sóc khách hàng</a></li>
								<li><a href="#">Hỗ trợ kỹ thuật</a></li>
								<li><a href="#">Hỗ trợ bảo hành & sửa chữa</a></li>
								<li><a href="#">Trung tâm bảo hành</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Giới thiệu công ty</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Giới thiệu công ty</a></li>
								<li><a href="#">Tuyển dụng</a></li>
								<li><a href="#">Danh sách chuỗi cửa hàng</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Tin tức</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Tin công nghệ</a></li>
								<li><a href="#">Tin mới nhất</a></li>
								<li><a href="#">Tin tìm kiếm nhiều nhất</a></li>
								<li><a href="#">Tin khuyến mãi</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Phản hồi của khách hàng</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Nhập địa chỉ email" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
{{-- <<<<<<< HEAD
					<p class="pull-left">© 2023 DevNghia. Tất cả đã được đăng ký bản quyền</p>
				
======= --}}
					<p class="pull-left">© 2023 .Tất cả đã được đăng ký bản quyền</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->

	<!-- fhsdfhgfdhs est comiii  -->

	

  
    <script src="{{asset('frontend/js/jquery.js')}}"></script>
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
	<script async defer crossorigin="anonymous" src="{{asset('https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0&appId=695872028369099&autoLogAppEvents=1')}}" nonce="j0H0MxnG"></script>
	<script src="{{asset('frontend/js/sweetalert.min.js')}}"></script>
	<script src="{{asset('frontend/js/sort.js')}}"></script>
	<script>
		$(document).ready(function(){
			count_cart();
			function count_cart(){
				$.ajax({
					url:'{{url('count-cart')}}',
					method:"GET",
					success:function(data){
						$('.quanlity').html(data);
					}
				})
			}
			$('.add-to-cart').click(function(){
				var id = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				
				$.ajax({
					url: '{{url('/save-to-cart')}}',
					method: 'POST',
					data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
					success:function(data){
						// alert(this.data);
						 swal({
title: "Đã thêm sản phẩm vào giỏ hàng",
text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
showCancelButton: true,
cancelButtonText: "Xem tiếp",
confirmButtonClass: "btn-success",
confirmButtonText: "Đi đến giỏ hàng",
closeOnConfirm: false
},
function() {
window.location.href = "{{url('/show-cart')}}";
});
count_cart();
					}
				})
			});
			
	
		});
	</script>
	<script>
		$(document).ready(function(){
			//  show_delivery()
			// function show_delivery(){
			// 	$.ajax({
			// 		url:'{{url('show-delivery')}}',
			// 		method:"GET",
			// 		success:function(data){
			// 			$('.delivery').html(data);
			// 		}
			// 	})
			// }
			$('.calculate_delivery').click(function(){
				var city = $('.city').val();
            	var province = $('.province').val();
           		var wards = $('.wards').val();
             	var _token = $('input[name="_token"]').val();
				if(city == '' || province =='' || wards ==''){
					alert('Làm ơn chọn để tính phí vận chuyển')
				}else{
             		$.ajax({
               		 url : '{{('/calculate-delivery')}}',
               		 method: 'POST',
                	 data:{city:city,province:province,wards:wards,_token:_token},
              	     success:function(data){
                    //   show_delivery()
					location.reload();
                }
            	});
				}
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$('.confirm').click(function(){
				swal({
  title: "Xác nhận đơn hàng",
  text: "Đơn hàng sẽ không được hoàn trả khi đặt, bạn có muốn đặt không?",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Cảm ơn, Mua hàng",
  cancelButtonText: "Đóng, chưa mua",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
	if (isConfirm) {
		var shipping_email = $('.shipping_email').val();
				var shipping_name= $('.shipping_name').val();
				var shipping_address = $('.shipping_address').val();
				var shipping_phone = $('.shipping_phone').val();
				var shipping_message = $('.shipping_message').val();
				var order_fee = $('.order_fee').val();
				var order_voucher = $('.order_voucher').val();
				var payment_select = $('.payment_select').val();
				var order_total = $('.order_total').val();
				var order_total_after = $('.order_total_after').val();
				var _token = $('input[name="_token"]').val();
					if (!shipping_email || !shipping_name || !shipping_address || !shipping_phone || !shipping_message ) {
						swal("Lỗi", "Vui lòng nhập đầy đủ thông tin đơn hàng", "error");
						return;
					}
				$.ajax({
               		 url : '{{('/comfirm-order')}}',
               		 method: 'POST',
                	 data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,
					shipping_message:shipping_message,order_fee:order_fee ,order_voucher:order_voucher,payment_select:payment_select,_token:_token,order_total:order_total,
					order_total_after:order_total_after
				},
              	     success:function(data){
                      swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                }
            	});
				window.setTimeout(function () {
    location.reload();
  }, 3000);
    
  } else {
    swal("Đóng","Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng","error");
  }
 
});
				
			})
		})
	</script>
	<script>
		$(document).ready(function(){
			 $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var matp = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            // alert(matp);
            // alert(_token);
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,matp:matp,_token:_token},
                success:function(data){
                    $('#' + result).html(data);
                }
            })
        })
		})
	</script>
	<script>
		$(document).ready(function(){
			// count_cart();
			// function count_cart(){
			// 	$.ajax({
			// 		url:'{{url('count-cart')}}',
			// 		method:"GET",
			// 		success:function(data){
			// 			$('.quanlity').html(data);
			// 		}
			// 	})
			// }
			$('.add-to-wishlist').click(function(){
				var id = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				
				$.ajax({
					url: '{{url('/add-to-wishlist')}}',
					method: 'POST',
					data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
					success:function(data){
						// alert(this.data);
						 swal({
title: "Đã thêm sản phẩm vào danh sách yêu thích",
text: "Bạn có thể mua hàng tiếp hoặc tới danh sách yêu thích",
showCancelButton: true,
cancelButtonText: "Xem tiếp",
confirmButtonClass: "btn-success",
confirmButtonText: "Đi đến danh sách yêu thích",
closeOnConfirm: false
},
function() {
window.location.href = "{{url('/show-wishlist')}}";
});
// count_cart();
					}
				})
			});
			
	
		});
	</script>
</body>
</html>