<?php

namespace App\Livewire\Frontend;

use App\Models\Item;
use Livewire\Component;

class ActiveBorrower extends Component
{

    public function render()
    {
        // $borrowedItems = Item::whereHas('borrowings', function($query) {
        //     $query->where('status', 1)})->with(['borrowings' => function($query) {
        //     $query->where('status', 1)
        //           ->with('users.userDetail'); // Load user details
        // }])
        // ->get();

        return view('livewire.frontend.active-borrower');
    }
}
