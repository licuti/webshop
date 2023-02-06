<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$meta_title}}</title>
    {{-- Meta Seo --}}

    <meta name="description" content="{{$meta_description}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="robots" content="noindex">
    <link rel="canonical" href="{{$meta_canonical}}">
    <link rel="icon" href="{{asset('public/frontend/images/LogoShop3.png')}}" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/webshopcss.css')}}">

    <link rel="stylesheet"  href="{{asset('public/frontend/css/lightslider.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.19/css/lightgallery.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    
    {{-- Slide banner --}}
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"> -->   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

</head>
<body>
    {{-- Thanh Nav Bar --}}
    @yield('navbar')

    <!-- Slide Image -->
    @yield('slider')

    <!-- Seach -->
    @yield('search')




    <div class="main-container"> 
        @yield('content')
    </div>




                

    <div class="footer">
        <div class="footer_logo">
            <img src="{{asset('public/frontend/images/LogoShop3.png')}}" alt="">
        </div>
        <div class="footer_content">
            <div class="ft ft1">
                <div class="ft_header">
                    <p> Hỗ trợ khách hàng</p>
                </div>
                <div class="ft_content ft1">
                    <a href="#">Hotline: <b>012345524</b></a>
                    <a href="#">Câu hỏi thường gặp</a>
                    <a href="#">Hướng dẫn đặt hàng</a>
                    <a href="#">Phương thức vận chuyển</a>
                    <a href="#">Chính sách đổi trả</a>
                    <a href="#">Hỗ trợ khách hàng: thucphamxanh@gmail.com</a>
                </div>
            </div>
            <div class="ft ft2">
                <div class="ft_header">
                    <p>Thực Phẩm Xanh</p>
                </div>
                <div class="ft_content ft2">
                    <a href="#">Giới thiệu Thực Phẩm Xanh</b></a>
                    <a href="#">Chính sách bảo mật thanh toán</a>
                    <a href="#">Điều khoản sử dụng</a>
                    <a href="#">Chính sách giải quyết khiếu nại</a>
                </div>
            </div>
            <div class="ft ft3">
                <div class="ft_header">
                    <p>Phương thức thanh toán</p>
                </div>
                <div class="ft_content ft3">
                    <img src="{{asset('public/frontend/images/logo_paypal.png')}}" alt="">
                    <img src="{{asset('public/frontend/images/logo_visa.png')}}" alt="">
                    <img src="{{asset('public/frontend/images/logo_zalopay.png')}}" alt="">
                    <img src="{{asset('public/frontend/images/logo_momo.png')}}" alt="">
                </div>
            </div>
            <div class="ft ft4">
                <div class="ft_header">
                    <p>Tải App về điện thoại</p>
                </div>
                <div class="ft_content ft4">
                    <a href="#"><img src="{{asset('public/frontend/images/AppStore.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('public/frontend/images/GooglePlay.png')}}" alt=""></a>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer_contact">
            <div class="ft_contact1">
                <p>Terms & Conditions</p>
                <p>Privicy Policy</p>
            </div>
            <div class="ft_contact2">
                <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i>
                <i class="fa fa-instagram fa-lg" aria-hidden="true"></i>
                <i class="fa fa-twitter fa-lg" aria-hidden="true"></i>
            </div>
            <div class="ft_contact3">
                <p>© Coppyright by Licuti</p>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/e48d8a69d4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.19/js/lightgallery-all.min.js"></script> 
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="brKD1Lss"></script>

    <script>
      var swiper = new Swiper(".mySwiper", {
        autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
              // Optional parameters

              loop: true,

              // If we need pagination
              pagination: {
              el: ".swiper-pagination",
              clickable: true,
        },

              // Navigation arrows
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },


      });
    </script>
    <script>
      var swiper = new Swiper(".my", {
        slidesPerView: 5,
        spaceBetween: 20,
        slidesPerGroup: 5,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
    <script>
         $(document).ready(function() {
            $('#table_id').DataTable({
                order: [[6, 'desc']],
            });
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem: 4,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }   
            });
            

            $('select').on('change',function(){
                var action = $(this).attr('id');
                var get_id = $(this).val();
                var _token = $('input[name=_token]').val();
                var result = '';

                if(action == 'city'){
                    result = 'district';
                }
                if(action == 'district'){
                    result = 'cwt';
                }
                $.ajax({
                    url: "{{url('/select-address-user')}}",
                    method: "post",
                    data: {
                        action:action,
                        get_id:get_id,
                        _token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });
            });



            $(document).on('click','.product_favorite',function(){
                var get_id_product = $(this).data('id_product');
                var get_id_user = $(this).data('id_user');
                var _token = $('input[name=_token]').val();
                if (get_id_user) {
                        $.ajax({
                        url: "{{url('/save-favourite')}}",
                        method: "post",
                        data: {
                            id_product:get_id_product,
                            id_user:get_id_user,
                            _token:_token},
                        success:function(data){
                            alert(data);
                        }
                    });
                    }else{
                        confirm('Bạn cần đăng nhập để thêm!!');
                    }

            });

            $(document).on('click','.paynow',function(){
                var get_id_product = $(this).data('id_product');
                var _token = $('input[name=_token]').val();
                $.ajax({
                url: "{{url('/add-paynow')}}",
                method: "post",
                data: {
                    id_product:get_id_product,
                    _token:_token},
                    success:function(data){
                        
                        location.assign("{{url('gio-hang')}}");
                    }
                });
            });

            $(document).on('click','.addcartnow',function(){
                var get_id_product = $(this).data('id_product');
                var _token = $('input[name=_token]').val();
                $.ajax({
                url: "{{url('/add-cartnow')}}",
                method: "post",
                data: {
                    id_product:get_id_product,
                    _token:_token},
                    success:function(data){
                        alert(data);
                    }
                });
            });

        });
    </script>
</body>
</html>