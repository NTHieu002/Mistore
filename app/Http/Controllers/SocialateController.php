<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialateController extends Controller
{
    public function login_fb($social) {
        return Socialite::driver($social)->redirect();
    }
    
    public function check_info($social) {
        $info = Socialite::driver($social)->user();
        dd($info);
    }
}
