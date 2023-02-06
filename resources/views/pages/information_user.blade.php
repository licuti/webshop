@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection

@section('content')
<div class="path">
	<ul class="list_path">
		<li>Trang chủ</li>
		<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
		<li class="path_color">Thông tin cá nhân</li>
	</ul>
</div>
		<?php
		$content = Cart::content();
		?>
		<div class="container">
        	<div class="title_container">
            	<p>Thông tin cá nhân</p>
        	</div>
        	<div class="container_content">
        		<form action="{{URL::to('/save-information-user')}}" method="post">
        			@csrf
	        		<div class="form_bill">
	        			<div class="box_bill bill_input">
	        				<div class="infor_bill">
	        					<div class="input_box">
									<span class="details">Họ và tên</span>
									<input type="text" name="fullname_user" id="" value="{{$get_db_user->fullname_user}}" placeholder="Họ và tên" required="">
								</div>
								<div class="input_box">
									<span class="details">Email</span>
									<input type="text" name="email_user" id="" value="{{$get_db_user->email_user}}" placeholder="Email" required="">
								</div>
								<div class="input_box">
									<span class="details">Số điện thoại</span>
									<input type="text" name="phone_user" id="" value="{{$get_db_user->phone_user}}" placeholder="Số điện thoại" required="">
								</div>
{{-- 								<div class="input_box">
									<span class="details">Địa điểm giao hàng</span>
									<input type="text" name="address_bill" id="" placeholder="Họ và tên" required="">
								</div> --}}
								
	        				</div>
	        				<div class="infor_bill">
	        					<div class="input_box">
									<span class="details">Địa điểm giao hàng</span>
									<div class="payment_select">
										<input type="text" name="select_street" id="" placeholder="Số nhà/Tên đường" required="" value="{{$get_db_address->street_address}}">
										<div class="payment_items payment_bank">
											<div class="item_payment option_payment">
												<select name="select_city" id="city" class="select city">

													<option value="0">--Tỉnh/Thành phố--</option>
													@foreach($get_city as $city)
														@if($city->id_city == $get_db_address->id_city)
															<option selected value="{{$city->id_city}}">{{$city->name_city}}</option>
														@else
															<option  value="{{$city->id_city}}">{{$city->name_city}}</option>
														@endif
													@endforeach
												</select>
											</div>
										</div>
										<div>
										<div class="payment_items payment_bank">
											<div class="item_payment option_payment">
												<select name="select_district" id="district" class="select district">
													<option value="0">--Quận Huyện--</option>
													@foreach($get_district as $district)
														@if($district->id_district == $get_db_address->id_district)
															<option selected value="{{$district->id_district}}">{{$district->name_district}}</option>
														@else
															<option  value="{{$district->id_district}}">{{$district->name_district}}</option>
														@endif
													@endforeach
												</select>
											</div>
										</div>
										<div class="payment_items payment_bank">
											<div class="item_payment option_payment">
												<select name="select_cwt" id="cwt" class="cwt">
													<option value="0">--Xã/Phường/Thị trấn</option>
													@foreach($get_cwt as $cwt)
														@if($cwt->id_cwt == $get_db_address->id_cwt)
															<option selected value="{{$cwt->id_cwt}}">{{$cwt->name_cwt}}</option>
														@else
															<option  value="{{$cwt->id_cwt}}">{{$cwt->name_cwt}}</option>
														@endif
													@endforeach
												</select>
											</div>
										</div>
									</div>
									</div>
								</div>
	        				</div>

	        			</div>
	        			<button  class="button_padding mg20">Lưu thông tin</button>
	        		</div>


	        						
	        				
	        				


        		</form>
        	</div>
    	</div>
@endsection