<?php

namespace App\Livewire\Frontend\Account;

use App\Models\Reservation as ModelsReservation;
use Livewire\Component;

class Reservation extends Component
{
    public function render()
    {
        $reservationlists = ModelsReservation::where('users_id', auth()->user()->id)->get()->sortByDesc('date_filled');;
        return view('livewire.frontend.account.reservation', ['reservationlists' => $reservationlists]);
    }
}
