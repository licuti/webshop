@extends('admin_dashboard')
@section('admin_content')
<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Chi tiết đơn hàng</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="index.html">Quản lý đơn hàng</a></li>
									<li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
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

				<!-- horizontal Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Thông tin người nhận</h4>
						</div>
					</div>

					<?php
						$message = Session::get('message');
						if ($message) {
							echo '<div class="alert alert-info" role="alert">';
							echo $message;
							echo '</div>';
							Session::put('message', null);
						}

						?>
					<form method="post" action="{{URL::to('/update-bill/'.$info_bill->id_bill)}}">
						@csrf
						<div class="form-group">
							<label>Tên người đặt:</label>
							<input class="form-control" name="name_bill" type="text" value="{{$info_bill->name_bill}}" >
						</div>
						<div class="form-group">
							<label>Số điện thoại:</label>
							<input class="form-control" name="phone_bill" type="text" value="{{$info_bill->phone_bill}}" >
						</div>
						<div class="form-group">
							<label>Địa chỉ:</label>
							<input class="form-control" name="address_bill" type="text" value="{{$info_bill->address_bill}}" readonly>
						</div>
						<div class="form-group">
							<label>Email:</label>
							<input class="form-control" name="email_bill" type="text" value="{{$info_bill->email_bill}}" readonly>
						</div>
						<div class="form-group">
							<label>Tổng hóa đơn(Đơn vị: VNĐ):</label>
							<input class="form-control" name="total_bill" type="text" value="{{number_format($info_bill->total_bill,0,',','.')." VNĐ"}}" readonly>
						</div>
						<div class="form-group">
							<label>Ghi chú:</label>
							<textarea class="form-control" name="note_bill">{{$info_bill->note_bill}}</textarea>
						</div>
						<div class="form-group">
							<label>Tình trạng đơn hàng:</label>
							<select class="form-control" name="status_bill">
								<?php
								if($info_bill->status_bill =='Đã đặt hàng'){
									echo "<option value='Đã đặt hàng' selected>Đã đặt hàng</option>";
									echo "<option value='Đang xử lý'>Đang xử lý</option>";
									echo "<option value='Đang giao hàng'>Đang giao hàng</option>";
									echo "<option value='Đã giao hàng'>Đã giao hàng</option>";
								}elseif ($info_bill->status_bill =='Đang xử lý') {
									echo "<option value='Đã đặt hàng'>Đã đặt hàng</option>";
									echo "<option value='Đang xử lý' selected>Đang xử lý</option>";
									echo "<option value='Đang giao hàng'>Đang giao hàng</option>";
									echo "<option value='Đã giao hàng'>Đã giao hàng</option>";
								}
								elseif ($info_bill->status_bill =='Đang giao hàng') {
									echo "<option value='Đã đặt hàng'>Đã đặt hàng</option>";
									echo "<option value='Đang xử lý'>Đang xử lý</option>";
									echo "<option value='Đang giao hàng' selected>Đang giao hàng</option>";
									echo "<option value='Đã giao hàng'>Đã giao hàng</option>";
								}else {
									echo "<option value='Đã đặt hàng'>Đã đặt hàng</option>";
									echo "<option value='Đang xử lý'>Đang xử lý</option>";
									echo "<option value='Đang giao hàng'>Đang giao hàng</option>";
									echo "<option value='Đã giao hàng' selected>Đã giao hàng</option>";
								}
								?>
							</select>
						</div>
						<div class="btn-list">
								<input class="btn btn-primary" type="submit" value="Sửa">
							</div>
					</form>
				</div>
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Phương thức thanh toán</h4>
						</div>
					</div>
					<form>
					
						<div class="form-group">
							<label>Hình thức thanh toán:</label>
							<input class="form-control" type="text" value="{{$info_bill->payment_bill}}" readonly>
						</div>
					</form>
				</div>
				<!-- horizontal Basic Forms End -->


				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Danh sách sản phẩm đơn hàng</h4>
					</div>
					<div class="pb-20">
						<table class="hover table">
							<thead>
								<tr>
									<th>Hỉnh ảnh</th>
									<th>Tên sản phẩm</th>
									<th>Giá sản phẩm</th>
									<th>Số lượng</th>
								</tr>
							</thead>
							<tbody>
								@foreach($show_detail_bill as $key => $detail_bill)
								<tr>
									<td>
										<div style="width: 70px;
													height: 70px;
													background-position: center center;
													background-size: cover;">
											<img src="{{asset('/public/images_upload/images_product/'.$detail_bill->image_product)}}" style="object-fit: cover; width: 100%; height: 100%;" alt="">
										</div>
									</td>
									<td>{{$detail_bill->name_product}}</td>
									<td>{{number_format($detail_bill->price_product,'0',',','.'). ' VNĐ'}}</td>
									<td>{{$detail_bill->quantinty_product}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>	
				</div>

			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
@endsection