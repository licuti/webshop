@extends('welcome')

@section('navbar')
@include('pages.include.navbar') 
@endsection

@section('content')

			<div class="" style="height: 400px; position: relative;">
		    	<img class="image" src="https://vingarden.vn/wp-content/uploads/2018/07/cham-soc-cay-canh-san-vuon-xanh-dep-2.jpg">
		    	<div style="position: absolute;top: 50%;left: 50%;font-size: 20pt;color: #fff; font-weight: 800;transform: translate(-50%,-50%);">CẨM NANG CHĂM SÓC</div>
		    </div>

    	<div class="container">
		    

	   		<div style=" display: flex;" class="mg30">
	   			<div style="width: 25%;">
	   				<div id="fb-root">
		   					<div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100087957230626" data-tabs="timeline, events, messages" data-width="500" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
		   				</div>
	   			</div>
	   			<div style="display:flex; flex-wrap: wrap;flex: 1;">


	   				@foreach($getBlog as $key => $blog)
	   				<div class="grib2">
		   				<a href="{{URL::to('/cam-nang-cham-soc/'.$blog->slug_blog.'/'.$blog->id_blog)}}" class="text_none">
		   					<div class="blog_content">
		   						<div class="blog_image">
		   							<img class="image" src="{{asset('public/images_upload/images_blog/'.$blog->image_blog)}}" alt="">
			   					</div>
			   					<div class="blog_title link_hover">{{$blog->title_blog}}</div>
			   					<div class="blog_delt">{{$blog->describe_blog}}</div>
			   					<div class="" style="margin-top:10px;font-size: 10pt"><i>Ngày đăng: {{substr($blog->created_at,0,10)}}</i></div>
			   					<div class="blog_button">
			   						<i class="fa fa-share" aria-hidden="true"></i>
									<i class="fa fa-thumbs-up mgl20" aria-hidden="true"></i>
			   					</div>
			   					<div class="list_center link_hover">Xem chi tiết</div>
		   					</div>
		   				</a>
		   			</div>
		   			@endforeach


	   			</div>
	   		</div>
		</div>

@endsection