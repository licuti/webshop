@extends('admin_dashboard')
@section('admin_content')
<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Danh sách mã giảm giá</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="index.html">Quản lý mã giảm giá</a></li>
									<li class="breadcrumb-item active" aria-current="page">Danh sách mã giảm giá</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
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


				<!-- Checkbox select Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Danh sách mã giảm giá</h4>
					</div>
								<?php
								$message = Session::get('message');
								if ($message) {
									echo '<div class="alert alert-success" role="alert">';
									echo $message;
									echo '</div>';
									Session::put('message', null);
								}

								?>
					<div class="pb-20">
						<table class="checkbox-datatable hover table nowrap">
							<thead>
								<tr>
									<th><div class="dt-checkbox">
											<input type="checkbox" name="select_all" value="1" id="example-select-all">
											<span class="dt-checkbox-label"></span>
										</div>
									</th>
									<th>Nội dung mã giảm</th>
									<th>Mã code</th>
									<th>Số lượng mã</th>
									<th>Số phần trăm/Tiền giảm</th>
									<th>Hình thức giảm</th>
									<th>Trạng thái</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody>
								@foreach($show_discount as $key => $discount)
								<tr>
									<td></td>

									<td>{{$discount->name_discount}}</td>
									<td>{{$discount->code_discount}}</td>
									<td>{{$discount->times_discount}}</td>
									<?php
										if($discount->type_discount == 'Giảm theo phần trăm'){
									?>
									<td>{{$discount->percent_discount.' %'}}</td>
									<?php
										}else{
									?>
									<td>{{number_format($discount->percent_discount,0,',','.').' VNĐ'}}</td>

									<?php
										}
									?>
									<td>{{$discount->type_discount}}</td>
									<td>{{$discount->status_discount}}</td>
									<td>
										<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="{{URL::to('/edit-code-discount/'.$discount->id_discount)}}"><i class="dw dw-edit2"></i> Chỉnh sửa</a>
													<a class="dropdown-item" href="{{URL::to('/delete-code-discount/'.$discount->id_discount)}}" onclick="return confirm('Bạn có muốn xóa mã này không?');"><i class="dw dw-delete-3"></i> Xóa</a>
												</div>
											</div>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<!-- Checkbox select Datatable End -->

			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
@endsection