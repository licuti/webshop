@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection

@section('content')
	@foreach($show_detail_product as $key => $show_detail)
		<div class="path">
			<Ul class="list_path">
				<li>Trang chủ</li>
				<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				<li>{{$show_detail->name_category}}</li>
				<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				<li class="path_color">{{$show_detail->name_product}}</li>
			</Ul>
		</div>
		<div class="container">	
			<div class="detail">
				<div class="image_detail">
					{{-- <div class=" image_active">
						<img src="{{asset('public/images_upload/images_product/'.$show_detail->image_product)}}" alt="">
					</div>
					<div class="image_unactive">
						<div class="item_image_unactive">
							<img src="{{asset('public/images_upload/images_product/'.$show_detail->image_product)}}" alt="">
						</div>
						<div class="item_image_unactive imgae_iteam1">
							<img src="{{asset('public/images_upload/images_product/'.$show_detail->image_product)}}" alt="">
						</div>
						<div class="item_image_unactive imgae_iteam2">
							<img src="{{asset('public/images_upload/images_product/'.$show_detail->image_product)}}" alt="">
						</div>
						<div class="item_image_unactive">
							<img src="{{asset('public/images_upload/images_product/'.$show_detail->image_product)}}" alt="">
						</div>
					</div> --}}
					<ul id="imageGallery" class="gallery list-unstyled" style="list-style: none outside none;margin: 0;padding: 0;">
						@foreach($show_gallery as $gallery)
	                    
	                    <li data-thumb="{{asset('public/images_upload/images_gallery/'.$gallery->link_gallery)}}" data-src="{{asset('public/images_upload/images_gallery/'.$gallery->link_gallery)}}"> 
	                        <img src="{{asset('public/images_upload/images_gallery/'.$gallery->link_gallery)}}" alt="{{$gallery->name_gallery}}" />
	                    </li>
	                    @endforeach
	                </ul>


				</div>
				<div class="content_detail">
					<div class="detail_category">Danh mục: <span>{{$show_detail->name_category}}</span></div>
					<div class="detail_name">{{$show_detail->name_product}}</div>
					
					<div class="detail_evaluate_sales">
						<div class="detail_evaluate">
							<span>Đánh giá: </span>
							<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
						</div>
						<div class="detail_sales">Số lượng: <span>{{$show_detail->sales_product}}</span></div>
					</div>
					<div class="detail_discount_price">
						<div class="detail_price_current">
							<?php
                                if ($show_detail->discount_product > 0) {
                                    // code...
                                $price = (float)$show_detail->price_product;
                                $percent = (float)$show_detail->discount_product;
                                $discount = $price - (($price * $percent) / 100);
                                
                                echo number_format($discount, 0, ',', '.').' VNĐ';
                                }else{
                                    echo number_format($show_detail->price_product, 0, ',', '.').' VNĐ';
                                }

                            ?>       
                        </div>
						<div class="detail_discount">
							<?php
                                if ($show_detail->discount_product > 0) {
                                    echo $show_detail->discount_product.'%';
                                }else{
                                    echo "";
                                }
                            ?>
						</div>
					</div>
					<div class="detail_price">
						<?php
                            if ($show_detail->discount_product > 0) {
                                echo number_format($show_detail->price_product, 0, ',', '.').' VNĐ';
                            }else{
                                echo '';
                            }
                            
                        ?>
					</div>
					<div class="detail_describe">
						<div>Mô tải sản phẩm:</div>
						<p>{!!$show_detail->describe_product!!}</p>
					</div>

					<form action="{{URL::to('/save-shopping-cart')}}" method="post">
					{{csrf_field()}}

					<div class="detail_button_number">
						<div class="button_number" onclick="down()">
							<i class="fa fa-minus-square-o fa-2x" aria-hidden="true"></i>
						</div>
						<div class="button_number">
							<input type="text" name="quantinty_product" value="1"  width="3" id="number" onchange="change_number()">
							<input type="hidden" name="quantinty_product_hiden" value="{{$show_detail->id_product}}">
						</div>
						<div class="button_number" onclick="up()">
							<i class="fa fa-plus-square-o fa-2x" aria-hidden="true"></i>
						</div>
						<script type="text/javascript">
							function down(){
						        var current = document.getElementById("number").value;
						        if(current > 1){
						        var last_number = parseInt(current) - 1;
						        document.getElementById('number').value = last_number;
						        }
						    }
						    function up(){
						        var current = document.getElementById("number").value;
						        var last_number = parseInt(current) + 1;
						    	document.getElementById('number').value = last_number;
						    }
						    function change_number(){
						        var current = document.getElementById("number").value;
						        if(current < 1){
						        document.getElementById('number').value = "1";
						        }
						    }
						</script>
					</div>
					<div class="detail_button_buy">
						<button type="submit" class="button_buy"><i class="fas fa-cart-plus"></i>Thêm giỏ hàng</button>
						
						<button type="submit" class="button_buy">Mua ngay</button>
					</div>
					</form>


				</div>
			</div>
			
		</div>
		<div class="container">
		    <div class="title_container">
		        <p>Chi tiết sản phẩm</p>
		    </div>
		    <div class="information_product">
		   		<div>{!!$show_detail->detail_product!!}
				</div>
		    </div>
    	</div>
    @endforeach

    	{{-- comment  --}}
    	<div class="container">
		    <div class="title_container">
		        <p>Nhận xét - Đánh giá</p>
		    </div>
		    <div class="comment_product">
		    	<form>
					<div class="user_comment">
						<div class="avt_user_comment">
							<img src="{{asset('public/frontend/images/avatar.jpg')}}" alt="">
						</div>
						<div class="content_user_comment">
							<textarea placeholder="Nhập nội dung phản hồi"></textarea>
							<input type="file" name="">
							<div class="list_image_comment">
								<!-- <div class="image_comment">
									<img src="sanpham1.jpg" alt="">
								</div>
								<div class="image_comment">
									<img src="sanpham1.jpg" alt="">
								</div>
								<div class="image_comment">
									<img src="sanpham1.jpg" alt="">
								</div> -->
							</div>
						</div>
					</div>
					<div class="button_comment">
						<button class="button">Đăng</button>
					</div>
				</form>
				<div class="list_comment">
					<hr width="100%">
					<div class="infor_comment">
						<div class="left_comment">
							<div class="avt_user_comment">
								<img src="{{asset('public/frontend/images/avatar.jpg')}}" alt="">
							</div>
						</div>
						<div class="right_comment">
							<div class="top_comment">
								<div class="left_cmt">
									<div class="name_cmt">
										<div>Nguyễn Xuân Linh</div>
										<div class="detail_evaluate">
											<i class="fas fa-star"></i>
				                            <i class="fas fa-star"></i>
				                            <i class="fas fa-star"></i>
				                            <i class="fa fa-star-o" aria-hidden="true"></i>
				                            <i class="fa fa-star-o" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<div class="right_cmt">
									<div class="date_cmt"><i>22-9-2022</i></div>
									<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
								</div>
							</div>
							<div class="mid_comment">
								<div class="content_comment">
									<p>Cây quấn gốc cẩn thận qua vận chuyển nhưng vẫn giữ được nguyên lá k hề bị bầm dập. Cây nhiều rễ cắm vào bể yên tâm , chủ shop có tâm với sản phẩm với khách hàng. Cảm ơn sự phục vụ của shop ❤️</p>
								</div>
							</div>
							<div class="bot_comment">
								<div class="rep_comment">Phản hồi</div>
								<div class="like_comment"><i class="fa fa-heart" aria-hidden="true"></i> 324</div>
							</div>
						</div>
					</div>
		    	</div>
		    	<div class="list_comment">
					<hr width="100%">
					<div class="infor_comment">
						<div class="left_comment">
							<div class="avt_user_comment">
								<img src="{{asset('public/frontend/images/avatar.jpg')}}" alt="">
							</div>
						</div>
						<div class="right_comment">
							<div class="top_comment">
								<div class="left_cmt">
									<div class="name_cmt">
										<div>Nguyễn Xuân Linh</div>
										<div class="detail_evaluate">
											<i class="fas fa-star"></i>
				                            <i class="fas fa-star"></i>
				                            <i class="fas fa-star"></i>
				                            <i class="fa fa-star-o" aria-hidden="true"></i>
				                            <i class="fa fa-star-o" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<div class="right_cmt">
									<div class="date_cmt"><i>22-9-2022</i></div>
									<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
								</div>
							</div>
							<div class="mid_comment">
								<div class="content_comment">
									<p>Cây quấn gốc cẩn thận qua vận chuyển nhưng vẫn giữ được nguyên lá k hề bị bầm dập. Cây nhiều rễ cắm vào bể yên tâm , chủ shop có tâm với sản phẩm với khách hàng. Cảm ơn sự phục vụ của shop ❤️</p>
								</div>
							</div>
							<div class="bot_comment">
								<div class="rep_comment">Phản hồi</div>
								<div class="like_comment"><i class="fa fa-heart" aria-hidden="true"></i> 324</div>
							</div>
							<div class="feedback_comment">
								<div class="bgr_feedback">
								</div>
								<div class="content_feedback">Feedback siêu chân thực ạ, đẹp đến từng cm ạ ... vì fback đẹp quá shop khác lấy ảnh này về xong đăng bán như thật ạ :(( Hàng đặc biệt chỉ có tại Juminhome thôi ạ. Cảm ơn bạn đã mua hàng tại Juminhome Decor. Hy vọng bạn tiếp tục ủng hộ shop nhiều sản phẩm hơn nữa ạ. Trong quá trình sử dụng, bạn có bất cứ vấn đề nào về sản phẩm hãy Inbox hoặc liên hệ HOTLINE: 0983948813 gặp đội ngũ tư vấn để được hỗ trợ giải đáp kịp thời nhất nha 💛</div>
							</div>
						</div>
					</div>
		    	</div>
		    	<div class="list_comment">
					<hr width="100%">
					<div class="infor_comment">
						<div class="left_comment">
							<div class="avt_user_comment">
								<img src="{{asset('public/frontend/images/avatar.jpg')}}" alt="">
							</div>
						</div>
						<div class="right_comment">
							<div class="top_comment">
								<div class="left_cmt">
									<div class="name_cmt">
										<div>Nguyễn Xuân Linh</div>
										<div class="detail_evaluate">
											<i class="fas fa-star"></i>
				                            <i class="fas fa-star"></i>
				                            <i class="fas fa-star"></i>
				                            <i class="fa fa-star-o" aria-hidden="true"></i>
				                            <i class="fa fa-star-o" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<div class="right_cmt">
									<div class="date_cmt"><i>22-9-2022</i></div>
									<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
								</div>
							</div>
							<div class="mid_comment">
								<div class="content_comment">
									<p>Cây quấn gốc cẩn thận qua vận chuyển nhưng vẫn giữ được nguyên lá k hề bị bầm dập. Cây nhiều rễ cắm vào bể yên tâm , chủ shop có tâm với sản phẩm với khách hàng. Cảm ơn sự phục vụ của shop ❤️</p>
								</div>
							</div>
							<div class="bot_comment">
								<div class="rep_comment">Phản hồi</div>
								<div class="like_comment"><i class="fa fa-heart" aria-hidden="true"></i> 324</div>
							</div>
						</div>
					</div>
		    	</div>
		    </div>
		</div>

		{{-- Sản phẩm liên quan --}}
		<div class="container">
        <div class="title_container">
        	<p>Sản phẩm liên quan</p>
        </div>
        <div class="slide_cards">
                    <div class="swiper my">
                        <div class="swiper-wrapper">
                            @foreach($related_product as $key => $related)
                            <div class="swiper-slide">
                                <div class="card_product" style="width: 100%;margin-left: 0px;">
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$related->id_product)}}">
                            <div class="product_image">
                                <div class="img">
                                    <img src="{{asset('public/images_upload/images_product/'.$related->image_product)}}" alt="">
                                </div>
                            </div>
                            <div class="product_favorite">
                                <i class="fas fa-heart fa-lg"></i>
                            </div>
                            <div class="card_content">
                                <div class="product_title">
                                    {{$related->name_product}}
                                </div>
                                <div class="card_price">
                                    <div class="product_current_price">
                                        <div class="current_price">
                                        <?php
                                            if ($related->discount_product > 0) {
                                                // code...
                                            $price = (float)$related->price_product;
                                            $percent = (float)$related->discount_product;
                                            $discount = $price - (($price * $percent) / 100);
                                            
                                            echo number_format($discount, 0, ',', '.').' VNĐ';
                                            }else{
                                                echo number_format($related->price_product, 0, ',', '.').' VNĐ';
                                            }

                                        ?>       
                                        </div>
                                        <div class="discount_rate">
                                            <?php
                                                if ($related->discount_product > 0) {
                                                    echo $related->discount_product.'%';
                                                }else{
                                                    echo "";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="historical_price">
                                                <?php
                                                    if ($related->discount_product > 0) {
                                                        echo number_format($related->price_product, 0, ',', '.').' VNĐ';
                                                    }else{
                                                        echo '';
                                                    }
                                                    
                                                ?>
                                            </div>
                                </div>
                                            
                                <div class="product_evaluate">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        </div>
                                
                            </div>
                            <div class="card_button">
                                    <div class="btn_add_product">
                                        <div class="logo_btn_add_product">
                                            <i class="fas fa-cart-plus"></i>
                                        </div>
                                        Thêm giỏ hàng
                                    </div>
                                    <div class="btn_buy_product">
                                        Mua Ngay
                                    </div>
                                </div>
                        </a>
                    </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
        </div> 

@endsection