<?php

namespace App\Livewire\Frontend\Item;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class General extends Component
{
    use WithPagination, WithoutUrlPagination;


    public $categories;
    public function render()
    {

        $this->categories = Category::orderBy('created_at', 'DESC')->get();
        return view('livewire.frontend.item.general', [
            'items' => Item::orderBy('created_at', 'DESC')->get(), 
            'categories' => $this->categories
        ]);
    }
}
