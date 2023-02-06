<?php

namespace App\Http\Controllers;

use App\Models\ModelCodeDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();
class CodeDiscount extends Controller
{
    /*code discount*/
    public function CheckCodeDiscount(Request $request){
        /*$code_discount = $request->code_discount;
        $get_code = DB::table('code_discount')->where('code_discount', $code_discount)->first();
        if ($get_code) {
            $percent = $get_code->percent_discount;
            $name = $get_code->name_discount;
            $code = $get_code->code_discount;
            Cart::setGlobalDiscount($percent);
            Session::put('percent_discount', $percent);
            Session::put('name_discount', $name);
            Session::put('code_discount', $code);
            return Redirect::to('/gio-hang');
        }
        else{
            $percent = '';
            $code ='';
            Cart::setGlobalDiscount(0);
            Session::put('percent_discount', $percent);
            Session::put('code_discount', $code);
            Session::put('message', "Mã không hợp lê");
            return Redirect::to('/gio-hang');
        }*/
        $data = $request->all();
        $get_code = ModelCodeDiscount::where('code_discount', $data['code_discount'])->first();

        /*kiểm tra mã code có tồn tại hay không*/
        if($get_code != ''){
            $number_code = $get_code->times_discount;

            //nếu số lượng mã đang còn
            if ($number_code > 0 ) {
                //giảm mã đi 1
                /*$number_code--;

                echo $number_code;
                echo $get_code->id_discount;
                $discount = ModelCodeDiscount::find($get_code->id_discount);
                $discount->times_discount = $number_code;
                $discount->save();*/
                    Session::put('id_discount', $get_code->id_discount);
                    Session::put('number_code', $get_code->times_discount);
                    Session::put('percent_discount', $get_code->percent_discount);
                    Session::put('type_discount', $get_code->type_discount);
                    Session::put('name_discount', $get_code->name_discount);
                    Session::put('code_discount', $get_code->code_discount);

                    return Redirect::to('/gio-hang');
            }else{ //nếu số lượng = 0 -> hết mã
                    Session::forget('id_discount');
                    Session::forget('number_code');
                    Session::forget('percent_discount');
                    Session::forget('type_discount');
                    Session::forget('name_discount');
                    Session::forget('code_discount');
                    
                    Session::put('message_discount', "Mã giảm giá này đã hết!");
                    return Redirect::to('/gio-hang');
            }
        }else{/*Khi không nhập mã code*/
            Session::forget('id_discount');
            Session::forget('number_code');
            Session::forget('percent_discount');
            Session::forget('type_discount');
            Session::forget('name_discount');
            Session::forget('code_discount');
            Session::put('message_discount', "Mã giảm giá không hợp lệ!!");
            return Redirect::to('/gio-hang');
        }


    }
    public function ListCodeDiscount(){
        $get_db_discount = ModelCodeDiscount::all();
        return view('admin.code_discount.list_code_discount')->with('show_discount',$get_db_discount);
    }

    public function AddCodeDiscount(){
        return view('admin.code_discount.add_code_discount');
    }
    public function SaveCodeDiscount(Request $request){
        $data = $request->all();
        $code_discount = new ModelCodeDiscount();
        $code_discount->name_discount = $data['name_discount'];
        $code_discount->code_discount = $data['code_discount'];
        $code_discount->times_discount = $data['times_discount'];
        $code_discount->percent_discount = $data['percent_discount'];
        $code_discount->type_discount = $data['type_discount'];
        $code_discount->status_discount = 'Chưa sử dụng';
        $code_discount->save();
        Session::put('message','Thêm mã code thành công!');
        return Redirect::to('/add-code-discount');
    }
    public function DeleteCodeDiscount($link_id_discount){
        $get_db_discount = ModelCodeDiscount::find($link_id_discount);
        $get_db_discount->delete();
        Session::put('message','Xóa mã code thành công!');
        return Redirect::to('/list-code-discount');
    }
}
