@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection

@section('content')
			<div class="path">
			<Ul class="list_path">
				<li>Trang chủ</li>
				<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				<li class="path_color">Sản phẩm yêu thích của tôi</li>
			</Ul>
		</div>

    	<div class="container" style="background-color: #f8f8f8;">
		    <div class="shopping_cart">
		   		<div class="list_shopping_cart">

		   			@if($favourite == '')
		   			Không có sản phẩm yêu thích nào
		   			@else
			   			@foreach($favourite as $key => $favou)
				   			<div class="item_shopping_cart">
				   				<a href="{{URL::to('chi-tiet-san-pham/'.$favou->product->id_product)}}">
				   				<div class="image_shopping_cart">
				   					<img src="{{asset('public/images_upload/images_product/'.$favou->product->image_product)}}" alt="">
				   				</div>
				   				<div class="content_shopping_cart">
				   					<div class="detail_category">Danh mục: <span>{{$favou->product->category->name_category}}</span></div>
				   					<div class="shopping_cart_name">{{$favou->product->name_product}}</div>
				   					<div class="shopping_cart_price">
										<div class="shopping_cart_price_discount">
											<?php
				                                if ($favou->product->discount_product > 0) {
				                                    // code...
				                                $price = (float)$favou->product->price_product;
				                                $percent = (float)$favou->product->discount_product;
				                                $discount = $price - (($price * $percent) / 100);
				                                
				                                echo number_format($discount, 0, ',', '.').' VNĐ';
				                                }else{
				                                    echo number_format($favou->product->price_product, 0, ',', '.').' VNĐ';
				                                }?>
				                                {{-- {{number_format($favou->product->price_product).' VNĐ'}} --}}
										</div>
										<div class="shopping_cart_discount">
											<?php
				                                if ($favou->product->discount_product > 0) {
				                                    echo $favou->product->discount_product.'%';
				                                }else{
				                                    echo "";
				                                }
				                            ?>
										</div>
									</div>
									<div class="detail_price">
										{{number_format($favou->product->price_product, 0, ',', '.').' VNĐ';}}
									</div>
									<div class="product_evaluate">
	                                    <i class="fas fa-star"></i>
	                                    <i class="fas fa-star"></i>
	                                    <i class="fas fa-star"></i>
	                                    <i class="fa fa-star-o" aria-hidden="true"></i>
	                                    <i class="fa fa-star-o" aria-hidden="true"></i>
	                                </div>
	                                <div class="">Số lượng: <span>{{$favou->product->sales_product}}</span></div>
				   				</div>
				   				<div class="delete_shopping_cart">
				   					<a href="{{URL::to('/delete-favourite/'.$favou->product->id_product)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
				   				</div>
				   			</a>
				   			</div>
			   			@endforeach
			   		@endif
		   		</div>




		 
		    </div>
		</div>
@endsection