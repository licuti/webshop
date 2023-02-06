@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection

@section('content')
			<div class="path">
			<Ul class="list_path">
				<li>Trang chủ</li>
				<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				<li class="path_color">Giỏ hàng</li>
			</Ul>
		</div>
		<?php
		$content = Cart::content();
		?>
    	<div class="container" style="background-color: #f8f8f8;">
		    <div class="shopping_cart">
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
									<input type="submit" name="" value="Cập nhật" class="discount_button">
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




		   		
		   		<div class="receipt">
		   			<div class="receipt_item">
		   				<div class="tittle_receipt">
		   					Địa điểm giao hàng
		   				</div>
		   				<div class="conetent_receipt location">
		   						<i class="fa fa-map-marker" aria-hidden="true"></i>	
		   						<input type="text" name="" value="123 Lê Trọng Tấn, An Khê, Thanh Khê, Đà Nẵng">
		   					
		   				</div>
		   			</div>
		   			<div class="receipt_item">
		   				<div class="tittle_receipt">
		   					Mã giảm giá
		   				</div>
		   				<form action="{{URL::to('/check-code-discount')}}" method="post">
		   					@csrf
		   				<div class="conetent_receipt discount_code">
		   					<div class="discount_code_input">
		   						<input type="text" name="code_discount" value="<?php
		   						$code_discount = Session::get('code_discount');
		   						if($code_discount != ''){
		   							echo $code_discount;
		   						}else{
		   							echo '';
		   							Session::put('code_discount', null);
		   						}

		   						?>" class="discount_input" placeholder="Nhập mã giảm giá">
		   						<input type="submit" name="" value="Áp dụng" class="discount_button">
		   					</div>
		   						
		   						{{-- <?php
		   							$percent_discount = Session::get('percent_discount');
		   							$message = Session::get('message');
		   							$name_discount = Session::get('name_discount');

		   							if ($percent_discount != '') {
		   								echo "<div class='discount_code_input'><span>";
		   								echo 'Hóa đơn của bạn được giảm '.number_format($percent_discount, 0, ',', '.').'%';
		   								echo '</span></div>';

		   								echo "<div class='discount_code_input discount_message'><span>";
		   								echo $name_discount;
		   								echo '</span></div>';
		   							}else{
		   								echo "<div class='discount_code_input'><span>";
		   								echo number_format(0, 0, ',', '.').' VNĐ';
		   								echo '</span></div>';

		   								echo "<div class='discount_code_input discount_message'><span>";
		   								echo $message;
		   								echo '</span></div>';
		   								Session::put('message', null);
	   								}
		   						?> --}}
		   						<?php
		   							if (Session::get('type_discount') == "Giảm theo phần trăm") {
		   								echo "<div class='discount_code_input'><span>"
		   								.'Bạn được giảm: '.Session::get('percent_discount')
		   								."%"
		   								." khi dùng voucher</span></div>";

		   								echo "<div class='discount_code_input discount_message'><span>"
										.Session::get('name_discount')
										."</span></div>";
		   							}elseif (Session::get('type_discount') == "Giảm theo tiền"){
		   								echo "<div class='discount_code_input'><span>"
		   								."Bạn được giảm: ".number_format(Session::get('percent_discount'),0,',','.')
		   								." VNĐ"
		   								." khi dùng voucher</span></div>";
		   								echo "<div class='discount_code_input discount_message'><span>"
										.Session::get('name_discount')
										."</span></div>";
		   							}else{
		   								echo "<div class='discount_code_input'><span>"
		   								.Session::get('message_discount')
		   								."</span></div>";
		   								Session::put('message_discount', null);
		   							}
		   						?>
		   				</div>
		   				</form>
		   			</div>
		   			<div class="receipt_item">
		   				<div class="conetent_receipt receipt_total">
		   					<div class="list_cost">
		   						<div>Tổng:</div>
		   						{{-- Tổng chưa thuế, discount --}}
		   						<div>{{Cart::pricetotal('0',',','.')}} VNĐ</div> 
		   					</div>
		   					{{-- <div class="list_cost">
		   						<div>Tổng:</div>
		   						<div>
		   							<?php
		   								$total = 0;
		   								$pricetotal = (integer)Cart::pricetotal(0,',','');
		   								$percent_discount = Session::get('percent_discount');
		   								
		   								if (Session::get('type_discount') == "Giảm theo phần trăm") {
		   									$subtotal = $pricetotal - ($pricetotal * $percent_discount)/100;
		   									
		   									$total = $subtotal;
		   									echo number_format($total,0,',','.')." VNĐ";
		   								}elseif(Session::get('type_discount') == "Giảm theo tiền"){
		   									$subtotal =	$pricetotal - $percent_discount; 
		   									
		   									$total = $subtotal;
		   									echo number_format($total,0,',','.')." VNĐ";
		   								}else{
		   									$subtotal =	$pricetotal; 
		   									
		   									$total = $pricetotal;
		   									echo number_format($total,0,',','.')." VNĐ";
		   								}

		   							?>
		   						</div>
		   					</div> --}}
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
		   						<div>{{-- {{Cart::tax('0',',','.')}} VNĐ --}}


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
		   						{{-- Tổng sau khi trừ thuế, discount --}}
		   						<div>
		   							{{-- {{Cart::total()}} --}}
		   							<?php
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

		   							?>
		   						</div>
		   					</div>


		   					<hr>
		   					<?php
		                    $id_user = Session::get('id_user');
		                    	if ($id_user != '') {
		                	?>
		   						<a href="{{URL::to('/thanh-toan-hoa-don')}}">Thanh toán hóa đơn</a>
		   					<?php
			                }else{

			                ?>
			               		<a href="{{URL::to('dang-nhap')}}">Thanh toán hóa đơn</a>
			               	<?php
			                    }
			                ?>
		   				</div>
		   			</div>
		   		</div>
		    </div>
		</div>
@endsection