<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Arr;
use App\Models\Social;
use Barryvdh\DomPDF\Facade;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Session as FacadesSession;

session_start();
class SocialateController extends Controller
{
    public function login_fb($social) {
        return Socialite::driver($social)->redirect();
    }
    
    public function login_gg($social) {
        return Socialite::driver($social)->redirect();
    }

    public function call_back_gg() {
        $provider = Socialite::driver('google')->user();
        //dd($provider);
        if($provider) {
            $user_info = DB::table('tbl_social')->where('provider_user_id',$provider->id)->first();
            if($user_info) {
                Session::put('user_name',$provider->name);
                Session::put('user_email',$provider->email);
                Session::put('user_id',$provider->id);
                Session::put('provider','google');
                return Redirect::to('home');
            } else {
                $user_social = new Social();
                $user_social->provider_user_id = $provider->id;
                $user_social->user_email = $provider->email;
                $user_social->provider = 'google';
                $user_social->user_name = $provider->name;
                $user_social->user_phone = ' ';
                $user_social->address = ' ';
                $user_social->save();
                Session::put('user_name',$provider->name);
                Session::put('user_email',$provider->email);
                Session::put('user_id',$provider->id);
                Session::put('provider','google');
                return Redirect::to('home');
            }
        } 
        
    }
    
}