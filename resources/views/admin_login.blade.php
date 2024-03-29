<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('public/backend/images/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('public/backend/images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/images/vendors/images/favicon-16x16.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('/public/backend/css/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/public/backend/css/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/public/backend/css/style.css')}}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="{{asset('public/backend/images/deskapp-logo.svg')}}" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="register.html">Đăng kí ngay</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="{{asset('public/backend/images/login-page-img.png')}}" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Đăng Nhập</h2>
						</div>
						<form method="POST" action="{{URL::to('/admin-dashboard')}}" >
							{{csrf_field()}}
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="admin">
										<div class="icon"><img src="{{asset('public/backend/images/briefcase.svg')}}" class="svg" alt=""></div>
										<span>I'm</span>
										Manager
									</label>
									<label class="btn">
										<input type="radio" name="options" id="user">
										<div class="icon"><img src="{{asset('public/backend/images/person.svg')}}" class="svg" alt=""></div>
										<span>I'm</span>
										Employee
									</label>
								</div>
							</div>
							<div class="input-group custom">
								<input type="text" name="admin_username" class="form-control form-control-lg" placeholder="Username">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" name="admin_password" class="form-control form-control-lg" placeholder="Password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>

							{{-- Cảnh báo đăng nhập --}}

							<?php
							$message = Session::get('message_login');
							if ($message) {
								echo '<div class="alert alert-warning" role="alert">';
								echo $message;
								echo '</div>';
								Session::put('message_login', null);
							}

							?>




							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Lưu mật khẩu</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="forgot-password.html">Quên mật khẩu?</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										
									
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										
										{{-- <a class="btn btn-primary btn-lg btn-block" href="{{URL::to('/admin-dashboard')}}">Đăng nhập</a> --}}
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">Hoặc</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="register.html">Đăng kí</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="{{asset('public/backend/js/core.js')}}"></script>
	<script src="{{asset('public/backend/js/script.min.js')}}"></script>
	<script src="{{asset('public/backend/js/process.js')}}"></script>
	<script src="{{asset('public/backend/js/layout-settings.js')}}"></script>
</body>
</html>