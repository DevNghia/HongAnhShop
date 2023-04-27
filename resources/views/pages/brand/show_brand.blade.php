@extends('welcome')
@section('sibar_left')
@include('pages.inc.sibar_left')
@endsection
@section('content')
<div class="features_items"><!--features_items-->
    @foreach ($brand_name as $key=>$name)
    <h2 class="title text-center">{{$name->brand_name}}</h2>
    @endforeach
    @foreach ($brand_by_id as $key=>$brand_pro)
						
							<a href="/show-detail/{{$brand_pro->product_id}}">
						<div class="col-sm-4">
						
					<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<form>
												{{ csrf_field() }}
												<input type="hidden" value="{{$brand_pro->product_id}}" class="cart_product_id_{{$brand_pro->product_id}}">
												<input type="hidden" value="{{$brand_pro->product_name}}" class="cart_product_name_{{$brand_pro->product_id}}">
												<input type="hidden" value="{{$brand_pro->product_image}}" class="cart_product_image_{{$brand_pro->product_id}}">
												<input type="hidden" value="{{$brand_pro->product_price}}" class="cart_product_price_{{$brand_pro->product_id}}">
												<input type="hidden" value="1" class="cart_product_qty_{{$brand_pro->product_id}}">
												<input name="productid_hidden" type="hidden"  value="{{$brand_pro->product_id}}" />
											<a href="/show-detail/{{$brand_pro->product_id}}">
											<img src="/uploads/product/{{$brand_pro->product_image}}" alt="" />
											<h2>{{number_format($brand_pro->product_price).' '.'VND'}}</h2>
											<p>{{$brand_pro->product_name}}</p>
											</a>
											<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><button type="button" class="btn btn-default add-to-wishlist" data-id_product="{{$brand_pro->product_id}}" name="add-to-wishlist"><i class="fa fa-heart"></i> Yêu thích</button></li>
										<li><button type="button" class="btn btn-default add-to-cart" data-id_product="{{$brand_pro->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button></li>
									</ul>
								</div>
											</form>
										</div>
										
								</div>
								{{-- <div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-heart"></i>Yêu thích</a></li>
										
									</ul>
								</div> --}}
							</div>
							
						</div>
							</a>
						@endforeach
						
			
						
						
					
@endsection