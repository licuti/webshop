<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();


use App\Models\ModelCity;
use App\Models\ModelShippingFees;
use App\Models\ModelAddressUser;

use App\Models\ModelProduct;


class ShoppingCart extends Controller
{
    public function SaveShoppingCart(Request $request){
        $get_id_product = $request->quantinty_product_hiden;
        $quantinty_product = $request->quantinty_product;

        /*$get_db_product = DB::table('product')->where('id_product', $get_id_product)->first();*/
        $get_db_product = DB::table('product')->join('category_product','product.id_category','=','category_product.id_category')->where('product.id_product', $get_id_product)->first();

        $get_price_discount = $get_db_product->price_product - (($get_db_product->price_product * $get_db_product->discount_product) / 100);
        $data['id'] = $get_db_product->id_product;
        $data['qty'] = $quantinty_product;
        $data['name'] = $get_db_product->name_product;
        $data['price'] = $get_price_discount;
        $data['weight'] = '0';
        $data['options']['image'] = $get_db_product->image_product;
        $data['options']['priced'] = $get_db_product->price_product;
        $data['options']['discount'] = $get_db_product->discount_product;
        $data['options']['category'] = $get_db_product->name_category;
        Cart::setGlobalTax(10);
        Cart::add($data);
        /*Cart::destroy();*/
        return Redirect::to('/gio-hang');
    }



    public function AddPayNow(Request $request){
        $data = $request->all();

        /*lấy sản phẩm theo id*/
        $product = ModelProduct::find($data['id_product']);

        $get_price_discount = $product->price_product - (($product->price_product * $product->discount_product) / 100);
        $cart['id'] = $product->id_product;
        $cart['qty'] = "1";
        $cart['name'] = $product->name_product;
        $cart['price'] = $get_price_discount;
        $cart['weight'] = '0';
        $cart['options']['image'] = $product->image_product;
        $cart['options']['priced'] = $product->price_product;
        $cart['options']['discount'] = $product->discount_product;
        $cart['options']['category'] = $product->category->name_category;
        Cart::setGlobalTax(10);
        Cart::add($cart);

    }

    public function AddCartNow(Request $request){
        $data = $request->all();

        /*lấy sản phẩm theo id*/
        $product = ModelProduct::find($data['id_product']);

        $get_price_discount = $product->price_product - (($product->price_product * $product->discount_product) / 100);
        $cart['id'] = $product->id_product;
        $cart['qty'] = "1";
        $cart['name'] = $product->name_product;
        $cart['price'] = $get_price_discount;
        $cart['weight'] = '0';
        $cart['options']['image'] = $product->image_product;
        $cart['options']['priced'] = $product->price_product;
        $cart['options']['discount'] = $product->discount_product;
        $cart['options']['category'] = $product->category->name_category;
        Cart::setGlobalTax(10);
        Cart::add($cart);

        echo "Thêm giỏ hàng thành công!!";
    }    

    public function UpdateShoppingCart(Request $request){
        $qty_update = $request->shopping_cart_qty;
        $rowId = $request->shopping_cart_rowId;
        Cart::update($rowId, $qty_update);
        return Redirect::to('/gio-hang');

    }
    public function DeleteShoppingCart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('/gio-hang');
    }

    public function ShowShoppingCart(Request $request){

        if (Session::get('id_user')) {
            // lấy địa chỉ có user hiện tại
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
                Session::put('shipping_fee','0');
            }
            

        }

        /*Meta Seo*/
        $meta_title = "Giỏ hàng | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();
        return view('pages.shopping_cart', compact('meta_title','meta_description','meta_keywords','meta_canonical'));
    }


      

}
