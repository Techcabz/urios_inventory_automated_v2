<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function __construct()
    {
     
    }

    public function index()
    {

        return view('frontend.index');
    }


}
