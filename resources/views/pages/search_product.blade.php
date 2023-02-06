@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection


@section('search')
@include('pages.include.search')
@endsection

@section('content')

    <div class="path">
            <Ul class="list_path">
                <li>Trang chủ</li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                <li class="path_color">Tìm kiếm sản phẩm</li>
            </Ul>
        </div>
    <div class="container">
                <div class="title_container">
                    <p>Kết quả tìm kiếm</p>
                </div>
                <div class="list_cards">
                    <div class="mgl20">{{$message}}</div>
                    @foreach($show_search_product as $key => $search_product)
                        <div class="card_product">
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$search_product->id_product)}}">
                                <div class="product_image">
                                    <div class="img">
                                        <img src="{{asset('public/images_upload/images_product/'.$search_product->image_product)}}" alt="">
                                    </div>
                                </div>
                                <div class="product_favorite">
                                    <i class="fas fa-heart fa-lg"></i>
                                </div>
                                <div class="card_content">
                                    <div class="product_title">
                                        {{$search_product->name_product}}
                                    </div>
                                    <div class="card_price">
                                        <div class="product_current_price">
                                            <div class="current_price">
                                            <?php
                                                if ($search_product->discount_product > 0) {
                                                    // code...
                                                $price = (float)$search_product->price_product;
                                                $percent = (float)$search_product->discount_product;
                                                $discount = $price - (($price * $percent) / 100);
                                                
                                                echo number_format($discount, 0, ',', '.').' VNĐ';
                                                }else{
                                                    echo number_format($search_product->price_product, 0, ',', '.').' VNĐ';
                                                }

                                            ?>       
                                            </div>
                                            <div class="discount_rate">
                                                <?php
                                                    if ($search_product->discount_product > 0) {
                                                        echo $search_product->discount_product.'%';
                                                    }else{
                                                        echo "";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="historical_price">
                                                    <?php
                                                        if ($search_product->discount_product > 0) {
                                                            echo number_format($search_product->price_product, 0, ',', '.').' VNĐ';
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
                                </a>
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
                        </div>
                    @endforeach
                </div>
                <div class="load_more">
                    {{-- <div class="btn_load_more">
                        Xem thêm
                    </div> --}}
                </div>  
            </div>
    <div class="container">
        <div class="title_container">
                    <p>Sản phẩm khuyến mãi</p>
        </div>
        <div class="slide_cards">
                    <div class="swiper my">
                        <div class="swiper-wrapper">
                            @foreach($show_hot_product as $key => $hot_product)
                            <div class="swiper-slide">
                                <div class="card_product" style="width: 100%;margin-left: 0px;">
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$hot_product->id_product)}}">
                            <div class="product_image">
                                <div class="img">
                                    <img src="{{asset('public/images_upload/images_product/'.$hot_product->image_product)}}" alt="">
                                </div>
                            </div>
                            <div class="product_favorite">
                                <i class="fas fa-heart fa-lg"></i>
                            </div>
                            <div class="card_content">
                                <div class="product_title">
                                    {{$hot_product->name_product}}
                                </div>
                                <div class="card_price">
                                    <div class="product_current_price">
                                        <div class="current_price">
                                        <?php
                                            if ($hot_product->discount_product > 0) {
                                                // code...
                                            $price = (float)$hot_product->price_product;
                                            $percent = (float)$hot_product->discount_product;
                                            $discount = $price - (($price * $percent) / 100);
                                            
                                            echo number_format($discount, 0, ',', '.').' VNĐ';
                                            }else{
                                                echo number_format($hot_product->price_product, 0, ',', '.').' VNĐ';
                                            }

                                        ?>       
                                        </div>
                                        <div class="discount_rate">
                                            <?php
                                                if ($hot_product->discount_product > 0) {
                                                    echo $hot_product->discount_product.'%';
                                                }else{
                                                    echo "";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="historical_price">
                                                <?php
                                                    if ($hot_product->discount_product > 0) {
                                                        echo number_format($hot_product->price_product, 0, ',', '.').' VNĐ';
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