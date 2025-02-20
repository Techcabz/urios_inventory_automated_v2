<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExpirationChecker;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
      
        return view('frontend.account.dashboard');
    }

 

    public function profile()
    {
        return view('frontend.account.profile');
    }

    public function travel()
    {
        return view('frontend.account.travel');
    }

    public function security()
    {
        return view('frontend.account.security');
    }
}
