@extends('welcome')

@section('navbar')
@include('pages.include.navbar')
@endsection

@section('slider')
@include('pages.include.slider')
@endsection

@section('search')
@include('pages.include.search')
@endsection

@section('content')
<div class="container">
            <div class="title_container">
                <p>Danh mục sản phẩm</p>
            </div>
            <div class="content_container">

                @foreach($show_category_index as $key => $show_cate_index)
                <div class="item_category">
                    <a href="{{URL::to('/danh-muc-san-pham/'.$show_cate_index->slug_category.'/'.$show_cate_index->id_category)}}">
                        <div class="img_category">
                            <div class="img_cate">
                                <img src="{{asset('public/images_upload/images_category/'.$show_cate_index->image_category)}}" alt="Danh mục 1">
                            </div>
                        </div>
                        <div class="name_category">
                            <p>{{$show_cate_index->name_category}}</p>
                        </div>
                    </a>
                </div>
                @endforeach



            </div>
        </div>
<div class="container">
            <div class="title_container">
                
                <p>
                    <?php
                        echo 'Danh mục '.strtolower($name_category);
                    ?>
                </p>
   
            </div>
            <div class="list_cards">
                <div class="mgl20">{{$message_null}}</div>
                @foreach($get_category_list_product as $key => $category_product)
                    <div class="card_product">
                        <div class="product_favorite" id="{{'suggest'.$category_product->id_product}}" data-id_product="{{$category_product->id_product}}" data-id_user="{{Session::get('id_user')}}">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                    <a href="{{URL::to('/chi-tiet-san-pham/'.$category_product->slug_product.'/'.$category_product->id_product)}}">
                        <div class="product_image">
                            <div class="img">
                                <img src="{{asset('public/images_upload/images_product/'.$category_product->image_product)}}" alt="">
                            </div>
                        </div>
                        {{-- <div class="product_favorite">
                            <i class="fas fa-heart fa-lg"></i>
                        </div> --}}
                        <div class="card_content">
                            <div class="product_title">
                                {{$category_product->name_product}}
                            </div>
                            <div class="card_price">
                                <div class="product_current_price">
                                    <div class="current_price">
                                    <?php
                                        if ($category_product->discount_product > 0) {
                                            // code...
                                        $price = (float)$category_product->price_product;
                                        $percent = (float)$category_product->discount_product;
                                        $discount = $price - (($price * $percent) / 100);
                                        
                                        echo number_format($discount, 0, ',', '.').' VNĐ';
                                        }else{
                                            echo number_format($category_product->price_product, 0, ',', '.').' VNĐ';
                                        }

                                    ?>       
                                    </div>
                                    <div class="discount_rate">
                                        <?php
                                            if ($category_product->discount_product > 0) {
                                                echo $category_product->discount_product.'%';
                                            }else{
                                                echo "";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="historical_price">
                                            <?php
                                                if ($category_product->discount_product > 0) {
                                                    echo number_format($category_product->price_product, 0, ',', '.').' VNĐ';
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
                                <div class="btn_add_product addcartnow" data-id_product="{{$category_product->id_product}}">
                                    <div class="logo_btn_add_product">
                                        <i class="fas fa-cart-plus"></i>
                                    </div>
                                    Thêm giỏ hàng
                                </div>
                                <div class="btn_buy_product paynow" data-id_product="{{$category_product->id_product}}" >
                                    Mua Ngay
                                </div>
                            </div>
                    </div>
                @endforeach

            </div>
            <div class="load_more">
                <div class="btn_load_more">
                    Xem thêm
                </div>
            </div>  
        </div>
<div class="container">
    <div class="title_container">
                <p>Sản phẩm khuyến mãi nhiều nhất</p>
    </div>
    <div class="slide_cards">
                <div class="swiper my">
                    <div class="swiper-wrapper">
                        @foreach($show_hot_product as $key => $hot_product)
                        <div class="swiper-slide">
                            <div class="card_product" style="width: 100%;margin-left: 0px;">
                                <div class="product_favorite" id="{{'suggest'.$hot_product->id_product}}" data-id_product="{{$hot_product->id_product}}" data-id_user="{{Session::get('id_user')}}">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </div>
                    <a href="{{URL::to('/chi-tiet-san-pham/'.$hot_product->slug_product.'/'.$hot_product->id_product)}}">
                        <div class="product_image">
                            <div class="img">
                                <img src="{{asset('public/images_upload/images_product/'.$hot_product->image_product)}}" alt="">
                            </div>
                        </div>
                        {{-- <div class="product_favorite">
                            <i class="fas fa-heart fa-lg"></i>
                        </div> --}}
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
                        
                    </a>
                    <div class="card_button">
                                <div class="btn_add_product addcartnow" data-id_product="{{$hot_product->id_product}}">
                                    <div class="logo_btn_add_product">
                                        <i class="fas fa-cart-plus"></i>
                                    </div>
                                    Thêm giỏ hàng
                                </div>
                                <div class="btn_buy_product paynow" data-id_product="{{$hot_product->id_product}}" >
                                    Mua Ngay
                                </div>
                            </div>
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