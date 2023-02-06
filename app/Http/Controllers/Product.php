<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

use App\Models\ModelGallery;
use App\Models\ModelProduct;


use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;


session_start();


class Product extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('/dashboard');
        }else{
            Session::put('message_login', 'Bạn cần phải đăng nhập!');
            return Redirect::to('admin-login')->send();
        }
    }
    public function ListProduct(){
        $this->AuthLogin();
        $get_db_product = DB::table('product')->join('category_product','category_product.id_category','=','product.id_category')->orderBy('product.id_product','desc')->get();

        $manage_product = view('admin.product.list_product')->with('show_list_product', $get_db_product);
        return view('admin_dashboard')->with('admin.product.list_product', $manage_product);
    }
    public function AddProduct(){
        $this->AuthLogin();
        /*liệt kê danh mục*/
        $get_category = DB::table('category_product')->orderby('id_category','desc')->get();
        return view('admin.product.add_product')->with('show_category', $get_category);
    }
    
    public function EditProduct($link_id_product){
        $this->AuthLogin();
        $get_db_category = DB::table('category_product')->orderby('id_category','desc')->get();
        $get_db_product = DB::table('product')->where('id_product',$link_id_product)->get();
        return view('admin.product.edit_product')->with('show_list_product', $get_db_product) ->with('show_category', $get_db_category);
    }

    public function SaveProduct(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['name_product'] = $request->name_product;
        $data['describe_product'] = $request->describe_product;
        $data['detail_product'] = $request->detail_product;
        $data['price_product'] = $request->price_product;
        $data['discount_product'] = $request->discount_product;
        $data['sales_product'] = $request->sales_product;
        $data['id_category'] = $request->list_category;
        $data['status_product'] = $request->status_product;
        $data['slug_product'] = $request->slug_product;
        $data['keywords_product'] = $request->keywords_product;
        $get_image = $request->file('image_product');

        $path_product = 'public/images_upload/images_product/';
        $path_gallery = '';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/images_upload/images_product', $new_image);
            $data['image_product'] = $new_image;

            $get_id_product = DB::table('product')->insertGetId($data);


            File::copy('public/images_upload/images_product/'.$new_image,'public/images_upload/images_gallery/'.$new_image);
            $gallery = new ModelGallery();
            $gallery->name_gallery = 'Nhấp để sửa';
            $gallery->link_gallery = $new_image;
            $gallery->id_product = $get_id_product;
            $gallery->save();


            Session::put('message', 'Thêm sản phẩm thành công!');
            return Redirect::to('/add-product');
        }else{
            Session::put('message','Bạn chưa chọn hình ảnh');              
            return Redirect::to('/add-product');
        }
    }
    public function UpdateProduct(Request $request, $link_id_product){
        $this->AuthLogin();
        $data = array();
        $data['name_product'] = $request->name_product;
        $data['describe_product'] = $request->describe_product;
        $data['detail_product'] = $request->detail_product;
        $data['price_product'] = $request->price_product;
        $data['discount_product'] = $request->discount_product;
        $data['sales_product'] = $request->sales_product;
        $data['id_category'] = $request->list_category;
        $data['status_product'] = $request->status_product;
        $data['slug_product'] = $request->slug_product;
        $data['keywords_product'] = $request->keywords_product;
        $get_image = $request->file('image_product');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/images_upload/images_product', $new_image);
            $data['image_product'] = $new_image;

            /*DB::table('product')->where('id_product', $link_id_product)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công!');
            return Redirect::to('/list-product');*/
        }
        DB::table('product')->where('id_product', $link_id_product)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công!');              
        return Redirect::to('/list-product');

    }

    public function DeleteProduct($link_id_product){
        $this->AuthLogin();
        DB::table('product')->where('id_product', $link_id_product)->delete();
        Session::put('message','Xóa sản phẩm thành công!');
        return Redirect::to('/list-product');
    }


    public function ActiveProduct($link_id_product){
        $this->AuthLogin();
        DB::table('product')->where('id_product',$link_id_product)->update(['status_product' => 'Ẩn']);
        Session::put('message',"Ẩn sản phẩm thành công!");
        return Redirect::to('/list-product');
    }
    public function UnActiveProduct($link_id_product){
        $this->AuthLogin();
        DB::table('product')->where('id_product',$link_id_product)->update(['status_product' => 'Hiện']);
        Session::put('message',"Hiển thị sản phẩm thành công!");
        return Redirect::to('/list-product');
    }



    /*Chi tiết sản phẩm*/

    public function ShowDetailProduct(Request $request,$link_slug_product,$link_id_product){
        /*chi tiêt sản phẩm*/
        $get_db_product = DB::table('product')->join('category_product','product.id_category','=','category_product.id_category')->where('product.id_product', $link_id_product)->get();

        $get_db_gallery = DB::table('gallery')->where('id_product', $link_id_product)->get();

        /*lấy ra id danh mục*/
        foreach($get_db_product as $key => $value){
            $id_category = $value->id_category;
            $name_product = $value->name_product;
            $describe_product = $value->describe_product;
            $keywords_product = $value->keywords_product;
        }


        /*  sản phẩm liên quan
            sản phẩm cùng danh mục
            không lấy sản phẩm hiện tại
        */
        $related_product = DB::table('product')
        ->join('category_product','product.id_category','=','category_product.id_category')
        ->where('product.id_category', $id_category)
        ->whereNotIn('product.id_product', [$link_id_product])
        ->orderby('product.id_product','desc')
        ->get();


         /*Meta Seo*/
        $meta_title = $name_product.' | Cửa hàng xanh'; 
        $meta_description = $describe_product;
        $meta_keywords = $keywords_product;
        $meta_canonical = $request->url();

        return view('pages.detail_product', compact('meta_title','meta_description','meta_keywords','meta_canonical'))
        ->with('show_detail_product', $get_db_product)
        ->with('show_gallery', $get_db_gallery)
        ->with('related_product', $related_product);
    }
}
