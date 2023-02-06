<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\ModelCodeDiscount;
use App\Models\ModelUserSocial;
use App\Models\ModelUser;
use App\Models\ModelBill;
use App\Models\ModelProduct;

use App\Models\ModelCity;
use App\Models\ModelDistrict;
use App\Models\ModelCommuneWardTown;
use App\Models\ModelShippingFees;
use App\Models\ModelAddressUser;

use App\Models\ModelVnPay;

use Socialite;


session_start();


class Checkout extends Controller
{
    /*Đăng nhập thanh toán */
    public function ShowLogin(Request $request){
        /*Meta Seo*/
        $meta_title = "Đăng nhập | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();
        return view('pages.login.login', compact('meta_title','meta_description','meta_keywords','meta_canonical'));
    }
    public function ShowRegister(Request $request){

        $get_city = ModelCity::all();
        /*Meta Seo*/
        $meta_title = "Đăng ký | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();
        return view('pages.login.register', compact('meta_title','meta_description','meta_keywords','meta_canonical','get_city'));
    }
    public function AddUser(Request $request){
        $data = array();
        $data['username'] = $request->username;
        $data['password'] = md5($request->password);
        $data['fullname_user'] = $request->fullname_user;
        $data['email_user'] = $request->email_user;
        $data['phone_user'] = $request->phone_user;
        $data['address_user'] = $request->address_user;
        $data['avatar_user'] = 'https://thuvienplus.com/themes/cynoebook/public/images/default-user-image.png';
        $data['status_user'] = 'Đang kích hoạt';
        $get_id = DB::table('user')->insertGetId($data);

        $address_user = new ModelAddressUser([
               'id_user' => $get_id,
               'id_city' => $request->select_city,
               'id_district' => $request->select_district,
               'id_cwt' => $request->select_cwt,
               'street_address' => $request->select_street
            ]);
        $address_user->save();


        return Redirect::to('dang-nhap');
        /*$get_id_user = DB::table('user')->insertGetId($data);
        Session::put('id_user',$get_id_user);
        Session::put('avatar_user',$get_id_user->avatar_user);
        return Redirect('/thanh-toan-hoa-don');*/
    }


    public function Login(Request $request){
        $username = $request->username;
        $password = md5($request->password);
        $user = DB::table('user')->where('username', $username)->where('password', $password)->first();
        if ($user) {
            Session::put('id_user',$user->id_user);
            Session::put('avatar_user',$user->avatar_user);
            return Redirect::to('/trang-chu');
        }else{
            Session::put('message','Tài khoản hoặc mật khẩu không đúng!');
            return Redirect::to('dang-nhap');
        }
    }
    public function Logout(){
        Session::flush();

        Session::put('id_user', null);
        Session::put('avatar_user', null);
        Session::put('shipping_fee', null);
        return Redirect::to('/trang-chu');
    }



    public function LoginFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function CallbackFacebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = ModelUserSocial::where('provider','facebook')->where('id_user_provider',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $get_db_user = ModelUser::where('id_user',$account->id_user_social)->first();
            Session::put('id_user',$get_db_user->id_user);
            Session::put('avatar_user',$get_db_user->avatar_user);
            return redirect('/trang-chu');
        }else{

            $user_social = new ModelUserSocial([
                'id_user_provider' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = ModelUser::where('email_user',$provider->getEmail())->first();

            if(!$orang){
                $orang = ModelUser::create([
                    'username' => $provider->getEmail(),
                    'password' => '',
                    'fullname_user' => $provider->getName(),
                    'avatar_user' => $provider->getAvatar(),
                    'email_user' => $provider->getEmail(),
                    'phone_user' => '',
                    'address_user' => '',
                    'status_user' => 'Đang kích hoạt',
                ]);
            }
            $user_social->login()->associate($orang);
            $user_social->save();

            $get_db_user = ModelUser::where('id_user',$user_social->id_user_social)->first();

            $address_user = new ModelAddressUser([
               'id_user' => $get_db_user->id_user,
               'id_city' => 0,
               'id_district' => 0,
               'id_cwt' => 0,
               'street_address' =>''
            ]);
            $address_user->save();

            Session::put('id_user',$get_db_user->id_user);
            Session::put('avatar_user',$get_db_user->avatar_user);
            return redirect('/trang-chu');
        } 
    }


    public function LoginGoogle(){
        return Socialite::driver('google')->redirect();
   }
   public function CallbackGoogle(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        if ($authUser) {
            $account_name = ModelUser::where('id_user',$authUser->id_user_social)->first();
            Session::put('id_user',$account_name->id_user);
            Session::put('avatar_user',$account_name->avatar_user);
            
        }elseif($user_social){
            $account_name = ModelUser::where('id_user',$authUser->id_user_social)->first();
            Session::put('id_user',$user_social->id_user);
            Session::put('avatar_user',$user_social->avatar_user);
        }
        return redirect('/trang-chu');
        
       
    }
    public function findOrCreateUser($users,$provider){
        $get_user = ModelUserSocial::where('id_user_provider', $users->id)->first();
        if($get_user){

            return $get_user;
        }else{
      
            $user_social = new ModelUserSocial([
                'id_user_provider' => $users->id,
                'provider' => $provider
            ]);

            $orang = ModelUser::where('email_user',$users->email)->first();
            if(!$orang){
                $orang = ModelUser::create([
                    'username' => $users->email,
                    'password' => '',
                    'fullname_user' => $users->name,
                    'avatar_user' => $users->avatar,
                    'email_user' => $users->email,
                    'phone_user' => '',
                    'address_user' => '',
                    'status_user' => 'Đang kích hoạt',
                ]);
            }
            $user_social->login()->associate($orang);
            $user_social->save();

            $get_db_user = ModelUser::where('id_user',$user_social->id_user_social)->first();

            $address_user = new ModelAddressUser([
               'id_user' => $get_db_user->id_user,
               'id_city' => 0,
               'id_district' => 0,
               'id_cwt' => 0,
               'street_address' =>''
            ]);
            $address_user->save();

            /*$get_db_user = ModelUser::where('id_user',$user_social->id_user_social)->first();
            Session::put('id_user',$get_db_user->id_user);
            Session::put('avatar_user',$get_db_user->avatar_user);
            return redirect('/trang-chu');*/
            return $user_social;
        }

    }




    public function ShowInforUser(Request $request){

        $get_db_user = ModelUser::find(Session::get('id_user'));
        $get_db_address = ModelAddressUser::where('id_user',Session::get('id_user'))->first();
        $get_city = ModelCity::all();
        $get_district = ModelDistrict::where('id_city',$get_db_address->id_city)->get();
        $get_cwt = ModelCommuneWardTown::where('id_district', $get_db_address->id_district)->get();
        
        $meta_title = "Thông tin cá nhân | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();
        return view('pages.information_user',compact('meta_title','meta_description','meta_keywords','meta_canonical','get_db_user','get_db_address','get_city','get_district','get_cwt'));
    }


    public function SelectAddressUser(Request $request){
        $data = $request->all();

        $get_db_address = ModelAddressUser::where('id_user',Session::get('id_user'))->first();

        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_district = ModelDistrict::where('id_city', $data['get_id'])->orderby('id_district','asc')->get();
                $output .= "<option value='0'>Chọn quận huyện</option>";
                foreach ($select_district as $key => $district) {
                    $output .= "<option value='".$district->id_district."'>".$district->name_district."</option>";
                }
            }else{
                $select_cwt = ModelCommuneWardTown::where('id_district', $data['get_id'])->orderby('id_cwt','asc')->get();
                $output .= "<option value='0'>Chọn xã, phương, thị trấn</option>";
                foreach ($select_cwt as $key => $cwt) {
                    $output .= "<option value='".$cwt->id_cwt."'>".$cwt->name_cwt."</option>";
                }
            }
        }
        echo $output;

    }

    public function SaveInforUser(Request $request){
        $data = $request->all();

        $update_user = ModelUser::find(Session::get('id_user'));
        $update_address = ModelAddressUser::where('id_user',Session::get('id_user'))->first();

        $update_user->fullname_user = $data['fullname_user'];
        $update_user->email_user = $data['email_user'];
        $update_user->phone_user = $data['phone_user'];

        $update_user->save();

        $update_address->id_city = $data['select_city'];
        $update_address->id_district = $data['select_district'];
        $update_address->id_cwt = $data['select_cwt'];
        $update_address->street_address = $data['select_street'];
        $update_address->save();
        return Redirect()->back();

    }

    public function ShowMyOrder(Request $request){

        if (Session::get('id_user')) {
            
            if (ModelBill::where('id_user', Session::get('id_user'))) {

                $getBill = ModelBill::where('id_user', Session::get('id_user'))->get();
            }else{
                $getBill == "";
            }

            $meta_title = "Đơn hàng của tôi | Cửa hàng xanh";
            $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
            $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
            $meta_canonical = $request->url();
            return view('pages.my_order', compact('meta_title','meta_description','meta_keywords','meta_canonical','getBill'));
        
            }else{
                Session::put('message','Bạn cần phải đăng nhập để xem!');
                return Redirect::to('dang-nhap');
        }
    }

    public function DeleteMyBill($link_id_bill){
        if (Session::get('id_user')) {
            $bill = ModelBill::find($link_id_bill);
            $bill->delete();
            return Redirect()->back();  
        }else{
            Session::put('message','Bạn cần phải đăng nhập để xóa!');
            return Redirect::to('dang-nhap');
        }
    }






    public function ShowCheckout(Request $request){

        //lấy dữ liệu từ dtb cho trang
        $get_db_user = ModelUser::find(Session::get('id_user'));

        //kiểm tra xem tài khoản đã có điền thông tin địa chỉ chưa
        $get_db_address = ModelAddressUser::where('id_user',Session::get('id_user'))->where('id_city','>', 0)->first();

        //
        if (Session::get('id_user')) {
            /*lấy thông tin địa chỉ của tài khoản*/
            $get_address_user = ModelAddressUser::where('id_user',Session::get('id_user'))->first();
            // lấy giá tiền thông qua id xã phường của tài khoan
            $get_fee = ModelShippingFees::where('cwt_fee',$get_address_user->id_cwt)->first();
            if ($get_fee) {
                if (Cart::count() > 0) {
                    Session::put('shipping_fee',$get_fee->shipping_fee);
                }else{
                    Session::put('shipping_fee','0');
                }
            }else{
                Session::put('shipping_fee', '0');
            }
            
                

        }

        /*Khi hủy thanh toán bằng vnpay sẽ tồn tại biến này*/
        if (isset($_GET['vnp_ResponseCode'])) {
            if ($_GET['vnp_ResponseCode'] == "00") {
               Session::put('success','Đã thanh toán bằng VnPay thành công. Mời bạn xác nhận đơn hàng !');
               
                $inforVnpay = array(
                    'vnp_Amount' => $_GET['vnp_Amount'],
                    'vnp_BankCode' => $_GET['vnp_BankCode'],
                    'vnp_BankTranNo' => $_GET['vnp_BankTranNo'],
                    'vnp_CardType' => $_GET['vnp_CardType'],
                    'vnp_PayDate' => $_GET['vnp_PayDate'],
                    'vnp_TransactionNo' => $_GET['vnp_TransactionNo']
                );
                Session::put('bank','vnpay');
                Session::put('inforVnpay', $inforVnpay);

                /*$getvn = Session::get('vnpay');
                echo $getvn['vnp_Amount'];*/


            }else{
                Session::put('success',null); 
            }        
        }


        
        /*Meta Seo*/
        $meta_title = "Thông tin hóa đơn | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();


        return view('pages.checkout', compact('meta_title','meta_description','meta_keywords','meta_canonical','get_db_user','get_db_address'));
    }



    public function SaveBill(Request $request){

        /*thong tin hóa đơn*/
        $data = array();
        if ($request->address_bill == '') {
            Session::put('message','Bạn cần thêm địa chỉ giao hàng, bấm sửa thông tin để thêm!!');
            return Redirect()->back();
        }
        if ($request->payment_bill == 'Thanh toán trực tuyến') {
            return Redirect('thanh-toan-truc-tuyen');
        }
        $data['id_user'] = Session::get('id_user');
        $data['id_discount'] = Session::get('id_discount');
        $data['name_bill'] = $request->name_bill;
        $data['email_bill'] = $request->email_bill;
        $data['phone_bill'] = $request->phone_bill;
        $data['address_bill'] = $request->address_bill;
        $data['note_bill'] = $request->note_bill;
        $data['payment_bill'] = $request->payment_bill;
        $data['status_bill'] = 'Đã đặt hàng';
        $data['total_bill'] = Session::get('carttotal');
        $get_id_bill = DB::table('bill')->insertGetId($data);
        /*Session::put('id_bill',$get_id_bill);*/



        /*Thông tin đơn hàng*/
        $get_cart = Cart::content();
        $data_order = array();
        foreach($get_cart as $cart){
            $data_order['id_bill'] = $get_id_bill;
            $data_order['id_product'] = $cart->id ;
            $data_order['name_product'] = $cart->name;
            $data_order['price_product'] = $cart->price;
            $data_order['quantinty_product'] = $cart->qty;
            DB::table('order')->insert($data_order);


            /*giảm số lượng sản phẩm sau khi đặt hàng*/
            $product = ModelProduct::find($cart->id);
            $pro_qty = $product->sales_product;
            $pro_qty = $pro_qty - $cart->qty;
            $product->sales_product = $pro_qty;
            $product->save();
            
        }




        if (Session::get('bank')) {
            if (Session::get('bank') == 'vnpay') {
                $getvn = Session::get('inforVnpay');

                $addVnpay = new ModelVnPay();
                $addVnpay->id_user = Session::get('id_user');
                $addVnpay->id_bill = $get_id_bill;
                $addVnpay->amount_vnp = $getvn['vnp_Amount'];
                $addVnpay->bankcode_vnp = $getvn['vnp_BankCode'];
                $addVnpay->banktranno_vnp = $getvn['vnp_BankTranNo'];
                $addVnpay->cardtype_vnp = $getvn['vnp_CardType'];
                $addVnpay->paydate_vnp = $getvn['vnp_PayDate'];
                $addVnpay->transaction_vnp = $getvn['vnp_TransactionNo'];
                $addVnpay->save();
            }
        }

        
        /*if (isset($_GET['vnp_ResponseCode'])) {
            if ($_GET['vnp_ResponseCode'] == "00") {
               if ((Session::get('bank'))) {
                    if (Session::get('bank') == 'vnpay') {
                        $addVnpay = new ModelVnPay();
                        $addVnpay->id_user = Session::get('id_user');
                        $addVnpay->id_bill = $get_id_bill;
                        $addVnpay->amount_vnp = $_GET['vnp_Amount'];
                        $addVnpay->bankcode_vnp = $_GET['vnp_BankCode'];
                        $addVnpay->banktranno_vnp = $_GET['vnp_BankTranNo'];
                        $addVnpay->cardtype_vnp = $_GET['vnp_CardType'];
                        $addVnpay->paydate_vnp = $_GET['vnp_PayDate'];
                        $addVnpay->transaction_vnp = $_GET['vnp_TransactionNo'];
                        $addVnpay->save();
                    }
                }
            }      
        }*/

        

        //giảm mã giảm giá đi 1
        if (Session::get('id_discount')) {
            $number_code = Session::get('number_code');
            $number_code--;
            $discount = ModelCodeDiscount::find(Session::get('id_discount'));
            $discount->times_discount = $number_code;
            $discount->save();
        }
        


        


        Session::forget('id_discount');
        Session::forget('number_code');
        Session::forget('percent_discount');
        Session::forget('type_discount');
        Session::forget('name_discount');
        Session::forget('code_discount');
        Session::forget('success');
        Session::forget('bank');
        Session::forget('inforVnpay');


        return Redirect::to('/payment');
    }


    public function PaymentOnline(Request $request){
        $meta_title = "Thanh toán trực tuyến | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();
        return view('pages.confirm_payment', compact('meta_title','meta_description','meta_keywords','meta_canonical'));
    }


    public function Payment(Request $request){
        /*Meta Seo*/
        $meta_title = "Than toán thành công | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();
        Cart::destroy();
        return view('pages.success_checkout', compact('meta_title','meta_description','meta_keywords','meta_canonical'));
    }



    public function PaymentVnpay(){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:81/webshop/thanh-toan-hoa-don";
        $vnp_TmnCode = "U7Z222BZ";//Mã website tại VNPAY 
        $vnp_HashSecret = "ZKVGOUIJSAYUEBKYFDPKCDVNIWSHLXMD"; //Chuỗi bí mật

        $TxnRef = rand(0,10000);

        $vnp_TxnRef = $TxnRef; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = Session::get('carttotal') * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        // //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        // $vnp_Bill_City=$_POST['txt_bill_city'];
        // $vnp_Bill_Country=$_POST['txt_bill_country'];
        // $vnp_Bill_State=$_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        // $vnp_Inv_Email=$_POST['txt_inv_email'];
        // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        // $vnp_Inv_Company=$_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type=$_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate"=>$vnp_ExpireDate,
            // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            // "vnp_Bill_Email"=>$vnp_Bill_Email,
            // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            // "vnp_Bill_Address"=>$vnp_Bill_Address,
            // "vnp_Bill_City"=>$vnp_Bill_City,
            // "vnp_Bill_Country"=>$vnp_Bill_Country,
            // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            // "vnp_Inv_Email"=>$vnp_Inv_Email,
            // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            // "vnp_Inv_Address"=>$vnp_Inv_Address,
            // "vnp_Inv_Company"=>$vnp_Inv_Company,
            // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            // "vnp_Inv_Type"=>$vnp_Inv_Type
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);



        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            if($returnData['code'] == "00"){
            Session::put('success','Đã thanh toán bằng VnPay thành công. Mời bạn xác nhận đơn hàng !');
            Session::put('bank','vnpay');
        }
            die();
        } else {
            
            echo json_encode($returnData);
        }
        /*Session::put('success','Đã thanh toán bằng VnPay thành công. Mời bạn xác nhận đơn hàng !');*/
    }

    public function Test(Request $request){

    }


    /*Tích hợp thanh toán MOMO*/
    public function PaymentMomo(Request $request){



        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";


        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderInfo = "Thanh toán qua MoMo";
        $amount = (string)Session::get('carttotal');
        $orderId = time() ."";
        $returnUrl = "http://localhost:81/webshop/thanh-toan-hoa-don";
        $notifyurl = "http://localhost:81/webshop/payment";
        // Lưu ý: link notifyUrl không phải là dạng localhost
        $bankCode = "SML";



                 $requestId = time() . "";
                 $requestType = "payWithMoMoATM";
                 $extraData = "";
                 //before sign HMAC SHA256 signature

                 // echo $serectkey;die;
                 $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderId."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
                 $signature = hash_hmac("sha256", $rawHash, $secretKey);

                 $data =  array('partnerCode' => $partnerCode,
                                'accessKey' => $accessKey,
                                'requestId' => $requestId,
                                'amount' => $amount,
                                'orderId' => $orderId,
                                'orderInfo' => $orderInfo,
                                'returnUrl' => $returnUrl,
                                'bankCode' => $bankCode,
                                'notifyUrl' => $notifyurl,
                                'extraData' => $extraData,
                                'requestType' => $requestType,
                                'signature' => $signature);
                 $result = $this->execPostRequest($endpoint, json_encode($data));

                 $jsonResult = json_decode($result,true);  // decode json
                 
                 error_log( print_r( $jsonResult, true ) );
                 Session::put('success','Đã thanh toán bằng MoMo thành công. Mời bạn xác nhận đơn hàng !');
                 return redirect()->to($jsonResult['payUrl']);
                 /*header('Location: '.$jsonResult['payUrl']);*/
    
    
    }

    public function execPostRequest($url, $data){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }





    /*Quản lý đơn hàng admin*/

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('/dashboard');
        }else{
            Session::put('message_login', 'Bạn cần phải đăng nhập!');
            return Redirect::to('admin-login')->send();
        }
    }

    public function ListBill(){
        $this->AuthLogin();
        $get_db_bill = DB::table('bill')->get();
        return view('admin.order.list_bill')->with('show_bill', $get_db_bill);
    }

    public function DetailBill($link_id_bill){
        $this->AuthLogin();
        $detail_bill = DB::table('order')
        ->join('product','order.id_product','=','product.id_product')
        ->where('id_bill', $link_id_bill)->get();
        $get_infor_bill = DB::table('bill')->where('id_bill', $link_id_bill)->first();
        return view('admin.order.detail_bill')->with('show_detail_bill', $detail_bill)->with('info_bill', $get_infor_bill);
    }


    public function ListOrder(){
        $this->AuthLogin();
        $get_db_order = DB::table('order')
        ->join('bill','order.id_bill','=','bill.id_bill')
        ->get();
        return view('admin.order.list_order')->with('show_order', $get_db_order);
    }

    public function UpdateBill(Request $request, $link_id_bill){

        $data = $request->all();
        $bill = ModelBill::find($link_id_bill);
        $bill->status_bill = $data['status_bill'];

        $bill->save();
        Session::put('message','Sửa trạng thái thành công !!!');
        return Redirect('list-bill');

    }
    public function DeleteBill($link_id_bill){
        $bill = ModelBill::find($link_id_bill);
        $bill->delete();
        return Redirect()->back();
    }
}
