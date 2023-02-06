<?php

namespace App\Http\Controllers;
use App\Models\ModelCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
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
    public function AddCategory(){
        $this->AuthLogin();
        return view('admin.category.add_category');
    }
    public function ListCategory(){
        $this->AuthLogin();
        /*Lấy tất cả dữ liệu lưu vào biến*/
        /*$get_db_category = DB::table('category_product')->get();*/

        /*Model---------------------------*/
        $get_db_category = ModelCategory::all();

        return view('admin.category.list_category')->with('show_list_category', $get_db_category);
    }
    public function EditCategory($link_id_category){
        $this->AuthLogin();

        $get_db_category = DB::table('category_product')->where('id_category',$link_id_category)->get();

        /*Model---------------------------*/
        // Khi su dung model, su dung ham find cho 1 san pham khon can ham foreach
        //$get_db_category = ModelCategory::find($link_id_category);

        return view('admin.category.edit_category')->with('show_edit_category', $get_db_category);   
    }



    public function SaveCategory(Request $request){
        $this->AuthLogin();

        // Sử dụng controller

        // $data = array();
        // /*Lấy dữ liệu từ forrm*/
        // $data['name_category'] = $request->name_category;
        // $data['describe_category'] = $request->describe_category;
        // $data['status_category'] = $request->status_category;
        // $get_image = $request->file('image_category');
        // if ($get_image) {
        //     $get_name_image = $get_image->getClientOriginalName();
        //     $get_name = current(explode('.', $get_name_image));
        //     $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

        //     $get_image->move('public/images_upload/images_category', $new_image);
        //     $data['image_category'] = $new_image;

        //     Db::table('category_product')->insert($data);
        //     Session::put('message','Thêm danh mục thành công!');
        //     return Redirect::to('/add-category');
        // }else{
        //     Session::put('message','Bạn chưa chọn hình ảnh!');              
        //     return Redirect::to('/add-category');
        // }



        /*Sử dụng model*/
        $data = $request->all();
        $category = new ModelCategory();
        $category->name_category = $data['name_category'];
        $category->describe_category = $data['describe_category'];
        $category->slug_category = $data['slug_category'];
        $category->status_category = $data['status_category'];

        $get_image = $request->file('image_category');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/images_upload/images_category', $new_image);
            $category->image_category = $new_image;

            $category->save();
            Session::put('message','Thêm danh mục thành công!');
            return Redirect::to('/add-category');
        }else{
            Session::put('message','Bạn chưa chọn hình ảnh!');              
            return Redirect::to('/add-category');
        }
    }

    public function UpdateCategory(Request $request, $link_id_category){
        $this->AuthLogin();

        /*Controller*/
        // $data = array();
        // /*Lấy dữ liệu từ forrm*/
        // $data['name_category'] = $request->name_category;
        // $data['describe_category'] = $request->describe_category;
        // $data['status_category'] = $request->status_category;
        // $get_image = $request->file('image_category');
        // if ($get_image) {
        //     $get_name_image = $get_image->getClientOriginalName();
        //     $get_name = current(explode('.', $get_name_image));
        //     $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

        //     $get_image->move('public/images_upload/images_category', $new_image);
        //     $data['image_category'] = $new_image;

            
        // }
        // DB::table('category_product')->where('id_category', $link_id_category)->update($data);
        // Session::put('message','Cập nhật danh mục thành công!');
        // return Redirect::to('/list-category');

        /*Model---------------------------*/
        $data = $request->all();
        $category = ModelCategory::find($link_id_category);
        $category->name_category = $data['name_category'];
        $category->slug_category = $data['slug_category'];
        $category->describe_category = $data['describe_category'];
        $category->status_category = $data['status_category'];

        $get_image = $request->file('image_category');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/images_upload/images_category', $new_image);
            unlink('public/images_upload/images_category/'.$category->image_category);
            $category->image_category = $new_image; 
        }
        $category->save();
        Session::put('message','Cập nhật danh mục thành công!');
        return Redirect::to('/list-category');

    }

    public function DeleteCategory($link_id_category){
        $this->AuthLogin();
        $category = ModelCategory::find($link_id_category);
        unlink('public/images_upload/images_category/'.$category->image_category);
        $category->delete();
        Session::put('message','Xóa danh mục thành công!');
        return Redirect::to('/list-category');

    }

    public function ActiveCategory($link_id_category){
        $this->AuthLogin();
        DB::table('category_product')->where('id_category',$link_id_category)->update(['status_category' => 'Ẩn']);
        Session::put('message',"Ẩn danh mục thành công!");
        return Redirect::to('/list-category');

    }
    public function UnActiveCategory($link_id_category){
        $this->AuthLogin();
        DB::table('category_product')->where('id_category',$link_id_category)->update(['status_category' => 'Hiện']);
        Session::put('message','Hiển thị danh mục thành công!');
        return Redirect::to('/list-category');
    }



    /* Function Index */

    public function ShowCategoryProduct(Request $request,$link_slug_category,$link_id_category){
        /*danh sách danh mục*/
        $get_db_category = DB::table('category_product')->where('status_category','Hiện')->orderby('id_category','desc')->get();


        /*danh sách sản phẩm trong danh mục*/
        /*$get_category_list_product = DB::table('product')->join('category_product','product.id_category','=','category_product.id_category')->where('product.id_category', $link_id_category)->orderby('id_product','desc')->get();*/
        
        if (DB::table('product')->join('category_product','product.id_category','=','category_product.id_category')->where('product.id_category', $link_id_category)->exists()) {
            $get_category_list_product = DB::table('product')->join('category_product','product.id_category','=','category_product.id_category')->where('product.id_category', $link_id_category)->orderby('id_product','desc')->get();
            $message_null = '';
        }else{
            $get_category_list_product = DB::table('product')->join('category_product','product.id_category','=','category_product.id_category')->where('product.id_category', $link_id_category)->orderby('id_product','desc')->get();
            $message_null = 'Không có sản phẩm nào!';
        }
        /*lấy tên danh mục*/
        $get_name_category = DB::table('category_product')->where('category_product.id_category', $link_id_category)->get();
        foreach($get_name_category as $name_category){
            $name_category = $name_category->name_category;
        }

        /*sản phẩm khuyên mãi cao nhất*/
        $get_db_hot_product = DB::table('product')->where('status_product', 'Hiện')->where('discount_product','>','0')->orderby('discount_product','desc')->limit(10)->get(); 

        $get_db_slide = DB::table('slide')->where('status_slide', 'Hiện')->orderby('id_slide', 'asc')->get();

        /*Meta Seo*/
        $meta_title = $name_category." | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();

        return view('pages.page_category', compact('message_null','name_category','meta_title','meta_description','meta_keywords','meta_canonical'))
        ->with('show_category_index', $get_db_category)
        ->with('get_category_list_product', $get_category_list_product)
        ->with('show_hot_product',$get_db_hot_product)
        ->with('show_slide', $get_db_slide);
    }

}
