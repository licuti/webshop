@extends('admin_dashboard')
@section('admin_content')
<div class="pd-ltr-20 xs-pd-20-10">
	<div class="min-height-200px">

		<div class="page-header">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="title">
						<h4>Mã giảm giá</h4>
					</div>
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="index.html">Quản lý mã giảm giá</a></li>
							<li class="breadcrumb-item active" aria-current="page">Thêm mã giảm giá</li>
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
					


					<form method="post" action="{{URL::to('/save-code-discount')}}" enctype="multipart/form-data">

						{{csrf_field()}}
						<div class="clearfix">
							<div class="pull-left">
								<h4 class="text-blue h4">Thêm mã giảm giá</h4>


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
							<label>Nội dung giảm giá</label>
							<input class="form-control" name="name_discount" type="text" placeholder="Nội dung giảm giá" required>
						</div>
						<div class="form-group">
							<label>Mã code</label>
							<input class="form-control" id="code_discount" name="code_discount" type="text" placeholder="Mã code" required>
							<input class="btn btn-primary" type="button" value="Tạo ngâu nhiên" onclick="random()">
							<script type="text/javascript">
								function random(){
									var code = Math.random().toString(36).substr(2, 10).toUpperCase();
									document.getElementById('code_discount').value = code; 
								}
							</script>
						</div>

						
						<div class="form-group">
							<label>Sô lượng</label>
							<input class="form-control" name="times_discount" type="text" placeholder="Số lượng mã code" required>
						</div>
						<div class="form-group">
							<label>Phần trăm/Số tiền giảm(%/VNĐ)</label>
							<input class="form-control" name="percent_discount" type="text" placeholder="Phần trăm/Số tiền" required>
						</div>
						
						<div class="form-group">
							<label>Hình thức giảm</label>
							<select name="type_discount" class="form-control">
								<option value="Giảm theo phần trăm">Giảm theo phần trăm</option>
								<option value="Giảm theo tiền">Giảm theo tiền</option>
							</select>
						</div>

					</form>


				</div>

	</div>
</div>





@endsection