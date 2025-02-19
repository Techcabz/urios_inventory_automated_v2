<?php

namespace App\Livewire\Frontend\Account;

use Carbon\Carbon;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\TravelOrder;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Travel extends Component
{
    use WithFileUploads;

    public $note, $td_id, $photos;

    public function render()
    {
        // $travelist = TravelOrder::where(['user_id' =>  auth()->user()->id])->orderBy('created_at', 'DESC')->get();
        $travelist = TravelOrder::where('user_id', auth()->user()->id)->get()
            ->map(function ($event) {


                $date = Carbon::parse($event->date)->format('F j, Y');
                $time = Carbon::parse($event->time)->format('g:i A');

                if (!is_null($event->vehicle)) {
                    $vehicleString = '';
                    $vehicleCount = 0;

                    foreach ($event->vehicle as $value) {
                        $vehicle = Vehicle::find($value->vehicle_id);

                        if ($vehicle) {

                            $itemName = ucfirst($vehicle->name);

                            if (!empty($itemsString)) {
                                $itemsString .= ', ';
                            }

                            $vehicleString .= $itemName;
                            $vehicleCount++;
                            if ($vehicleCount >= 3) {
                                break;
                            }
                        }
                    }
                    if (count($event->vehicle) > 3) {
                        $vehicleString .= '...';
                    }
                }


                return (object) [
                    'unit' => $vehicleString,
                    'date' =>  $date,
                    'time' =>  $time,
                    'image' => $event->image,
                    'status' => $event->status,
                    'created_at' => $event->created_at,
                ];
            });


        return view('livewire.frontend.account.travel', ['travelist' =>  $travelist]);
    }


    public function closeModal()
    {
        return $this->redirect('/myaccount/travel', navigate: true);
    }
}
