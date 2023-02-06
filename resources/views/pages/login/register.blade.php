@extends('welcome')
@section('content')
	<div class="form_box">
		
		<div class="box">
			<div class="box_logo">
				<img src="{{asset('public/frontend/images/LogoShop3.png')}}" alt="">
			</div>
			<div class="titre">Đăng ký</div>
			<form action="{{URL::to('/register')}}" method="post">
				@csrf
				<div class="user-detail">
					<!--required: Chỉ định rằng một trường input phải được nhập trước khi gửi form -->
					<div class="input-box">
						<span class="details">Họ và tên</span>
						<input type="text" name="fullname_user" id="" placeholder="Họ và tên" required="">
					</div>
					<div class="input-box">
						<span class="details">Tên đăng nhập</span>
						<input type="text" name="username" id="" placeholder="Tên đăng nhạp" required="">
					</div>
					<div class="input-box">
						<span class="details">Email</span>
						<input type="text" name="email_user" id="" placeholder="Email" required="">
					</div>
					<div class="input-box">
						<span class="details">Mật khẩu</span>
						<input type="password" name="password" id="" placeholder="Mật khẩu" required="">
					</div>
					<div class="input-box">
						<span class="details">Số điện thoại</span>
						<input type="text" name="phone_user" id="" placeholder="Số điện thoại" required="">
					</div>
					<div class="input-box">
						<span class="details">Địa chỉ</span>
						<select name="select_city" id="city" class="select city">
							<option>Chọn thành phố</option>
							@foreach($get_city as $city)
									<option  value="{{$city->id_city}}">{{$city->name_city}}</option>
							@endforeach
						</select>
					</div>
					<div class="input-box">
						<select name="select_district" id="district" class="select district">
							<option>Chọn quận huyện</option>
						</select>
					</div>
					<div class="input-box">
						<select name="select_cwt" id="cwt" class="cwt">
							<option>Chọn xã, phường, thị trấn</option>
						</select>
					</div>
					<div class="input-box">	
						<input type="" name="select_street" id="" placeholder="Số nhà, tên đường" required="">
					</div>
				</div>
				<div class="button-login">
					<input type="submit" value="Đăng ký">
				</div>
				<div class="box_text">Bạn đã có tài khoản?<a href="{{URL::to('/dang-nhap')}}">Đăng nhập</a></div>
			</form>
		</div>
	</div>
@endsection