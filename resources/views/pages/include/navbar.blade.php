<div class="navbar_header" onmouseleave="hidesubmenu()">
    <div class="navbar">
        <div class="navbar_logo">
            <div class="navlogo">
                <img src="{{asset('public/frontend/images/LogoShop3.png')}}" alt="" class="image">
            </div>
        </div>
        <div class="navbar_link">
            <div class="link_items">
                <a href="{{URL::to('/trang-chu')}}" class="link_hover">Trang chủ</a>
            </div>
            <div class="link_items">
                <a href="" class="link_hover">Giới thiệu</a>
            </div>
            <div class="link_items">
                <a href="{{URL::to('/cam-nang-cham-soc')}}" class="link_hover">Cẩm nang chăm sóc</a>
            </div>
            <?php
                $id_user = Session::get('id_user');
                $avatar_user = Session::get('avatar_user');
                if ($id_user != '' && $avatar_user != '') {
            ?>
            <div class="link_items">
                <a href="{{URL::to('/thanh-toan-hoa-don')}}" class="link_hover">Thanh toán giỏ hàng</a>
            </div>
            <?php
                }else{
            ?> 
            <div class="link_items">
                <a href="{{URL::to('/dang-nhap')}}" class="link_hover">Thanh toán giỏ hàng</a>
            </div>
            <?php
                }
            ?>

        </div>
        <div class="navbar_user">
            <div class="nav_user_items">
                <a href="" class="text_none link_hover">
                    <i class="fa fa-bell-o fa-lg" aria-hidden="true"></i>
                    <div class="notifice"></div>
                </a>
            </div><div class="nav_user_items mgl30">
                <a href="{{URL::to('/san-pham-yeu-thich')}}" class="text_none link_hover">
                    <i class="fa fa-heart-o fa-lg" aria-hidden="true"></i>
                </a>
            </div>
            <div class="nav_user_items mgl30">
                <a href="{{URL::to('/gio-hang')}}" class="text_none link_hover"><i class="fa fa-shopping-basket fa-lg" aria-hidden="true"></i>({{Cart::count()}})</a>
            </div>
            <div class="nav_user_items mgl30">
                <?php
                    $id_user = Session::get('id_user');
                    $avatar_user = Session::get('avatar_user');
                    if ($id_user != '' && $avatar_user != '') {
                ?>

                <!-- Đang đănp nhập -->
                <div class="nav_user_loggin" onclick="showsubmenu()">
                    <div class="nav_avatar">
                        <img src="{{$avatar_user}}" alt="" class="image avatar_radius">
                    </div>
                    <i class="fa fa-caret-down fa-lg mgl5" aria-hidden="true"></i>
                </div>  
                <?php
                }else{

                ?>      
                <!-- chưa đăng nhập  -->
                <div class="nav_user_loggin">
                    <div class=""><a href="{{URL::to('/dang-nhap')}}" class="text_none link_hover">Đăng nhập</a></div>
                    <div class="mgl5"><a href="">|</a></div>
                    <div class="mgl5"><a href="{{URL::to('/dang-ky')}}" class="text_none link_hover">Đăng ký</a></div>
                </div>

                <?php
                    }
                ?>
                <div class="submenu" id="submenu" onmouseleave="hidesubmenu()">
                            <div class="list_sub">
                                <a href="">
                                    <div class="sub_item" class="text_none">
                                        <i class="fa fa-user mgr5" aria-hidden="true "></i>
                                        {{Session::get('id_user')}}
                                    </div>
                                </a>
                                <a href="{{URL::to('thong-tin-ca-nhan')}}">
                                    <div class="sub_item" class="text_none">
                                        <i class="fa fa-user mgr5" aria-hidden="true "></i>
                                        Thông tin cá nhân
                                    </div>
                                </a>
                                <a href="{{URL::to('don-hang-cua-toi')}}">
                                    <div class="sub_item" class="text_none">
                                        <i class="fa fa-shopping-bag mgr5" aria-hidden="true"></i>
                                        Đơn hàng của tôi
                                    </div>
                                </a>
                                <a href="" class="text_none">
                                    <div class="sub_item">
                                        <i class="fa fa-question-circle mgr5" aria-hidden="true"></i>
                                        Hỗ trợ
                                    </div>
                                </a>
                                <a href="{{URL::to('/logout')}}" class="text_none">
                                    <div class="sub_item">
                                        <i class="fa fa-sign-out mgr5" aria-hidden="true"></i>
                                        Đăng xuất
                                    </div>
                                </a>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript" language="javascript">
        function showsubmenu(){
            var sub_menu = document.getElementById("submenu").style.display;

            if(sub_menu == ''){
                document.getElementById('submenu').style.display = 'block';
            }
            else{
                document.getElementById('submenu').style.display = '';
            }
        }
        function hidesubmenu(){
            document.getElementById('submenu').style.display = '';
        }
    </script>