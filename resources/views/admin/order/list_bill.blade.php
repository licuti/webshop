@extends('admin_dashboard')
@section('admin_content')
<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Danh sách đơn hàng</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="index.html">Quản lý đơn hàng</a></li>
									<li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
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
						<h4 class="text-blue h4">Danh sách đơn hàng</h4>
					</div>
					<div class="pb-20">
						<table class="checkbox-datatable hover table">
							<thead>
								<tr>
									<th><div class="dt-checkbox">
											<input type="checkbox" name="select_all" value="1" id="example-select-all">
											<span class="dt-checkbox-label"></span>
										</div>
									</th>
									<th>Tên người đặt</th>
									<th>Số điện thoại</th>
									<th>Địa chỉ</th>
									<th>Hình thức thanh toán</th>
									<th>Tổng hóa đơn</th>
									<th>Trạng thái đơn hàng</th>
									<th>Ngày mua</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody>
								@foreach($show_bill as $key => $bill)
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
									<td>{{$bill->name_bill}}</td>
									<td>{{$bill->phone_bill}}</td>
									<td>{{$bill->address_bill}}</td>
									<td>{{$bill->payment_bill}}</td>
									<td>{{number_format($bill->total_bill,0,',','.').' VNĐ'}}</td>
									<td>{{$bill->status_bill}}</td>
									<td>{{$bill->created_at}}</td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="{{URL::to('/detail-bill/'.$bill->id_bill)}}"><i class="icon-copy fa fa-eye"></i>Chi tiết đơn hàng
												</a>
												<a class="dropdown-item" href="{{URL::to('/delete-bill/'.$bill->id_bill)}}" onclick="return confirm('Bạn có muốn xóa không?');"><i class="dw dw-delete-3"></i>Xóa đơn hàng
												</a>
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