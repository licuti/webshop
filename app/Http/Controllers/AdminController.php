<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

use App\Models\ModelBill;

class AdminController extends Controller
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
    public function AdminLogin(){
        return view('admin_login');
    }
    public function ShowDashboard(){
        $totalMonth = ModelBill::whereMonth('updated_at','11')->sum('total_bill');
        $qtyBill = ModelBill::whereMonth('updated_at','11')->count();
        // echo "<pre>";
        // print_r($bill);
        // echo "</pre>";
        $this->AuthLogin();
        return view('admin.dashboard', compact('totalMonth','qtyBill'));
    }
    public function Dashboard(Request $request){
        $admin_username = $request->admin_username;
        $admin_password = md5($request->admin_password);

        $result = DB::table('admin_account')->where('admin_username',$admin_username)->where('admin_password',$admin_password)->first();
        if ($result) {
            /* lấy dữ liệu từ biến kết quả gán cho biên để hiển thị lên form*/
            Session::put('admin_name', $result->admin_username);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message_login','Sai tài khoản hoặc mật khẩu!');
            return Redirect::to('/admin-login');
        }
    }
    public function AdminLogout(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin-login');
    }
}
