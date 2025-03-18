<?php

namespace App\Livewire\Frontend\Borrower;

use App\Models\Item;
use App\Notifications\CustomerNotification;
use Illuminate\Support\Facades\Notification;

use Carbon\Carbon;
use Livewire\Component;

class Thank extends Component
{
    public $bor_id, $expire_status = false;
    public $details;

    public function mount($details)
    {
        $currentDate = Carbon::now();

        if ($details) {
            $this->details =  $details;

            $returnDate = Carbon::parse($this->details->date_from);
            $this->bor_id = $this->details->id;

            if ($currentDate->isSameDay($returnDate)) {
                $this->expire_status = true;
            }
        }
    }

    public function cancelReservation()
    {

    //     $items = Item::where('item_id', $this->reservation_id)->get();
    //     $reserv = Reservation::where('id', $this->reservation_id)->first();
    //     $users = User::where('id', $reserv->users_id)->first();
    //     $admin = User::where('role_as', 1)->first();

    //     foreach ($items as $item) {
    //         $reservation = Reservation::findOrFail($item->reservation_id);

    //         $reservation->update([
    //             'status' => 2,
    //         ]);
    //     }

    //     $link = route('reservation.pending');
    //     $details = [
    //         'greeting' => "Reservation Cancelled",
    //         'body' => "The reservation has been cancelled by the $users->username. .",
    //         'lastline' => '',
    //         'regards' => "Login to admin panel now?: $link"
    //     ];

    //     Notification::send($admin, new CustomerNotification($details));
    //     $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Reservation canceleed successfully.');
    //     return redirect()->route('place_reservation', ['reference' => $reserv->reference_num]);
    // 
    }

    public function render()
    {
        return view('livewire.frontend.borrower.thank', ['expire_status'=> $this->expire_status]);
    }
}
