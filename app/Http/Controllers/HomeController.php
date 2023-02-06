<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

use App\Models\ModelFavourite;
use App\Models\ModelBlog;

class HomeController extends Controller
{
    public function index(Request $request){

        /*Meta Seo*/
        $meta_title = "Cửa hàng xanh | Trang chủ";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();



        $get_db_category = DB::table('category_product')->where('status_category','Hiện')->orderby('id_category','desc')->get();

        $get_db_suggest_product = DB::table('product')->where('status_product','Hiện')->orderby('id_product','desc')->get();

        $get_db_hot_product = DB::table('product')->where('status_product', 'Hiện')->where('discount_product','>','0')->orderby('discount_product','desc')->limit(10)->get(); 

        $get_db_slide = DB::table('slide')->where('status_slide', 'Hiện')->orderby('id_slide', 'asc')->get();


        return view('pages.home', compact('meta_title','meta_description','meta_keywords','meta_canonical'))
        ->with('show_category_index', $get_db_category)
        ->with('show_suggest_product', $get_db_suggest_product)
        ->with('show_hot_product',$get_db_hot_product)
        ->with('show_slide', $get_db_slide);
    }

    public function SeachProduct(Request $request){
        $meta_title = "Cửa hàng xanh | Tìm kiếm sản phẩm";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();
        $get_search_product = $request->seach_product;
        /*$get_db_search_product = DB::table('product')->where('name_product','like','%'. $get_search_product .'%')->get();*/


        if (DB::table('product')->where('name_product','like','%'. $get_search_product .'%')->exists()) {
            $get_db_search_product = DB::table('product')->where('name_product','like','%'. $get_search_product .'%')->get();
            $message = '';
            Session::put('text_search', $get_search_product);
        }else{
            $get_db_search_product = DB::table('product')->where('name_product','like','%'. $get_search_product .'%')->get();
            $message = 'Không tìm thấy sản phẩm nào';
            Session::put('text_search', $get_search_product);
        }

        /*sản phẩm khuyến mãi cao nhất*/
        $get_db_hot_product = DB::table('product')->where('status_product', 'Hiện')->where('discount_product','>','0')->orderby('discount_product','asc')->limit(10)->get(); 

        

        return view('pages.search_product', compact('message','meta_title','meta_description','meta_keywords','meta_canonical'))
        ->with('show_search_product', $get_db_search_product)
        ->with('show_hot_product',$get_db_hot_product);
    }




    public function SaveFavourite(Request $request){
        $data = $request->all();


        if(ModelFavourite::where('id_user', $data['id_user'])->where('id_product', $data['id_product'])->exists()){
            /*$favourite = ModelFavourite::where('id_user', $data['id_user'])->where('id_product', $data['id_product'])->first();;*/
            /*$favourite->delete();*/

            $output = 'Sảm nhẩm đã được thêm!!';
        }else{
            $favourite = new ModelFavourite();

            $favourite->id_user = $data['id_user'];
            $favourite->id_product = $data['id_product'];
            $favourite->save();
            $output = 'Đã thêm vào sẩn phẩm yêu thích!!';
        }
        echo $output;
    }







    public function MyFavourite(Request $request){

        $meta_title = "Yêu thích | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();

        if (ModelFavourite::where('id_user', Session::get('id_user'))->exists()) {
            $favourite = ModelFavourite::where('id_user', Session::get('id_user'))->get();
        }else{
            $favourite = '';
        }
        return view('pages.my_favourite', compact('meta_title','meta_description','meta_keywords','meta_canonical','favourite'));
    }

    public function DeleteFavourite($link_id_product){
        if (Session::get('id_user')) {
            $favourite = ModelFavourite::where('id_user',Session::get('id_user'))->where('id_product', $link_id_product)->first();
            $favourite->delete();
            return Redirect()->back();
        }
    }


    
}
