@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
	
							<div class="row">
								<div class="col-md-4">
								<label for="amount">Sắp xếp theo</label>
								<form action="">
								@csrf
								<select name="sort" id="sort" class="form-control">
									<option value="{{Request::url()}}?sort_by=none">--lọc--</option>
									<option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
									<option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
								</select>
								
							</form>
							</div>
							</div>
					@foreach ($category_name as $key=>$name)
						<h2 class="title text-center">{{$name->category_name}}</h2>
					@endforeach
							
							@foreach ($category_by_id as $key=>$cate_pro)
						<a href="/show-detail/{{$cate_pro->product_id}}">
						<div class="col-sm-4">
						
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="/uploads/product/{{$cate_pro->product_image}}" alt="" />
											<h2>{{number_format($cate_pro->product_price).' '.'VND'}}</h2>
											<p>{{$cate_pro->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
										</div>
										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
							
						</div>
						</a>
						
						@endforeach
						
						
						
						
					
@endsection