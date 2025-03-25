<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Item;
use App\Models\TravelOrder;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $userPending = User::where('user_status', 1)->count();
        $user = User::where('role_as', 0)->count();
        
        $borrow_pending = Borrowing::where('status', 0)->count();
        $borrow_approved = Borrowing::where('status', 1)->count();
        $borrow_cancel = Borrowing::where('status', 2)->count();
        $items = Item::count();
       

        return view('admin.dashboard',compact('items','userPending','borrow_pending','borrow_approved', 'borrow_cancel', 'user'));
    }

    public function category()
    {
        return view('admin.category.index');
    }

    public function items()
    {
        return view('admin.items.index');
    }
}
