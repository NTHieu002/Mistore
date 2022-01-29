<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;
session_start();

class AdminController extends Controller
{   
    public function authenLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function index() {
        return view('admin_login'); 
    }

    public function showDashBoard() {
        $this->authenLogin();
        return view('admin.dashboard'); 
    }

    public function dashBoard(Request $request) {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $prefix_name = Str::substr($admin_email,0,5);
        if($prefix_name=='admin'){
            $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
            if($result==true) {
                Session::put('admin_name',$result->admin_name);
                Session::put('admin_id',$result->admin_id);
                Session::put('admin_permission',0);
                return Redirect::to('/dashboard');
            } else {
                Session::put('message','Sai Email hoặc Mật khẩu');
                return Redirect::to('/admin');
            }
        } else {
            $result = DB::table('tbl_staffs')->where('staff_email',$admin_email)->where('staff_password',$admin_password)->first();
            if($result==true) {
                Session::put('admin_name',$result->staff_name);
                Session::put('admin_id',$result->staff_id);
                Session::put('admin_permission',$result->staff_permission);
                return Redirect::to('/dashboard');
            } else {
                Session::put('message','Sai Email hoặc Mật khẩu');
                return Redirect::to('/admin');
            }
        }
        
        

    }

    public function logOut() {
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    public function manage_order() {
        $all_order = DB::table('tbl_orders')->join('tbl_users','tbl_users.user_id','=','tbl_orders.user_id')->orderByDesc('order_id')->get();
        $confirm_staff = DB::table('tbl_staffs')->join('tbl_orders','tbl_orders.staff_id','=','tbl_staffs.staff_id')->get();
        return view('admin.manage_order')->with('all_order',$all_order)->with('confirm_staff',$confirm_staff);
    }

    public function view_order($order_id) {
        $order_details = DB::table('tbl_order_details')->join('tbl_products','tbl_products.product_id','=','tbl_order_details.product_id')
        ->join('tbl_images_product','tbl_images_product.product_id','=','tbl_products.product_id')
        ->where('tbl_order_details.order_id',$order_id)->get();


        $customer_info = DB::table('tbl_orders')->join('tbl_users','tbl_users.user_id','=','tbl_orders.user_id')
        ->join('tbl_address','tbl_address.user_id','=','tbl_users.user_id')
        ->where('tbl_orders.order_id',$order_id)->get();

        $total = DB::table('tbl_orders')->where('tbl_orders.order_id',$order_id)->value('order_total');
        
        return view('admin.view_order')->with('order_details',$order_details)->with('customer_info',$customer_info)->with('total',$total);
    }

    public function update_order(Request $request, $order_id) {
        $order_status = $request->order_status;
        $day_delivery = $request->day_delivery;
        $staff_id = session::get('admin_id');
        DB::table('tbl_orders')->where('order_id',$order_id)->update(['order_status' => $order_status]);
        DB::table('tbl_orders')->where('order_id',$order_id)->update(['day_delivery' => $day_delivery]);
        DB::table('tbl_orders')->where('order_id',$order_id)->update(['staff_id' => $staff_id]);

        Session::put('message','đã cập nhật');
        return Redirect::to('manage-order');
    }

    public function del_order($order_id) {
        DB::table('tbl_orders')->where('order_id',$order_id)->delete();
        Session::put('message','đã xóa');
        return Redirect::to('manage-order');
    }


    // staff do admin quan ly
    public function all_staff() {
        $all_staff = DB::table('tbl_staffs')->get();
        return view('admin.all_staff')->with('all_staff',$all_staff);
    }

    public function update_staff(Request $request, $staff_id) {
        $val = $request->staff_position;
        $staff_position = '';
        $staff_permission = '';
        if($val==1) {
            $staff_position = 'Quản lý';
            $staff_permission = 1;
        }
        if($val==2) {
            $staff_position = 'Nhân Viên';
            $staff_permission = 2;
        }
        DB::table('tbl_staffs')->where('staff_id',$staff_id)->update(['staff_position' => $staff_position]);
        DB::table('tbl_staffs')->where('staff_id',$staff_id)->update(['staff_permission' => $staff_permission]);

        Session::put('message','đã cập nhật chức vụ nhân viên');
        return Redirect::to('all-staff');
    }

    public function del_staff($staff_id) {
        DB::table('tbl_staffs')->where('staff_id',$staff_id)->delete();
        Session::put('message','đã xóa nhân viên');
        return Redirect::to('all-staff');
    }

    public function add_staff() {
        return view('admin.add_staff');
    }

    public function save_staff(Request $request) {
        $data = array();
        $data['staff_name'] = $request->staff_name;
        $data['staff_email'] = $request->staff_email;
        $data['staff_phone'] = $request->staff_phone;
        $data['staff_password'] = md5($request->staff_password);
        $staff_position_val = $request->staff_position;
        if($staff_position_val==1) {
            $data['staff_position'] = 'Quản lý';
            $data['staff_permission'] = 1;
        } else {
            $data['staff_position'] = 'Nhân Viên';
            $data['staff_permission'] = 2;
        }
        DB::table('tbl_staffs')->insert($data);
        Session::put('message','đã Thêm nhân viên');
        return Redirect::to('all-staff');
    }

    //PDF
    public function print_pdf($order_id) {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order($order_id));
        return $pdf->stream();
    }

    public function print_order($order_id) {
        $order_details = DB::table('tbl_order_details')->join('tbl_products','tbl_products.product_id','=','tbl_order_details.product_id')
        ->join('tbl_images_product','tbl_images_product.product_id','=','tbl_products.product_id')
        ->where('tbl_order_details.order_id',$order_id)->get();


        $customer_info = DB::table('tbl_orders')->join('tbl_users','tbl_users.user_id','=','tbl_orders.user_id')
        ->join('tbl_address','tbl_address.user_id','=','tbl_users.user_id')
        ->where('tbl_orders.order_id',$order_id)->first();

        $total = DB::table('tbl_orders')->where('tbl_orders.order_id',$order_id)->value('order_total');

        $output = ' ';
        $output .= "
            <style> body {
                        font-family: Dejavu Sans
                    }
                    th {
                        text-align: left;
                    }
                    .tb_styling tr td{
                        border:1px solid  #000;
                    }
                    .tb_styling thead th{
                        border:1px solid  #000;
                        text-align: center;
                    }
                    .tb_styling {
                        width: 100%;
                        text-align: center;
                    }
            </style>
            <h1><center>CỬA HÀNG SMART PHONE MISTORE</center></h1>
            <h2><center>Hóa Đơn</center></h2>
            <h3>Thông Tin Khách Hàng</h3>
            <table>
                <thead>
                    <tr>
                        <th>Họ Tên KH: </th>
                        <td>$customer_info->user_name</td>
                    </tr>
                    <tr>
                        <th>SDT: </th>
                        <td>$customer_info->user_phone</td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td>$customer_info->user_email</td>
                    </tr>
                    <tr>
                        <th>Địa Chỉ: </th>
                        <td>$customer_info->address</td>
                    </tr>
                </thead>
            </table>
            <h3>Thông Tin Sản Phẩm</h3>
            <table class = 'tb_styling'>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Sẩn Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Giảm Giá</th>
                    </tr>
                </thead>
                <tbody>
               
        ";
        foreach($order_details as $details_value) {
            $i=0;
            $i = $i+1;
            $output .= "
                <tr>
                    <td>$i</td>
                    <td>$details_value->product_name</td>
                    <td>$details_value->product_price đ</td>
                    <td>$details_value->details_quantity</td>
                    <td>$details_value->details_discount đ</td>
                </tr>
            ";
        }

        $output .= " 
             </tbody>
            </table>
            <h3>Tổng: $total đ </h3>
            <h3 style='float: right; margin-right:100px'>Ký Tên</h3>
        ";
        return $output;
    }   

}
