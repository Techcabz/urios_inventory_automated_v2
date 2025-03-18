<?php

namespace App\Http\Controllers\Frontend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class FrontendController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $items = Item::where('status', '0')->orderBy('created_at', 'DESC')->get();
        return view('frontend.index', compact('categories', 'items'));
    }

    public function item($uuid)
    {
        $item = Item::where('uuid', $uuid)->firstOrFail();

        return view('frontend.items.single.index', compact('item'));
    }

    public function categories_base($slug)
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $category = Category::where('name', $slug)->firstOrFail();

        $items = Item::where('category_id', $category->id)
            ->where('status', '0')
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('frontend.index', compact('categories', 'items'));
    }

    public function cart()
    {
        if (!Auth::check()) {
            return redirect()->route('login.custom');
        }
       
        return view('frontend.cart.index');
 
    }
}
