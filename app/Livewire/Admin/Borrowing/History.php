<?php

namespace App\Livewire\Admin\Borrowing;

use App\Models\Borrowing;
use Livewire\Component;
use Livewire\WithoutUrlPagination as LivewireWithoutUrlPagination;
use Livewire\WithPagination as LivewireWithPagination;
use WithPagination, WithoutUrlPagination;


class History extends Component
{
    protected $PerPage = 3;

    use LivewireWithPagination, LivewireWithoutUrlPagination;

    public function render()
    {
        $borrow_pending = Borrowing::where('status', 0)->paginate($this->PerPage, pageName: 'pending-page');
        $borrow_approved = Borrowing::where('status', 1)->paginate($this->PerPage, pageName: 'approved-page');
        $borrow_cancel = Borrowing::where('status', 2)->paginate($this->PerPage, pageName: 'cancel-page');
        $borrow_complete = Borrowing::where('status', 3)->paginate($this->PerPage, pageName: 'complete-page');
       
        return view('livewire.admin.borrowing.history', compact('borrow_pending','borrow_approved', 'borrow_cancel', 'borrow_complete'));
    }
}
