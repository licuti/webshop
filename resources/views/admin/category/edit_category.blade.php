@extends('admin_dashboard')
@section('admin_content')
<div class="pd-ltr-20 xs-pd-20-10">
	<div class="min-height-200px">

		<div class="page-header">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="title">
						<h4>Danh mục sản phẩm</h4>
					</div>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="index.html">Quản lý danh mục</a></li>
							<li class="breadcrumb-item active" aria-current="page">Chỉnh sửa danh mục</li>
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
					

					@foreach($show_edit_category as $key => $show_cate)
					<form method="post" action="{{URL::to('/update-category/'.$show_cate->id_category)}}" enctype="multipart/form-data">

						{{csrf_field()}}
						<div class="clearfix">
							<div class="pull-left">
								<h4 class="text-blue h4">Sửa danh mục sản phẩm</h4>


								<?php
								$message_add = Session::get('message_add');
								if ($message_add) {
									echo '<div class="alert alert-warning" role="alert">';
									echo $message_add;
									echo '</div>';
									Session::put('message_add', null);
								}

								?>


							</div>
							<div class="pull-right">
								{{-- <a href="" class="btn btn-primary btn-sm scroll-click"  role="button"><i class="fa fa-plus"></i> Thêm</a> --}}
								<input class="btn btn-primary" type="submit" value="Cập nhật">
							</div>
						</div>
						<div class="form-group">
							<label>Tên danh mục</label>
							<input class="form-control" name="name_category" id="gettex_slug" onkeyup="ChangeToSlug()" type="text" placeholder="Tên danh mục" value="{{$show_cate->name_category}}">
						</div>
						<div class="form-group">
							<label>Slug danh mục</label>
							<input class="form-control" name="slug_category"id="settex_slug" type="text" placeholder="Tên danh mục" value="{{$show_cate->slug_category}}">
						</div>
						<div class="form-group">
							<label>Mô tả danh mục</label>
							<textarea class="form-control" name="describe_category">{{$show_cate->describe_category}}</textarea>
						</div>
						<div class="form-group">
							<label>Ảnh danh mục</label>
							<input type="file" class="form-control-file form-control height-auto" name="image_category">
						</div>
						<div class="form-group">
							<div style="width: 300px; height: 300px;">
								<img src="{{asset('public/images_upload/images_category/'.$show_cate->image_category)}}" class="img-responsive" alt="Image"
								style="width: 100%; height: 100%; object-fit:cover ;">
							</div>
						</div>
						<div class="form-group">
							<label>Trạng thái</label>
							<select name="status_category" class="form-control">
								<?php
								if ($show_cate->status_category =='Hiện') {
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
					</form>
					@endforeach

				</div>

	</div>
</div>





@endsection