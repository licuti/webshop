@extends('welcome')
@section('content')
	<div class="form_box">
		
		<div class="box">
			<div class="box_logo">
				<img src="{{asset('public/frontend/images/LogoShop3.png')}}" alt="">
			</div>
			<div class="titre">Đăng nhập</div>
			<form action="{{URL::to('/login')}}" method="post">
				@csrf
				<div class="user-detail">
					<!--required: Chỉ định rằng một trường input phải được nhập trước khi gửi form -->
					<div class="input-box">
						<span class="details">Tài khoản</span>
						<input type="text" name="username" id="" placeholder="Tài khoản" required="">
					</div>
					<div class="input-box">
						<span class="details">Mật khẩu</span>
						<input type="password" name="password" id="" placeholder="Mật khẩu" required="">
					</div>
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

					<div class="remember_account">
						<input type="checkbox">
						Nhớ mật khẩu
					</div>
					<div class="box_text">Hoặc</div>
					<div class="register_account">
						<a href="{{URL::to('/login-facebook')}}">	
							<div class="items_register">
								<div class="logo_login">
									<img src="{{asset('public/frontend/images/Logo_Facebook.png')}}" alt="">
								</div>
								Đăng nhập băng Facebook

							</div>
						</a>
						<a href="{{URL::to('/login-google')}}">
							<div class="items_register">
								
									<div class="logo_login">
										<img src="{{asset('public/frontend/images/Logo_Google.png')}}" alt="">
									</div>
									Đăng nhập băng Google
							
							</div>
						</a>
					</div>
				</div>
				<div class="button-login">
					<input type="submit" value="Đăng nhập">
				</div>
				<div class="box_text">Bạn chưa có tài khoản?<a href="{{URL::to('dang-ky')}}">Đăng ký</a></div>
			</form>
		</div>

	</div>
@endsection