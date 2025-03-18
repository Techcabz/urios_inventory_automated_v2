<?php

namespace App\Livewire\Frontend\Borrower;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Thank1 extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $borrowID;
    public $item_qty = [];
    public $editMode = false;

    public function mount($borrowID)
    {
        $this->borrowID = $borrowID;
        $items = Item::where('item_id', $this->borrowID)->get();
        foreach ($items as $item) {
            $this->item_qty[$item->id] = $item->quantity; 
        }
    }

    public function render()
    {
        return view('livewire.frontend.borrower.thank1');
    }
}
