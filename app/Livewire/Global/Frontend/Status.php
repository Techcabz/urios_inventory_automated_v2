<?php

namespace App\Livewire\Global\Frontend;

use Livewire\Component;

class Status extends Component
{
    public $borreturn, $remarks, $barcode, $borID, $users;
    public $borrower;
    protected $listeners = ['echo:borrowing-status' => 'refreshStatus'];

    public function refreshStatus($data)
    {
        logger("✅ BorrowingApproved Event Received!", ['data' => $data]);

        dd($data);
        if ($data['borrowId'] == $this->borID) {
            // Update status in real-time
            $this->borreturn->status = $data['status'];
        }
    }


    public function mount($details, $borreturn, $remarks, $barcode, $borID, $users)
    {

        $this->borID = $borID;
        $this->borreturn = $borreturn;
        $this->borrower = $details;
        $this->remarks = $remarks;
        $this->barcode = $barcode;
        $this->users = $users;
    }





    public function render()
    {
        return view('livewire.global.frontend.status', ['borreturn' => $this->borreturn, 'remarks' => $this->remarks, 'barcode' => $this->barcode, 'borID' => $this->borID, 'details' => $this->borrower, 'users' => $this->users]);
    }
}
