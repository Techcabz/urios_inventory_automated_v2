<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PlaceBorrower extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->status == "incompleted") {
            if (auth()->user()->status == "incompleted") {
                Session::flash('status', 'warning');
                Session::flash('message', 'Please complete your details before adding items or property under the profile page');
                return redirect('/myaccount/profile');
            }
        }
      //  return view('frontend.reservation_process.index');
    }

    public function thankyou(Request $request, $uuid)
    {

        if (!empty($uuid) || $uuid != "") {

            $borrower = Borrowing::where('uuid', 'like', '%' . $uuid . '%')
                ->orderByDesc('id')
                ->first();


            if ($borrower) {
                $barcode = $borrower->uuid;
               
                // $remarks = remarks::where('reservation_id', $reservation->id)->first();
                $remarks = '';
                // dd($referenceNumber);
                $reservationID = $borrower->id;
                
                $users = UserDetails::where('users_id', $borrower->user_id)->first();

                return view('frontend.cart.status', ['remarks' =>  $remarks, 'barcode' => $barcode, 'reservationID' => $reservationID, 'details' => $borrower, 'users' => $users]);
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');
        }
    }
}
