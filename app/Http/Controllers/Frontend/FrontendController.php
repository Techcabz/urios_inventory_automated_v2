<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;

class FrontendController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $items = Item::where('status', '0')->orderBy('created_at', 'DESC')->get();
        return view('frontend.index', compact('categories', 'items'));
    }

    public function items($category_slug) {}
}
