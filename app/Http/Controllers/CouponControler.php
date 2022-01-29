<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
session_start();

class CouponControler extends Controller
{
    public function all_coupon() {
        $coupon = Coupon::orderby('coupon_id','DESC')->get();
        return view('admin.Coupon.all_coupon')->with(compact('coupon'));
    }

    public function add_coupon() {
        return view('admin.Coupon.add_coupon');
    }

    public function save_coupon(Request $request) {
        $data = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_qnt = $data['coupon_qnt'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_value = $data['coupon_value'];
        $coupon->coupon_status = $data['coupon_status'];

        $coupon->save();
        Session::put('message','Thêm Mã Coupon Thành công');
        return Redirect::to('all-coupon');
    }

    public function unActive_coupon($coupon_id) {
        $coupon = Coupon::where('coupon_id','=',$coupon_id);
        $coupon->update(['coupon_status'=> 0]);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('all-coupon');
    }
    public function Active_coupon($coupon_id) {
        $coupon = Coupon::where('coupon_id','=',$coupon_id);
        $coupon->update(['coupon_status'=> 1]);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('all-coupon');
    }
    public function delete_coupon($coupon_id) {
        $coupon = Coupon::where('coupon_id','=',$coupon_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-coupon');
    }
}
