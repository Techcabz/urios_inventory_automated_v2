<?php

namespace App\Livewire\Frontend\Account;

use App\Models\Reservation;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $reservTotal = Reservation::where('status', 3)->where('users_id', auth()->user()->id)->count();
        $reservPending = Reservation::where('status', 2)->where('users_id', auth()->user()->id)->count();
        return view('livewire.frontend.account.dashboard', [
            'reservTotal' => $reservTotal,
            'reservPending' => $reservPending
        ]);
    }
}
