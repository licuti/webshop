@extends('admin_dashboard')
@section('admin_content')
<div class="pd-ltr-20 xs-pd-20-10">
	<div class="min-height-200px">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="title">
						<h4>Sản phẩm</h4>
					</div>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="index.html">Quản lý sản phẩm</a></li>
							<li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
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
			<form method="post" action="{{URL::to('/save-product')}}" enctype="multipart/form-data">

				{{csrf_field()}}
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Thêm sản phẩm</h4>


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
						<input class="btn btn-primary" type="submit" value="Thêm">
					</div>
				</div>

				<div class="form-group">
					<label>Tên sản phẩm</label>
					<input class="form-control" name="name_product" id="gettex_slug" onkeyup="ChangeToSlug()" type="text" placeholder="Tên sản phẩm" required>
				</div>
				<div class="form-group">
					<label>Slug sản phẩm</label>
					<input class="form-control" name="slug_product" id="settex_slug" type="text" placeholder="Slug sản phẩm" required>
				</div>
				<div class="form-group">
					<label>Mô tả sản phẩm</label>
					<textarea class="form-control" name="describe_product" placeholder="Mô tả sản phẩm" required></textarea>
				</div>
				<div class="form-group">
					<label>Chi tiết sản phẩm</label>
					<textarea class="form-control" name="detail_product" id="editor_edit_product" placeholder="Chi tiết sản phảm" required></textarea>
				</div>
				<div class="form-group">
					<label>Ảnh danh mục</label>
					<input type="file" class="form-control-file form-control height-auto" name="image_product">
				</div>
				<div class="form-group">
					<label>Giá bán sản phẩm</label>
					<input class="form-control" name="price_product" type="text" placeholder="Giá bán" required>
				</div>
				<div class="form-group">
					<label>Tỉ lệ giảm giá(Đơn vị %)</label>
					<input class="form-control" name="discount_product" type="text" placeholder="Tỉ lệ giảm giá">
				</div>
				<div class="form-group">
					<label>Số lượng hàng</label>
					<input class="form-control" name="sales_product" type="text" placeholder="Số lượng hàng" required>
				</div>
				<div class="form-group">
					<label>Danh mục sản phẩm</label>
					<select name="list_category" class="form-control">
						<option value="">Chọn danh mục</option>
						@foreach($show_category as $key => $show_cate)
						<option value="{{$show_cate->id_category}}">{{$show_cate->name_category}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Trạng thái</label>
					<select name="status_product" class="form-control">
						<option value="Hiện">Hiện</option>
						<option value="Ẩn">Ẩn</option>
					</select>
				</div>
				<div class="form-group">
					<label>Keywords</label>
					<input type="text" name="keywords_product" value="" data-role="tagsinput" placeholder="Thêm keyword">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection