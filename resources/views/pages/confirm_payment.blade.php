@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection

@section('content')
<div class="path">
	<ul class="list_path">
		<li>Trang chủ</li>
		<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
		<li class="path_color">Thanh toán trực tuyến</li>
	</ul>
</div>
		<?php
		$content = Cart::content();
		?>
		<div class="container">
        	<div class="title_container">
            	<p>Chọn hình thức thanh toán</p>
        	</div>
        	<div class="container_content">
        		
	        			<div class="box_bill">
	        				<div class="button_payment">

	        					{{-- <div class="item_button_payment mgl20">
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
				        		<div class="list_bank">
			        				<a class="text_none" href="{{ route('processTransaction') }}">
			        					<div class="btn_icon">
			        						<div class="btn_content">
			        							<div class="btn_logo mgr5">
			        								<img class="image" src="{{asset('public/frontend/images/logo_pp.png')}}" alt="">
			        							</div>
			        							Thanh toán qua PayPal
			        						</div>
			        					</div>
			        				</a>



			        				<form action="{{URL::to('thanh-toan-vnpay')}}" method="post">
			        				@csrf
			        				<button class="btn_icon mgl20" name="redirect" type="submit">
			        					<div class="btn_content">
			        						<div class="btn_logo mgr5">
			        							<img class="image" src="{{asset('public/frontend/images/logo_vnpay.png')}}" alt="">
			        						</div>
			        						Thanh toán qua VnPay
			        					</div>
			        				</button>
			        				</form>


			        				<form action="{{URL::to('thanh-toan-momo')}}" method="post">
			        				@csrf
			        				<button class="btn_icon mgl20" name="payUrl" type="submit">
			        					<div class="btn_content">
			        						<div class="btn_logo mgr5">
			        							<img class="image" src="{{asset('public/frontend/images/logo_momo.png')}}" alt="">
			        						</div>
			        						Thanh toán qua MoMo
			        					</div>
			        				</button>

			        				</form>

			        				<a class="text_none mgl20" href="{{URL::to('testpay')}}">
			        					<div class="btn_icon">
			        						<div class="btn_content">
			        							<div class="btn_logo mgr5">
			        								<img class="image" src="{{asset('public/frontend/images/logo_zlpay.jpg')}}" alt="">
			        							</div>
			        							Thanh toán qua ZaloPay
			        						</div>
			        					</div>
			        				</a>


			        			</div>
			        		</div>
	        			</div>
	        			<div class="list_center">
	        				
	        				<div class="item_button_payment mg20">
		        					<a href="{{URL::to('thanh-toan-hoa-don')}}" class="button_link">
		        						<div class="">Quay lại đơn hàng</div>		
		        					</a>
	        				</div>
	        			</div>
	        			
	        			
	        		</div>
	        	</div>
        	</div>
    	</div>

@endsection