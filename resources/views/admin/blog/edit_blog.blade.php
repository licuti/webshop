@extends('admin_dashboard')
@section('admin_content')
<div class="pd-ltr-20 xs-pd-20-10">
	<div class="min-height-200px">

		<div class="page-header">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="title">
						<h4>Blog</h4>
					</div>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="index.html">Quản lý Blog</a></li>
							<li class="breadcrumb-item active" aria-current="page">Thêm Blog</li>
						</ol>
					</nav>
				</div>
				<div class="col-md-6 col-sm-12 text-right">
					<div class="dropdown">
						<a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
							January 2018
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">Export List</a>
							<a class="dropdown-item" href="#">Policies</a>
							<a class="dropdown-item" href="#">View Assets</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="pd-20 card-box mb-30">
					


					<form method="post" action="{{URL::to('/update-blog/'.$getBlog->id_blog)}}" enctype="multipart/form-data">

						{{csrf_field()}}
						<div class="clearfix">
							<div class="pull-left">
								<h4 class="text-blue h4">Chỉnh Sửa Blog</h4>


								<?php
								$message = Session::get('message');
								if ($message) {
									echo '<div class="alert alert-info" role="alert">';
									echo $message;
									echo '</div>';
									Session::put('message', null);
								}

								?>


							</div>
							<div class="pull-right">
								{{-- <a href="" class="btn btn-primary btn-sm scroll-click"  role="button"><i class="fa fa-plus"></i> Thêm</a> --}}
								<input class="btn btn-primary" type="submit" value="Sửa">
							</div>
						</div>

						<div class="form-group">
							<label>Tiêu đề bài viết</label>
							<input class="form-control" name="title_blog" id="gettex_slug" onkeyup="ChangeToSlug()" type="text" placeholder="Tên danh mục" value="{{$getBlog->title_blog}}">
						</div>
						<div class="form-group">
							<label>Slug bài viết</label>
							<input class="form-control" name="slug_blog" type="text" id="settex_slug" placeholder="Tên slug" required value="{{$getBlog->slug_blog}}">							
						</div>
						<div class="form-group">
							<label>Tóm tắt bài viết</label>
							<textarea class="form-control" name="describe_blog" placeholder="Tên danh mục" required>{{$getBlog->describe_blog}}</textarea>
						</div>

						
						<div class="form-group">
							<label>Nội dung bài viết</label>
							<textarea class="form-control" id="editor_edit_product" name="content_blog">{{$getBlog->content_blog}}</textarea>
						</div>

						<div class="form-group">
							<label>Ảnh bài viết</label>
							<input type="file" class="form-control-file form-control height-auto" name="image_blog">
						</div>
						<div class="form-group">
							<div style="width: 300px; height: 300px;">
								<img src="{{asset('public/images_upload/images_blog/'.$getBlog->image_blog)}}" class="img-responsive" alt="Image"
								style="width: 100%; height: 100%; object-fit:cover ;">
							</div>
						</div>
						<div class="form-group">
							<label>Trạng thái bài viết</label>
							<select name="status_blog" class="form-control">
								<?php
								if ($getBlog->status_blog =='Hiện') {
									echo "<option value='Hiện' selected>Hiện</option>";
									echo "<option value='Ẩn'>Ẩn</option>";
								}
								else{
									echo "<option value='Hiện'>Hiện</option>";
									echo "<option value='Ẩn' selected>Ẩn</option>";
								}
								
								?>
							</select>
						</div>


</div>





@endsection