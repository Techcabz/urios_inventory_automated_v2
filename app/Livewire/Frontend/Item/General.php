<?php

namespace App\Livewire\Frontend\Item;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class General extends Component
{

    public $items, $categories;
    use WithPagination, WithoutUrlPagination;
    public function mount($items, $categories)
    {
        $this->items = $items;
        $this->categories = $categories;
    }

    public function render()
    {
      
        return view('livewire.frontend.item.general', ['items' => $this->items, 'categories' => $this->categories]);
    }
}
