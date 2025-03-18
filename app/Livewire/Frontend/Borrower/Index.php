<?php

namespace App\Livewire\Frontend\Borrower;

use App\Models\Cart;
use App\Models\UserDetails;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Index extends Component
{
    public $cart_list;
    public $item_qty = [];

    public function mount($cart)
    {
        $this->cart_list = $cart;

        // Initialize item quantities
        foreach ($this->cart_list as $cartItem) {
            $this->item_qty[$cartItem->id] = $cartItem->quantity;
        }
    }

    public function decrementItemQuantity($id)
    {
        if (isset($this->item_qty[$id]) && $this->item_qty[$id] > 1) {
            $this->item_qty[$id]--;
            $this->updateCartQuantity($id, $this->item_qty[$id]);
        }
    }

    public function incrementItemQuantity($id)
    {
        $cartItem = Cart::find($id);
          
        if ($cartItem && isset($this->item_qty[$id]) && $this->item_qty[$id] <= $cartItem->quantity) {
            $this->item_qty[$id]++;

            $this->updateCartQuantity($id, $this->item_qty[$id]);
        }
    }

    public function updatedItemQty($value, $id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $maxQuantity = $cartItem->quantity;
            if ($value < 1) {
                $this->item_qty[$id] = 1;
            } elseif ($value > $maxQuantity) {
                $this->item_qty[$id] = $maxQuantity;
            } else {
                $this->item_qty[$id] = $value;
            }

            $this->updateCartQuantity($id, $this->item_qty[$id]);
        }
    }

    public function handleInputItemChange($id, $value)
    {
        $this->updatedItemQty($value, $id);
    }

    private function updateCartQuantity($id, $quantity)
    {
        Cart::where('id', $id)->update(['quantity' => $quantity]);
        $this->dispatch('cartlistUpdated');
    }

    public function render()
    {
        $users = UserDetails::where('users_id', auth()->user()->id)->first();
        
        return view('livewire.frontend.borrower.index', [
            'cart_list' => $this->cart_list, 'users' => $users
        ]);
    }
}
