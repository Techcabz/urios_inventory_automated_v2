<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TravelOrder;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $userPending = User::where('user_status', 1)->count();
    
        return view('admin.dashboard', [
           
            'userPending' => $userPending
        ]);
    }

    public function category()
    {
        return view('admin.category.index');
    }
}
