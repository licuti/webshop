<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

use App\Models\ModelBlog;

class Blog extends Controller
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

    public function AddBlog(){
        $this->AuthLogin();
        return view('admin.blog.add_blog');
    }
    public function SaveBlog(Request $request){
        $this->AuthLogin();
        $data = $request->all();

        $blog = new ModelBlog();

        $blog->title_blog = $data['title_blog'];
        $blog->describe_blog = $data['describe_blog'];
        $blog->content_blog = $data['content_blog'];
        $blog->slug_blog = $data['slug_blog'];
        $blog->status_blog = $data['status_blog'];

        $get_image = $request->file('image_blog');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/images_upload/images_blog', $new_image);
            $blog->image_blog = $new_image;

            $blog->save();
            Session::put('message','Thêm danh bài viết thành công!');
            return Redirect::to('/add-blog');
        }else{
            Session::put('message','Bạn chưa chọn hình ảnh!');              
            return Redirect::to('/add-blog');
        }
    }


    public function ListBlog(){
        $this->AuthLogin();
        $listBlog = ModelBlog::all();
        return view('admin.blog.list_blog', compact('listBlog'));
    }

    public function EditBlog($link_id_blog){
        $this->AuthLogin();

        $getBlog = ModelBlog::find($link_id_blog);


        return view('admin.blog.edit_blog', compact('getBlog'));
    }

    public function UpdateBlog(Request $request, $link_id_blog){
        $this->AuthLogin();
        $data = $request->all();
        $blog = ModelBlog::find($link_id_blog);


        $blog->title_blog = $data['title_blog'];
        $blog->slug_blog = $data['slug_blog'];
        $blog->content_blog = $data['content_blog'];
        $blog->status_blog = $data['status_blog'];
        $blog->describe_blog = $data['describe_blog'];

        $get_image = $request->file('image_blog');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/images_upload/images_blog', $new_image);
            unlink('public/images_upload/images_blog/'.$blog->image_blog);
            $blog->image_blog = $new_image; 
        }
        $blog->save();
        Session::put('message','Cập nhật bài viết thành công!');
        return Redirect::to('/list-blog');
    }

    public function DeleteBlog($link_id_blog){
        $this->AuthLogin();
        $delBlog = ModelBlog::find($link_id_blog);
        unlink('public/images_upload/images_blog/'.$delBlog->image_blog);
        $delBlog->delete();
        Session::put('message','Xóa bài viết thành công!');
        return Redirect::to('/list-blog');
    }

    public function ActiveBlog($link_id_blog){
        $this->AuthLogin();
        $statusBlog = ModelBlog::find($link_id_blog);
        $statusBlog->status_blog = "Ẩn";

        $statusBlog->save();
        Session::put('message','Ẩn bài viết thành công!');
        return Redirect::to('/list-blog');
    }
    public function UnActiveBlog($link_id_blog){
        $this->AuthLogin();
        $statusBlog = ModelBlog::find($link_id_blog);
        $statusBlog->status_blog = "Hiện";

        $statusBlog->save();
        Session::put('message','Hiển thị bài viết thành công!');
        return Redirect::to('/list-blog');
    }

    public function ShowBlog(Request $request){
        $getBlog = ModelBlog::where('status_blog',"Hiện")->orderBy('id_blog','desc')->get();


        $meta_title = "Cẩm nang chăm sóc | Cửa hàng xanh";
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();
        return view('pages.blog', compact('meta_title','meta_description','meta_keywords','meta_canonical','getBlog'));
    }

    public function DetailBlog(Request $request,$link_slug_blog,$link_id_blog){

        $getBlog = ModelBlog::where('id_blog',$link_id_blog)->where('slug_blog', $link_slug_blog)->first();

        $meta_title = $getBlog->title_blog;
        $meta_description = "Cửa hàng bán cây xanh hàng đầu Việt Nam";
        $meta_keywords = "cay xanh,hat giong, cay trang tri, cay phong thuy";
        $meta_canonical = $request->url();

        return view('pages.detail_blog',compact('meta_title','meta_description','meta_keywords','meta_canonical','getBlog'));
    }
}
