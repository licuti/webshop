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
			<form method="post" action="{{URL::to('/save-gallery/'.$id_product)}}" enctype="multipart/form-data">

				{{csrf_field()}}
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Thêm ảnh</h4>


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
					<label>Tên ảnh(Có hoặc không)</label>
					<input class="form-control" name="name_gallery" type="text" placeholder="Tên ảnh">
				</div>
				<div class="form-group">
					<label>Ảnh danh mục</label>
					<input type="file" class="form-control-file form-control height-auto" id="image_gallery" name="file[]" accept="image/*" multiple>
				</div>
				<div id="message_add_gallery">
					
				</div>
			</form>
		</div>
	</div>


	<div class="card-box mb-30">
		<div class="pd-20">
			<h4 class="text-blue h4">Danh sách sản phẩm</h4>
		</div>
		<input type="hidden" name="get_id_product" value="{{$id_product}}" class="get_id_product">
		<div class="" id="message_list_gallery">
			
		</div>
		<form>
			@csrf
			<div class="pb-20" id="id_gallery">



			</div>
		</form>
	</div>
</div>
@endsection