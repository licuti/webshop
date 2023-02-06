<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class Slide extends Controller
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

    public function AddSlide(){
        $this->AuthLogin();
        return view('admin.slide.add_slide');
    }

    public function ListSlide(){
        $this->AuthLogin();
        $get_db_slide = DB::table('slide')->orderby('id_slide', 'desc')->get();
        return view('admin.slide.list_slide')->with('show_slide', $get_db_slide);
    }

    public function EditSlide($link_id_slide){
        $this->AuthLogin();
        $get_db_slide = DB::table('slide')->where('id_slide', $link_id_slide)->get();
        return view('admin.slide.edit_slide')->with('show_slide', $get_db_slide);
    }

    public function SaveSlide(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['content_slide'] = $request->content_slide;
        $data['status_slide'] = $request->status_slide;
        $get_image = $request->file('image_slide');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/images_upload/images_slide', $new_image);
            $data['image_slide'] = $new_image;

            Db::table('slide')->insert($data);
            Session::put('message','Thêm slide thành công!');
            return Redirect::to('/add-slide');
        }else{
            Session::put('message','Bạn chưa chọn hình ảnh!');              
            return Redirect::to('/add-slide');
        }
    }

    public function UpdateSlide(Request $request, $link_id_slide){
        $this->AuthLogin();
        $data = array();
        $data['content_slide'] = $request->content_slide;
        $data['status_slide'] = $request->status_slide;
        $get_image = $request->file('image_slide');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/images_upload/images_slide', $new_image);
            $data['image_slide'] = $new_image;
        }
        DB::table('slide')->where('id_slide', $link_id_slide)->update($data);
        Session::put('message','Cập nhật slide thành công!');
        return Redirect::to('/list-slide');
    }

    public function DeleteSlide($link_id_slide){
        $this->AuthLogin();
        DB::table('slide')->where('id_slide', $link_id_slide)->delete();
        Session::put('message','Xóa slide thành công!');
        return Redirect::to('/list-slide');
    }


    public function ActiveSlide($link_id_slide){
        $this->AuthLogin();
        DB::table('slide')->where('id_slide',$link_id_slide)->update(['status_slide' => 'Ẩn']);
        Session::put('message',"Ẩn slide thành công!");
        return Redirect::to('/list-slide');

    }
    public function UnActiveSlide($link_id_slide){
        $this->AuthLogin();
        DB::table('slide')->where('id_slide',$link_id_slide)->update(['status_slide' => 'Hiện']);
        Session::put('message','Hiển thị slide thành công!');
        return Redirect::to('/list-slide');
    }
}
