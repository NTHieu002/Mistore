<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Arr;

session_start();
class CheckOutController extends Controller
{
    public function login_checkout() {

        if(!session('user_name') && !session('user_email')) {
            return view('pages.checkout.login_check');
        } else {
            $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
            $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();
            $user_email = session('user_email');
            $user_name = session('user_name');
            
            if(!session('provider')) {
                $user_info = DB::table('tbl_users')->join('tbl_address','tbl_address.user_id','=','tbl_users.user_id')
                ->where('tbl_users.user_name',$user_name)->where('tbl_users.user_email',$user_email)->get();
                Session::put('user_info',$user_info);
                return view('pages.checkout.check_out')->with('category_product',$category_product)->with('category_brand',$category_brand)
                ->with('user_info',$user_info);
            } else if(session('provider')){
                $check_user = DB::table('tbl_users')->where('user_name',$user_name)->where('user_email',$user_email)->first();
                if($check_user) {
                    $user_info_provider = DB::table('tbl_users')->join('tbl_address','tbl_address.user_id','=','tbl_users.user_id')
                    ->where('tbl_users.user_name',$user_name)->where('tbl_users.user_email',$user_email)->get();
                    return view('pages.checkout.check_out')->with('user_info',$user_info_provider)->with('category_product',$category_product)->with('category_brand',$category_brand);
                } else {
                    Session::put('check_first_login',true);
                    return view('pages.checkout.check_out')->with('user_name',$user_name)->with('user_email',$user_email)
                    ->with('category_product',$category_product)->with('category_brand',$category_brand);
                }
            }
        } 
    }
    
    public function log_out() {
        Session::flush();
        return view('pages.checkout.login_check');
    }

    public function index(Request $request) {
        $user_email = $request->user_email;
        $user_password = md5($request->user_password) ;
        $user_info = DB::table('tbl_users')->where('user_email',$user_email)->where('user_password',$user_password)->first();
        if($user_info==true) {
            Session::put('user_name',$user_info->user_name);
            Session::put('user_email',$user_email);
            Session::put('user_id',$user_info->user_id);
            return Redirect::to('home');
        } else {
            Session::put('message','Sai Email ho???c M???t kh???u');
            return Redirect::to('login-checkout');
        }
    }

    
    public function resister_account(Request $request) {
        $data = array();
        $data['user_name'] = $request->user_name;
        $data['user_phone'] = $request->phone;
        $data['user_email'] = $request->email;
        $data['user_password'] = md5($request->password) ;
        
        $data_address = array();
        $user_id = DB::table('tbl_users')->insertGetId($data);
        $data_address['address'] = $request->address;
        $data_address['user_id'] = $user_id;

        DB::table('tbl_address')->insert($data_address);
        Session::put('message','T???o t??i kho???n Th??nh C??ng');
        return Redirect::to('login-checkout');
    }

    
    public function save_order_user(Request $request) {
            $data_user_info = array();
            $data_user_info['user_phone'] = $request->phone;
            $data_user_info['user_name'] = $request->name;
            $data_user_info['user_email'] = $request->email;
            $data_user_info['user_password'] = ' ';
            $address = $request->address;
            $user_id = DB::table('tbl_users')->insertGetId($data_user_info);
            DB::table('tbl_address')->insert([
                'user_id' => $user_id,
                'address' => $address
            ]);
            return Redirect::to('/call-back-check-out');
    }

    public function call_back_checkout() {
        $category_product = DB::table('tbl_category_product')->where('category_status',1)->orderby('category_id')->get();
        $category_brand = DB::table('tbl_brands')->where('brand_status',1)->orderby('brand_id')->get();
        $user_email = session('user_email');
        $user_name = session('user_name');
        $user_info = DB::table('tbl_users')->join('tbl_address','tbl_address.user_id','=','tbl_users.user_id')
                ->where('tbl_users.user_name',$user_name)->where('tbl_users.user_email',$user_email)->get();
        Session::put('check_first_login',false);
        return view('pages.checkout.check_out')->with('user_info',$user_info)->with('message','C???p Nh???t SDT v?? ?????a Ch???')
        ->with('category_product',$category_product)->with('category_brand',$category_brand);
    }

    public function save_order(Request $request) {
        $user_email = session('user_email');
        $user_name = session('user_name');
        $user_info = DB::table('tbl_users')->join('tbl_address','tbl_address.user_id','=','tbl_users.user_id')
        ->where('tbl_users.user_name',$user_name)->where('tbl_users.user_email',$user_email)->get();
        if(session('provider')) {
            
            $date = Carbon::now()->toDateString();
            $data_order = array(); 
            foreach($user_info as $value) {
                $data_order['user_id']  = $value->user_id;
                $data_order['day_order']  = $date;
            }
            $total = $request->total;
            if($total) {
                $data_order['order_total'] = $total;
            } else {
                $data_order['order_total'] = Cart::getTotal() ;
            }
            $data_order['order_status'] = 0;
            $data_order['payment'] = $request->payment_way;
            
        }
        //insert

        $date = Carbon::now()->toDateString();
        $data_order = array(); 
        foreach($user_info as $value) {
            $data_order['user_id']  = $value->user_id;
            $data_order['day_order']  = $date;
        }
        $total = $request->total;
        if($total) {
            $data_order['order_total'] = $total;
        } else {
            $data_order['order_total'] = Cart::getTotal() ;
        }
        $data_order['order_status'] = 0;
        $data_order['payment'] = $request->payment_way;
        
        // insert tbl order
        $order_id = DB::table('tbl_orders')->insertGetId($data_order);


        // insert order details
        $cart_content = Cart::getContent();
        $discount = $request->discount;
        if($discount > 0) {
            $details_data = array();
            foreach($cart_content as $value) {
                $details_data['order_id']  = $order_id;
                $details_data['product_id']  = $value->id;
                $details_data['details_quantity']  = $value->quantity;
                $details_data['details_price']  = ($value->price - $discount);
                $details_data['details_discount'] = $discount;
                DB::table('tbl_order_details')->insert($details_data);
            }
        } else {
            $details_data = array();
            foreach($cart_content as $value) {
                $details_data['order_id']  = $order_id;
                $details_data['product_id']  = $value->id;
                $details_data['details_quantity']  = $value->quantity;
                $details_data['details_price']  = $value->price;
                $details_data['details_discount'] = 0;
                DB::table('tbl_order_details')->insert($details_data);
            }
        }
        Cart::clear();
        return Redirect::to('home');
    }
}
