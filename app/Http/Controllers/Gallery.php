<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelGallery;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class Gallery extends Controller
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

    public function AddGallery($link_id_product){
        $id_product = $link_id_product;
        return view('admin.gallery.add_gallery', compact('id_product'));
    }
    public function SaveGallery(Request $request, $link_id_product){
        $data = $request->all();
        $images_gallery = $request->file('file');
        if($images_gallery){
            foreach($images_gallery as $get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/images_upload/images_gallery', $new_image);


            $gallery = new ModelGallery();
            $gallery->id_product = $link_id_product;
            $gallery->name_gallery = 'Nhấp để sửa';
            $gallery->link_gallery = $new_image;
            $gallery->save();
            }
            Session::put('message','Thêm thư viện ảnh thành công!');      
            return Redirect()->back();
        }
        else{
            Session::put('message','Bạn chưa chọn hình ảnh!!');      
            return Redirect()->back();
        }

    }

    public function UpdateNameGallery(Request $request){
        $get_id_gallery = $request->id_gallery;
        $get_name_gallery = $request->name_gallery;
        $gallery = ModelGallery::find($get_id_gallery);
        $gallery->name_gallery = $get_name_gallery;
        $gallery->save();
    }
    public function DeleteGallery(Request $request){
        $get_id_gallery = $request->id_gallery;
        $gallery = ModelGallery::find($get_id_gallery);
        unlink('public/images_upload/images_gallery/'.$gallery->link_gallery);
        $gallery->delete();
    }
    public function UpdateImageGallery(Request $request){
        $get_image = $request->file('file');
        $get_id_gallery = $request->id_gallery; 
       if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $get_name = current(explode('.', $get_name_image));
            $new_image = $get_name.rand(0,999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/images_upload/images_gallery', $new_image);


            $gallery = ModelGallery::find($get_id_gallery);
            unlink('public/images_upload/images_gallery/'.$gallery->link_gallery);
            $gallery->link_gallery = $new_image;
            
            $gallery->save();
        }
    }
    public function SelectGallery(Request $request){
        $get_id_product = $request->id_product;
        $get_db_gallery = ModelGallery::where('id_product', $get_id_product)->get();
        $gallery_count = $get_db_gallery->count();
        $output = "
            <form>
            ".csrf_field()."
            <table class='checkbox-datatable hover table'>
                            <thead>
                                <tr>
                                    <th><div class='dt-checkbox'>
                                            <input type='checkbox' name='select_all' value='1' id='example-select-all'>
                                            <span class='dt-checkbox-label'></span>
                                        </div>
                                    </th>
                                    <th>Thứ tự ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Đường dẫn</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
        ";
        if ($gallery_count>0) {
            $i = 0;
            foreach ($get_db_gallery as $key => $gallery) {
                $i++;
                $output .= "
                                <tr>
                                    <td></td>
                                    <td>".$i."</td>
                                    <td contenteditable class='edit_name_gallery' data-gal_id='".$gallery->id_gallery."'>".$gallery->name_gallery."</td>
                                    <td>
                                        <div style='width: 70px;
                                                    height: 70px;
                                                    background-position: center center;
                                                    background-size: cover;'>

                                            <img src='../public/images_upload/images_gallery/".$gallery->link_gallery."' style='object-fit: cover; width: 100%; height: 100%;' alt=''>
                                        </div>
                                        <input type='file' class='form-control-file form-control height-auto image_gallery' data-gal_id='".$gallery->id_gallery."' id = 'file-".$gallery->id_gallery."' name='file' accept='image/*'>
                                    </td>
                                    <td>".$gallery->link_gallery."</td>
                                    <td>
                                        <div class='dropdown'>
                                            <a class='btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle' href='#' role='button' data-toggle='dropdown'>
                                                <i class='dw dw-more'></i>
                                            </a>
                                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
                                                
                                                <a class='dropdown-item delete_gallery' href='' data-gal_id='".$gallery->id_gallery."'><i class='dw dw-delete-3'></i> Xóa</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                ";
            }
        }else{
            $output .= "Khôn có ảnh nào!";
        }
        $output .= "</tbody>
                </table>
                </form>";

        echo $output;
    }
}
