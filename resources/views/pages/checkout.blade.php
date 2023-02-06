@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection

@section('content')
<div class="path">
	<ul class="list_path">
		<li>Trang chủ</li>
		<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
		<li class="path_color">Thanh toán hóa đơn</li>
	</ul>
</div>
		<?php
		$content = Cart::content();
		?>
		<div class="container">
        	<div class="title_container">
            	<p>Thông tin hóa đơn</p>
        	</div>
        	<div class="container_content">
        		<form action="{{URL::to('/save-bill')}}" method="post">
        			@csrf
	        		<div class="form_bill">
	        			<div class="box_bill bill_input">
	        				<div class="infor_bill">
	        					<div class="input_box">
									<span class="details">Họ và tên</span>
									<input type="text" name="name_bill" id="" placeholder="Họ và tên" required="" value="{{$get_db_user->fullname_user}}">
								</div>
								<div class="input_box">
									<span class="details">Email</span>
									<input type="text" name="email_bill" id="" placeholder="Email" required="" value="{{$get_db_user->email_user}}">
								</div>
								<div class="input_box">
									<span class="details">Số điện thoại</span>
									<input type="text" name="phone_bill" id="" placeholder="Số điện thoại" required="" value="{{$get_db_user->phone_user}}">
								</div>
								<div class="input_box">
									<span class="details">Địa điểm giao hàng</span>
									<?php
										$message = Session::get('message');
										if ($message) {

									?>
									<div class="input-box">
										<div class="text_warning">{{$message}}</div>
									</div>
									<?php
										}
						Session::put('message', null);
					?>
									<input type="text" name="address_bill" id="" placeholder="Địa điểm giao hàng" required="" readonly value="<?php
										if($get_db_address != ''){
											echo $get_db_address->street_address.", ".$get_db_address->cwt->name_cwt.", ".$get_db_address->district->name_district.", ".$get_db_address->city->name_city;
										}else{
											echo "";
										}
									?>">
									<a href="{{URL::to('thong-tin-ca-nhan')}}" style="color: #56924C; margin-top: 5px;">
		        						Sửa thông tin giao hàng
		        					</a>
								</div>
								{{-- <div class="input_box">
									<div class="payment_select">
										<div class="payment_items payment_bank">
											
												<div class="item_button_payment">
						        					<a href="{{URL::to('thong-tin-ca-nhan')}}" class="button_link">
						        						<div class="">Sửa thông tin giao hàng</div>		
						        					</a>
					        					</div>
										</div>
									</div>
								</div> --}}

	        				</div>

	        				<div class="infor_bill">
	        					<div class="input_box">
									<span class="details">Nội dung đơn hàng</span>
									<textarea name="note_bill" placeholder="Nội dung đơn hàng"></textarea>
								</div>
								<div class="input_box">
									<span class="details">Hình thức thanh toán</span>
									<div class="payment_select">

									@if(\Session::has('success'))
										<div class="payment_items">
											<input type="radio" name="payment_bill" checked value="Đã thanh toán trực tuyến"/>Đã thanh toán trực tuyến
										</div>
									@else
									<div class="payment_items">
										<input type="radio" name="payment_bill" checked value="Thanh toán khi nhận hàng"/>Thanh toán khi nhận hàng
									</div>
									<div class="payment_items">
										<input type="radio" name="payment_bill" id="paybank" value="Thanh toán trực tuyến"/>Thanh toán trực tuyến
									</div>


									@endif



										{{-- <div class="payment_items payment_bank">
											<div class="item_payment option_payment">
												<select name="select_bank">
													<option>Nguyen Xuan Linh - Agribank</option>
													<option>Nguyen Xuan Linh - MBBank</option>
											</select>
											</div>
											<div class="item_payment payment_button">
												<button class="button_padding">Thêm ngân hàng</button>
											</div>
										</div> --}}
									</div>
								</div>
	        				</div>
	        			</div>
	        			<div class="box_bill">
	        				<div class="total_payment">
			   					<div class="box_total">
{{-- 				   					<div class="list_cost">
				   						<div>Tạm tính:</div>
				   						<div>{{Cart::pricetotal('0',',','.')}} VNĐ</div>
				   					</div> --}}
				   					<div class="list_cost">
				   						<div>Tổng:</div>
				   						<div>{{Cart::pricetotal('0',',','.')}} VNĐ</div>
				   					</div>
				   					<div class="list_cost">
				   						<div>Phí vận chuyển:</div>
				   						<div>
				   							<?php
		   							if (Session::get('id_user')) {
		   								$shipping_fee = Session::get('shipping_fee');
		   								echo number_format($shipping_fee,0,',','.')." VNĐ";
		   							}else{
		   								Session::put('shipping_fee', null);
		   								$shipping_fee = Session::get('shipping_fee');
		   								echo number_format("0",0,',','.')." VNĐ";
		   							}

		   							?>
				   						</div>
				   					</div>
				   					<div class="list_cost">
				   						<div>Mã giảm giá:</div>
				   						<div>
				   							<?php
				   								$pricetotal = Cart::pricetotal(0,',','');
				   								$percent_discount = Session::get('percent_discount');

				   								if (Session::get('type_discount') == "Giảm theo phần trăm") {
				   									$discount =($pricetotal * $percent_discount)/100;
				   									echo "- ".number_format($discount,0,',','.')." VNĐ";
				   								}elseif (Session::get('type_discount') == "Giảm theo tiền"){
				   									$discount =$percent_discount;
				   									echo "- ".number_format($discount,0,',','.')." VNĐ";
				   								}else{
				   									
				   									echo "0 VNĐ";
				   								}
				   							?>
				   							
				   						</div>
				   					</div>
				   					<div class="list_cost">
				   						<div>Thuế VAT:</div>
				   						<div>
				   							
				   						<?php
		   								$pricetotal = (double)Cart::pricetotal(0,',','');
		   								$percent_discount = (double)Session::get('percent_discount');
		   								if (Session::get('type_discount') == "Giảm theo phần trăm") {
		   									$subtotal = $pricetotal - ($pricetotal * $percent_discount)/100;
		   									$tax = ($subtotal * 10)/100;
		   									Session::put("tax", $tax);
		   									echo number_format($tax,0,',','.')." VNĐ";
		   								}elseif (Session::get('type_discount') == "Giảm theo tiền"){
		   									$subtotal =	$pricetotal - $percent_discount; 
		   									$tax = ($subtotal * 10)/100;
		   									Session::put("tax", $tax);
		   									echo number_format($tax,0,',','.')." VNĐ";
		   								}else{
		   									$subtotal =	$pricetotal; 
		   									$tax = ($subtotal * 10)/100;
		   									Session::put("tax", $tax);
		   									echo number_format($tax,0,',','.')." VNĐ";
		   								}
		   							?>
				   						</div>
				   					</div>
				   					<div class="list_cost subtotal">
				   						<div>Thanh tiền:</div>
				   						<div><?php
		   								$total = 0;
		   								$pricetotal = (integer)Cart::pricetotal(0,',','');
		   								$percent_discount = Session::get('percent_discount');
		   								
		   								if (Session::get('type_discount') == "Giảm theo phần trăm") {
		   									$subtotal = $pricetotal - ($pricetotal * $percent_discount)/100;
		   									$tax = ($subtotal * 10)/100;
		   									$total = $subtotal + $tax + $shipping_fee;
		   									Session::put("carttotal", $total);
		   									echo number_format($total,0,',','.')." VNĐ";
		   								}elseif(Session::get('type_discount') == "Giảm theo tiền"){
		   									$subtotal =	$pricetotal - $percent_discount; 
		   									$tax = ($subtotal * 10)/100;
		   									$total = $pricetotal - $percent_discount + $tax + $shipping_fee;
		   									Session::put("carttotal", $total);
		   									echo number_format($total,0,',','.')." VNĐ";
		   								}else{
		   									$subtotal =	$pricetotal; 
		   									$tax = ($subtotal * 10)/100;
		   									$total = $pricetotal + $tax + $shipping_fee;
		   									Session::put("carttotal", $total);
		   									echo number_format($total,0,',','.')." VNĐ";
		   								}

		   							?></div>
				   					</div>
			   					</div>
	        				</div>
	        			</div>

	        			<div class="box_bill">
	        				@if(\Session::has('success'))
						        <div class="text_success mgl20">{{ \Session::get('success') }}</div>
						    @endif
	        				<div class="button_payment">
	        					<div class="item_button_payment">
		        					<a href="{{URL::to('gio-hang')}}" class="button_link">
		        						<div class="">Quay lại giỏ hàng</div>		
		        					</a>
	        					</div>
	        					<div class="item_button_payment mgl20">
	        						<button class="button_padding">Xác nhận đặt hàng</button>
	        					</div>
	        					</form>
{{-- 
	        					<div class="item_button_payment mgl20">
		        					<a href="{{ route('processTransaction') }}" class="button_link">
		        						<img src="{{asset('public/frontend/images/logo_paypal.png')}}" alt="">
		        					</a>
	        					</div>
	        					<form action="{{URL::to('thanh-toan-vnpay')}}" method="post">
				        			<div class="item_button_payment">
				        				@csrf
					        			<button type="submit" class="button_padding mgl20" name="redirect">Thanh toán VNPAY</button>
					        		</div>
				        		</form>
				        		<form action="{{URL::to('thanh-toan-momo')}}" method="post">
				        			<div class="item_button_payment">
				        				@csrf
					        			<button type="submit" class="button_padding mgl20" name="payUrl">Thanh toán MOMO</button>
					        		</div>
				        		</form> --}}
	        				</div>
	        			</div>
	        		</div>



        		{{-- </form> --}}


        		{{-- <div class="button_payment">
	        		<form action="{{URL::to('thanh-toan-vnpay')}}" method="post">
	        			<div class="item_button_payment">
	        				@csrf
		        			<button type="submit" class="button_padding" name="redirect">Thanh toán VNPAY</button>
		        		</div>
	        		</form>
	        		<form action="{{URL::to('thanh-toan-momo')}}" method="post">
	        			<div class="item_button_payment">
	        				@csrf
		        			<button type="submit" class="button_padding mgl20" name="payUrl">Thanh toán MOMO</button>
		        		</div>
	        		</form>

        		</div> --}}
        	</div>
    	</div>

    	<div class="container">
		   		<div class="list_shopping_cart">

		   			@foreach($content as $key => $show_shopping_cart)
		   			<div class="item_shopping_cart">
		   				<div class="image_shopping_cart">
		   					<img src="{{asset('public/images_upload/images_product/'.$show_shopping_cart->options->image)}}" alt="">
		   				</div>
		   				<div class="content_shopping_cart">
		   					<div class="detail_category">Danh mục: <span>{{$show_shopping_cart->options->category}}</span></div>
		   					<div class="shopping_cart_name">{{$show_shopping_cart->name}}</div>
		   					<div class="shopping_cart_price">
								<div class="shopping_cart_price_discount">
									{{-- <?php
		                                if ($show_shopping_cart->options->discount > 0) {
		                                    // code...
		                                $price = (float)$show_shopping_cart->price;
		                                $percent = (float)$show_shopping_cart->options->discount;
		                                $discount = $price - (($price * $percent) / 100);
		                                
		                                echo number_format($discount, 0, ',', '.').' VNĐ';
		                                }else{
		                                    echo number_format($show_shopping_cart->price, 0, ',', '.').' VNĐ';
		                                }?> --}}
		                                {{number_format($show_shopping_cart->price).' VNĐ'}}
								</div>
								<div class="shopping_cart_discount">
									<?php
		                                if ($show_shopping_cart->options->discount > 0) {
		                                    echo $show_shopping_cart->options->discount.'%';
		                                }else{
		                                    echo "";
		                                }
		                            ?>
								</div>
							</div>
							<div class="detail_price">
								{{number_format($show_shopping_cart->options->priced, 0, ',', '.').' VNĐ';}}
							</div>

							<div class="total_shopping_cart">
								
								<form action="{{URL::to('update-shopping-cart')}}" method="post">
								@csrf
								<div class="detail_button_number">
									<span style="margin-right: 5px;">Số lương:</span>
									<div class="button_number">
										<input type="number" name="shopping_cart_qty" min="1" value="{{$show_shopping_cart->qty}}">
										<input type="hidden" name="shopping_cart_rowId" value="{{$show_shopping_cart->rowId}}">
									</div>
								</div>
								</form>

								<div class="total_money">Thành tiền: <span>
									<?php
										$number = $show_shopping_cart->price * $show_shopping_cart->qty;
										echo number_format($number, 0, ',', '.').' VNĐ';
									?>

								</span></div>
							</div>
		   				</div>
		   				<div class="delete_shopping_cart">
		   					<a href="{{URL::to('/delete-shopping-cart/'.$show_shopping_cart->rowId)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
		   				</div>
		   			</div>
		   			@endforeach
		   		</div>
		    </div>
@endsection