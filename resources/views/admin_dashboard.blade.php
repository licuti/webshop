<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>My WebShop - Dashborad</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('public/backend/images/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('public/backend/images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/images/favicon-16x16.png')}}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/src/plugins/sweetalert2/sweetalert2.css')}}">

	<!-- switchery css -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/src/plugins/switchery/switchery.min.css')}}">
	<!-- bootstrap-tagsinput css -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>


	

</head>
<body>
	{{-- <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="{{asset('public/backend/images/deskapp-logo.svg')}}" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div> --}}

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i class="dw dw-search2 search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
								<i class="ion-arrow-down-c"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo1.jpg" alt="">
										<h3>Lea R. Frith</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo2.jpg" alt="">
										<h3>Erik L. Richards</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo3.jpg" alt="">
										<h3>John Doe</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/photo4.jpg" alt="">
										<h3>Renee I. Hansen</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="vendors/images/img.jpg" alt="">
										<h3>Vicki M. Coleman</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="{{asset('public/backend/images/photo1.jpg')}}" alt="">
						</span>
						<span class="user-name">
							<?php
							$username = Session::get('admin_name');
							if ($username) {
								echo $username;
							}
							
							
							?>
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Thông tin cá nhân</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Cài đặt</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Trợ giúp</a>
						<a class="dropdown-item" href="{{URL::to('/admin-logout')}}"><i class="dw dw-logout"></i> Đăng xuất</a>
					</div>
				</div>
			</div>
			{{-- <div class="github-link">
				<a href="https://github.com/dropways/deskapp" target="_blank"><img src="{{asset('public/backend/images/github.svg')}}" alt=""></a>
			</div> --}}
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="{{URL::to('/dashboard')}}">
				<img src="{{asset('public/backend/images/deskapp-logo.svg')}}" alt="" class="dark-logo">
				<img src="{{asset('public/backend/images/deskapp-logo-white.svg')}}" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">


					{{-- Sibar Admin --}}

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Quản lý Danh mục</span>
						</a>
						<ul class="submenu">
							<li><a href="{{URL::to('/list-category')}}">Danh sách danh mục</a></li>
							<li><a href="{{URL::to('/add-category')}}">Thêm danh mục</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Quản lý Sản phẩm</span>
						</a>
						<ul class="submenu">
							<li><a href="{{URL::to('/list-product')}}">Danh sách sản phẩm</a></li>
							<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Quản lý đơn hàng</span>
						</a>
						<ul class="submenu">
							<li><a href="{{URL::to('/list-bill')}}">Danh sách đơn hàng</a></li>
							{{-- <li><a href="{{URL::to('/list-order')}}">Danh sách đơn hàng</a></li> --}}
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Quản lý mã giảm giá</span>
						</a>
						<ul class="submenu">
							<li><a href="{{URL::to('/list-code-discount')}}">Danh sách mã giảm giá</a></li>
							<li><a href="{{URL::to('/add-code-discount')}}">Thêm mã giảm giá</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Quản lý phí vận chuyển</span>
						</a>
						<ul class="submenu">
							<li><a href="{{URL::to('/list-delivery-cost')}}">Danh sách phí vận chuyển</a></li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Quản lý Slide</span>
						</a>
						<ul class="submenu">
							<li><a href="{{URL::to('/list-slide')}}">Danh sách Slide</a></li>
							<li><a href="{{URL::to('/add-slide')}}">Thêm Slide</a></li>
							
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Quản lý Blog</span>
						</a>
						<ul class="submenu">
							<li><a href="{{URL::to('/list-blog')}}">Danh sách Blog</a></li>
							<li><a href="{{URL::to('/add-blog')}}">Thêm Blog</a></li>
							
						</ul>
					</li>

					<li>
						<div class="dropdown-divider"></div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		
		@yield('admin_content')


	</div>
	<!-- js -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="{{asset('public/backend/js/core.js')}}"></script>
	<script src="{{asset('public/backend/js/script.min.js')}}"></script>
	<script src="{{asset('public/backend/js/process.js')}}"></script>
	<script src="{{asset('public/backend/js/layout-settings.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('public/backend/js/dashboard3.js')}}"></script>

	<script src="{{asset('public/backend/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/datatables/js/vfs_fonts.js')}}"></script>

	<!-- Datatable Setting js -->
	<script src="{{asset('public/backend/js/datatable-setting.js')}}"></script>

	<script src="{{asset('public/backend/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
	<script src="{{asset('public/backend/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

		<!-- switchery js -->
	<script src="{{asset('public/backend/src/plugins/switchery/switchery.min.js')}}"></script>
	<!-- bootstrap-tagsinput js -->
	<script src="{{asset('public/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

	<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
	<script>
		CKEDITOR.replace('editor_edit_product');
	</script>


    <script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
	</script>

	<script type="text/javascript">
		function ChangeToSlug()
			{
			    var title, slug;
			 
			    //Lấy text từ thẻ input title 
			    title = document.getElementById("gettex_slug").value;
			 
			    //Đổi chữ hoa thành chữ thường
			    slug = title.toLowerCase();
			 
			    //Đổi ký tự có dấu thành không dấu
			    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
			    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
			    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
			    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
			    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
			    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
			    slug = slug.replace(/đ/gi, 'd');
			    //Xóa các ký tự đặt biệt
			    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
			    //Đổi khoảng trắng thành ký tự gạch ngang
			    slug = slug.replace(/ /gi, "-");
			    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
			    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
			    slug = slug.replace(/\-\-\-\-\-/gi, '-');
			    slug = slug.replace(/\-\-\-\-/gi, '-');
			    slug = slug.replace(/\-\-\-/gi, '-');
			    slug = slug.replace(/\-\-/gi, '-');
			    //Xóa các ký tự gạch ngang ở đầu và cuối
			    slug = '@' + slug + '@';
			    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
			    //In slug ra textbox có id “slug”
			    document.getElementById('settex_slug').value = slug;
			}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			load_gallery();
			function load_gallery(){
				var get_id_product = $('.get_id_product').val();
				var _token = $('input[name=_token]').val();
				$.ajax({
					url: "{{url('/select-gallery')}}",
					method: "post",
					data: {
						id_product:get_id_product,
						_token:_token},
					success:function(data){
						$('#id_gallery').html(data);
					}
				});
			}

			$('#image_gallery').change(function(){
				var error = '';
				var files = $('#image_gallery')[0].files;
				if (files.length > 5) {
					error += 'Bạn chỉ được chọn 5 ảnh!';
				}else if(files.length == ''){
					error += 'Không được bỏ trống!'; 
				}else if(files.size > 5000000){
					error += 'Kích thước file quá lớn!';
				}
				if (error == '') {
					
				}else{
					$('#image_gallery').val('');
					$('#message_add_gallery').html('<div class="alert alert-danger" role="alert">'+error+'</div>');
					return false;
				}
			});

			/*delete*/
			$(document).on('click','.delete_gallery',function(){
				var get_id_gallery = $(this).data('gal_id');
				var _token = $('input[name=_token]').val();
				if (confirm('Bạn có muốn xóa ảnh này không?')) {
					$.ajax({
						url: "{{url('/delete-gallery')}}",
						method: "post",
						data: {
							id_gallery:get_id_gallery,
							_token:_token},
						success:function(data){
							load_gallery();
							$('#message_list_gallery').html('<div class="alert alert-success" role="alert">Xóa ảnh thành công!</div>');
						}
					});
				}else{
					return false;
				}
			});

			/*update name*/
			$(document).on('blur','.edit_name_gallery',function(){
				var get_id_gallery = $(this).data('gal_id');
				var get_text_gallery = $(this).text();
				var _token = $('input[name=_token]').val();
				$.ajax({
					url: "{{url('/update-name-gallery')}}",
					method: "post",
					data: {
						id_gallery:get_id_gallery,
						name_gallery:get_text_gallery,
						_token:_token},
					success:function(data){
						load_gallery();
						$('#message_list_gallery').html('<div class="alert alert-success" role="alert">Cập nhật tên ảnh thành công!</div>');
					}
				});
			});


			/*update iamge*/
			$(document).on('change','.image_gallery',function(){

				var get_id_gallery = $(this).data('gal_id');
				var get_name_image = document.getElementById('file-'+get_id_gallery).files[0];
				var form_data = new FormData();
				form_data.append('file',document.getElementById('file-'+get_id_gallery).files[0]);
				form_data.append('id_gallery',get_id_gallery);
				$.ajax({
					url: "{{url('/update-image-gallery')}}",
					method: "post",
					headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
					data: form_data,
					cache:false,
					contentType: false,
					processData:false,
					success:function(data){
						load_gallery();
						$('#message_list_gallery').html('<div class="alert alert-success" role="alert">Cập nhật ảnh '+get_id_gallery+' thành công!</div>');
					}
				});
			});



			/*quản lý vận chuyển*/

			load_delivery();
			function load_delivery(){
				var _token = $('input[name=_token]').val();
				$.ajax({
					url: "{{url('/load-delivery')}}",
					method: "post",
					data: {
						_token:_token},
					success:function(data){
						$('#load_delivery').html(data);
					}
				});
			}
			
			$('.add_shipping_fee').click(function(){
				var city = $('.city').val();
				var district = $('.district').val();
				var cwt = $('.cwt').val();
				var shipping_fee = $('.shipping_fee').val();
				var _token = $('input[name=_token]').val();

				$.ajax({
					url: "{{url('/save-delivery-cost')}}",
					method: "post",
					data: {
						city:city,
						district:district,
						cwt:cwt,
						shipping_fee:shipping_fee,
						_token:_token},
					success:function(data){
						load_delivery();
						alert('Thêm  thành công!!!');
					}
				});

			});

			$(document).on('blur','.edit_shipping_fee',function(){
				var get_id_fee = $(this).data('shipping_fee');
				var get_shipping_fee = $(this).text();
				var _token = $('input[name=_token]').val();
				$.ajax({
					url: "{{url('/update-delivery')}}",
					method: "post",
					data: {
						get_id_fee:get_id_fee,
						get_shipping_fee:get_shipping_fee,
						_token:_token},
					success:function(data){
						alert('Chỉnh sửa thành công!!!');
						location.reload(true);
					}
				});
			});


			$('select').on('change',function(){
				var action = $(this).attr('id');
				var get_id = $(this).val();
				var _token = $('input[name=_token]').val();
				var result = '';

				if(action == 'city'){
					result = 'district';
				}
				if(action == 'district'){
					result = 'cwt';
				}
				$.ajax({
					url: "{{url('/select-delivery')}}",
					method: "post",
					data: {
						action:action,
						get_id:get_id,
						_token:_token},
					success:function(data){
						$('#'+result).html(data);
					}
				});
			});

		});
	</script>
</body>
</html>