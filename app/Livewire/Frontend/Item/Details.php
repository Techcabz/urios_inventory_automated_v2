<?php

namespace App\Livewire\Frontend\Item;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Details extends Component
{
    public $items;
    public $single_qty, $item_id, $item_name;

    public function mount($item)
    {
        $this->items = $item;
        $this->item_id = $item->id;
        $this->item_name = $item->name;
        $this->single_qty = 1;
    }

    public function savetoCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login.custom');
        }

        $user = Auth::user();
        if ($user->status == 'incompleted') {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Please complete your profile before borrowing items.');
            $this->dispatch('redirectWithDelay', url: '/myaccount/profile', delay: 3000);
            return;
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('item_id', $this->items->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $this->single_qty);
        } else {
            Cart::create([
                'user_id'  => Auth::id(),
                'item_id'  => $this->item_id,
                'quantity' => $this->single_qty ?? 1,
            ]);
        }

        $this->dispatch('cartlistAddedUpdated');
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Item ' . $this->item_name . ' added to Borrow cart.');

    }

    public function render()
    {
        return view('livewire.frontend.item.details', ['item' => $this->items]);
    }
}
