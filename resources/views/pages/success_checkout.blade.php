@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection

@section('content')
<div class="path">
	<ul class="list_path">
		<li>Trang chủ</li>
		<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
		<li class="path_color">Thanh toán hóa đơn</li>
	</ul>
</div>
		<div class="container">
        	<div class="container_content">
        		<h2 align="center">Cảm ơn bạn đã đặt hàng!</h2>
        		<div style="width: 300px;height: 300px;margin: auto;">
        			<img src="https://clipart.world/wp-content/uploads/2021/06/Green-Check-Mark-clipart-image.png" class="image">
        		</div>
        		<div class="mg20">
        			<div class="list_btn_center">
						<a href="{{URL::to('/trang-chu')}}" class="btn_link">
							Tiếp tục mua hàng	
						</a>
					</div>
        		</div>
        	</div>
    	</div>
 
@endsection