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

    		{{-- <div class="">
                <p style="text-align: center;font-size:20pt; color: #56924C;">{{$getBlog->title_blog}}</p>
            </div>
    		<div class="mg30">
		   		{!!$getBlog->content_blog!!}
		   	</div> --}}


		   	<div style=" display: flex; margin: 0px 30px;">
	   			<div style="width: 25%; margin-top: 30px;">
	   				<div id="fb-root">
		   					<div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100087957230626" data-tabs="timeline, events, messages" data-width="500" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
		   				</div>
	   			</div>
	   			<div style="display:flex; flex-wrap: wrap;flex: 1;margin-left: 20px;">

	   				<div class="mgl20">
		                <p style="font-size:20pt; color: #56924C;">{{$getBlog->title_blog}}</p>
		            </div>
	   				<div class="content_blog">
	   					{!!$getBlog->content_blog!!}
	   				</div>


	   			</div>
	   		</div>



		</div>

@endsection 