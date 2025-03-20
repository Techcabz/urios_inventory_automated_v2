<?php

namespace App\Livewire\Admin\Borrowing\Transaction;

use App\Models\Borrowing;
use App\Models\Borrowing_cart;
use App\Models\Cart;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;


class Online extends Component
{
    public $barcode;
    public $userDetails, $users, $borrowDetails;
    public $cartList;
    public $item_qty = [];

    public function mount()
    {
        $barcode = "B00001";
        $this->cartList = collect();
        // $this->processBarcode($barcode);
    }

    public function processBarcode($barcode)
    {
        if (!preg_match('/^B\d{5}$/', $barcode)) {
            $this->dispatch('saveModal', status: 'warning',  position: 'top', message: 'Invalid barcode format.');
            return;
        }

        if ($barcode) {
            $borrow = Borrowing::where('barcode_reference', $barcode)->first();

            if ($borrow && $borrow->users) {
                $user = User::where('id', $borrow->user_id)->first();
                if ($user) {
                    $this->userDetails = $user->userDetails->first();
                    $this->users = $user;
                }
                $borrowCart = Borrowing_cart::where('borrowing_id', $borrow->id)->first();
                if ($borrowCart) {
                    $cart = Cart::where('id', $borrowCart->cart_id)->get();
                    $this->cartList = $cart ?: collect();

                    foreach ($this->cartList as $carts) {
                        $this->item_qty[$carts->id] = $carts->quantity;
                    }
                } else {
                    $this->cartList = collect();
                }


                $borrow->start_date = Carbon::parse($borrow->start_date)->format('F d, Y');
                $borrow->end_date = Carbon::parse($borrow->end_date)->format('F d, Y');

                $this->borrowDetails = $borrow;


                // $this->dispatch('saveModal', status: 'success', position: 'top', message: 'Borrowing record found successfully!');
            } else {
                session()->flash('error', 'Item not found.');
                $this->users = null;
                $this->userDetails = null;
                $this->borrowDetails = null;
            }
        }

        $this->reset('barcode');
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
        $this->dispatch('cartlistAddedUpdated');
        $this->refreshCartList();
    }

    public function removeItemFromCart($id)
    {
        Cart::where('id', $id)->delete();

        $this->dispatch('cartlistAddedUpdated');

        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Item removed from cart.');
    }

    private function refreshCartList()
    {
        $borrowCart = Borrowing_cart::where('borrowing_id', $this->borrowDetails->id)->first();
        if ($borrowCart) {
            $this->cartList = Cart::where('id', $borrowCart->cart_id)->get();
            foreach ($this->cartList as $carts) {
                $this->item_qty[$carts->id] = $carts->quantity;
            }
        } else {
            $this->cartList = collect();
        }
    }

    public function approveBorrowing()
    {
        dd('test');
        // if (!$this->borrowDetails) {
        //     $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'No borrowing record found.');
        //     return;
        // }

        // $borrow = Borrowing::find($this->borrowDetails->id);

        // if ($borrow && $borrow->status !== 'approved') {
        //     $borrow->update(['status' => 'approved']);

        //     $this->borrowDetails->status = 'approved'; // Update UI without reloading

        //     $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Borrowing Approved.');
        // } else {
        //     $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Already approved or not found.');
        // }
    }


    public function render()
    {
        return view('livewire.admin.borrowing.transaction.online', [
            'userDetails' => $this->userDetails,
            'user' => $this->users,
            'borrowDetails' => $this->borrowDetails,
            'cartList' => $this->cartList
        ]);
    }
}
