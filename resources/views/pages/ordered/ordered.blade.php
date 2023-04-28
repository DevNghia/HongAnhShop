@extends('welcome')

@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Sản phẩm đã mua</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
                <?php
                    $content =Cart::content();
					
                    ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td> 
							<td class="description">Tên sản phẩm</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
                            <td class="total">Trạng thái</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
							$total=0;
						@endphp
						@foreach ($productPurchasedByUser as $key=>$v_content)
							
						
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{'/uploads/product/'.$v_content->product_image}}"  width="50px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->product_name}}</a></h4>
	
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->product_price).' '.'vnđ'}}</p>
							</td>
							<td class="cart_quantity">
								<h4>{{$v_content->product_sales_quantity}}</h4>

							</td>
                          <?php
              if($v_content->order_status==0){
                ?>
                  <td class="cart_status">
								<h4>Đã xử lý</h4>          
							</td>
             <?php
              }else if($v_content->order_status==1){
              ?>  
                <td class="cart_status">
								<h4>Chưa xử lý</h4>          
							</td>
              <?php
              }elseif ($v_content->order_status==2) {
              ?>
               <td class="cart_status">
								<h4>Đang giao</h4>          
							</td>
              <?php
              }else{
              ?>
                <td class="cart_status">
								<h4>Đã Nhận</h4>          
							</td>
              <?php
              }
              ?>        
							</td>
                       

							
						</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			{{-- <div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div> --}}
			<div class="row">
				{{-- <div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div> --}}
			
			</div>
		</div>
	</section><!--/#do_action-->
    @endsection