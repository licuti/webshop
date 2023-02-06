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
									<li class="breadcrumb-item"><a href="index.html">Danh mục sản phẩm</a></li>
									<li class="breadcrumb-item active" aria-current="page">Danh sách danh mục</li>
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
						<h4 class="text-blue h4">Danh sách danh mục</h4>
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
						<table class="checkbox-datatable hover table">
							<thead>
								<tr>
									<th><div class="dt-checkbox">
											<input type="checkbox" name="select_all" value="1" id="example-select-all">
											<span class="dt-checkbox-label"></span>
										</div>
									</th>
									<th>ID Bill</th>
									<th>ID User</th>
									<th>Tên người đặt</th>
									<th>Tên sản phẩm</th>
									<th>Giá sản phẩm</th>
									<th>Số lượng</th>
									<th>Ngày mua</th>
								</tr>
							</thead>
							<tbody>
								@foreach($show_order as $key => $order)
								<tr>
									<td></td>
									{{-- <td>
										<div style="width: 70px;
													height: 70px;
													background-position: center center;
													background-size: cover;">
											<img src="{{asset('/public/images_upload/images_slide/'.$slide->image_slide)}}" style="object-fit: cover; width: 100%; height: 100%;" alt="">
										</div>
									</td> --}}
									<td>{{$order->id_bill}}</td>
									<td>{{$order->id_user}}</td>
									<td>{{$order->name_bill}}</td>
									<td>{{$order->name_product}}</td>
									<td>{{number_format($order->price_product,'0',',','.').' VNĐ'}}</td>
									<td>{{$order->quantinty_product}}</td>
									<td>{{$order->created_at}}</td>
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