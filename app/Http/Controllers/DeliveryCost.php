<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

use App\Models\ModelCity;
use App\Models\ModelDistrict;
use App\Models\ModelCommuneWardTown;
use App\Models\ModelShippingFees;

class DeliveryCost extends Controller
{
    public function ListDeliveryCost(){

        $get_db_city = ModelCity::orderby('id_city','asc')->get();
        $get_db_delivery = ModelShippingFees::all();

        return view('admin.delivery.list_delivery_cost', compact('get_db_city', 'get_db_delivery'));
    }
    public function SelectDelivery(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_district = ModelDistrict::where('id_city', $data['get_id'])->orderby('id_district','asc')->get();
                $output .= "<option value='AZ'>Chọn quận huyện</option>";
                foreach ($select_district as $key => $district) {
                    $output .= "<option value='".$district->id_district."'>".$district->name_district."</option>";
                }
            }else{
                $select_cwt = ModelCommuneWardTown::where('id_district', $data['get_id'])->orderby('id_cwt','asc')->get();
                $output .= "<option value='AZ'>Chọn xã, phương, thị trấn</option>";

                foreach ($select_cwt as $key => $cwt) {
                    $output .= "<option value='".$cwt->id_cwt."'>".$cwt->name_cwt."</option>";
                }
            }
        }
        echo $output;
    }

    public function SaveDeliveryCost(Request $request){
        $data = $request->all();

        $shipping_fee = new ModelShippingFees();
        $shipping_fee->city_fee = $data['city'];
        $shipping_fee->district_fee = $data['district'];
        $shipping_fee->cwt_fee = $data['cwt'];
        $shipping_fee->shipping_fee = $data['shipping_fee'];
        $shipping_fee->save();

    }

    public function UpdateDelivery(Request $request){
        $data = $request->all();
        $delivery = ModelShippingFees::find($data['get_id_fee']);
        $delivery->shipping_fee = rtrim($data['get_shipping_fee'],'.');
        $delivery->save();
    }

    public function LoadDelivery(){
        $output = '';
        $output .= '<table class="checkbox-datatable hover table nowrap">    
                        <thead>
                            <tr>
                                
                                <th>Tên thành phố</th>
                                <th>Tên quận huyện</th>
                                <th>Tên xã, phường, thị trấn</th>
                                <th>Phí vận chuyển</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>';

        $get_db_delivery = ModelShippingFees::orderby('id_fee','desc')->get();
        foreach ($get_db_delivery as $key => $delivery){
            $output .='     <tr>
                                
                                <td>'.$delivery->city->name_city.'</td>
                                <td>'.$delivery->district->name_district.'</td>
                                <td>'.$delivery->cwt->name_cwt.'</td>
                                <td contenteditable data-shipping_fee="'.$delivery->id_fee.'" class="edit_shipping_fee">'.number_format($delivery->shipping_fee,0,',','.')." VNĐ".'</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href=""><i class="dw dw-edit2"></i> Chỉnh sửa</a>
                                            <a class="dropdown-item" href="" onclick="return confirm("Bạn có muốn xóa mã này không?"");"><i class="dw dw-delete-3"></i> Xóa</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
        }

        $output .= '        </tbody>
                        </table>';
        echo $output;
    }

    
}
