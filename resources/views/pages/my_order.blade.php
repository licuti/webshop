@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection

@section('content')
			<div class="path">
			<Ul class="list_path">
				<li>Trang chủ</li>
				<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				<li class="path_color">Đơn hàng của tôi</li>
			</Ul>
		</div>

    	<div class="container" style="background-color: #f8f8f8;">
		    <div class="shopping_cart">
		   		<div class="list_shopping_cart" style="min-height: 700px;">
		   			<table class="table_data" id="table_id">
		   				<thead>
		   					<tr>
		   						<th>Mã đơn hàng</th>
		   						<th>Tên người đặt</th>
		   						<th>Số điện thoại</th>
		   						<th>Địa chỉ</th>
		   						<th>Tổng bill</th>
		   						<th>Hình thức thanh toán</th>
		   						<th>Trạng thái</th>
		   						<th width="70px">Thao tác</th>
		   					</tr>
		   				</thead>
		   				<tbody>
		   					@foreach($getBill as $key => $bill)
		   					<tr>
		   						<td>{{$bill->id_bill}}</td>
		   						<td>{{$bill->name_bill}}</td>
		   						<td>{{$bill->phone_bill}}</td>
		   						<td>{{$bill->address_bill}}</td>
		   						<td>{{number_format($bill->total_bill)}}</td>
		   						<td>{{$bill->payment_bill}}</td>

		   						<td>{{$bill->status_bill}}</td>
		   						<td>
		   							@if($bill->status_bill == "Đã đặt hàng")
		   							<a class="text_none" onclick="confirm('Bạn có muốn xóa đơn hàng không?')" href="{{URL::to('/delete-my-order/'.$bill->id_bill)}}">
			        					<div class="btn_icon" style="padding: 2px;">
			        						<div class="btn_content">
			        							<div class="mgr5">
			        								<i class="fa fa-trash-o" aria-hidden="true"></i>
			        							</div>
			        							Hủy đơn
			        						</div>
			        					</div>
			        				</a>
			        				@else

			        				@endif
			        			</td>
		   					</tr>
		   					@endforeach
		   				</tbody>
		   			</table>
		   		</div>
		    </div>
		</div>
@endsection