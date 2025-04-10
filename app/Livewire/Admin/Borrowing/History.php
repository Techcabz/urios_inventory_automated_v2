<?php

namespace App\Livewire\Admin\Borrowing;

use App\Models\Borrowing;
use App\Models\Borrowing_cart;
use App\Models\BorrowingReturn;
use App\Models\Cart;
use App\Models\Remarks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination as LivewireWithoutUrlPagination;
use Livewire\WithPagination as LivewireWithPagination;
use WithPagination, WithoutUrlPagination;


class History extends Component
{
    public $remarks_msg;
    public $userDetails, $users, $borrowDetails;
    public $cartList;
    public $item_qty = [];
    public $remainingDays = 0;
    public $overdueDays = 0;

    protected $PerPage = 3;

    use LivewireWithPagination, LivewireWithoutUrlPagination;
    public function mount()
    {
        $this->cartList = collect();
    }
    public function showBorrow($id, $status)
    {

        if ($id) {
            $borrow = Borrowing::where('id', $id)->where('status', $status)->first();
            if ($borrow && $borrow->users) {
                $user = User::where('id', $borrow->user_id)->first();
                if ($user) {
                    $this->userDetails = $user->userDetails->first();
                    $this->users = $user;
                }
                $borrowCart = Borrowing_cart::where('borrowing_id', $borrow->id)->get();

                if ($borrowCart->isNotEmpty()) {
                    $cartIds = $borrowCart->pluck('cart_id')->toArray();

                    $this->cartList = Cart::whereIn('id', $cartIds)->get();

                    foreach ($this->cartList as $cart) {
                        $this->item_qty[$cart->id] = $cart->quantity;
                    }
                } else {
                    $this->cartList = collect();
                }



                $this->borrowDetails = $borrow;

                if ($borrow->end_date) {
                    $dueDate = Carbon::parse($borrow->end_date);
                    $now = Carbon::now();

                    if ($now->greaterThan($dueDate)) {
                        $this->overdueDays = $dueDate->diffInDays($now);
                        $this->remainingDays = 0;
                    } else {
                        $this->remainingDays = $now->diffInDays($dueDate);
                        $this->overdueDays = 0;
                    }
                }
            } else {
                $this->cartList = collect();
            }
        } else {
            $this->cartList = collect();
        }
    }

    public function resetData()
    {
        $this->userDetails = null;
        $this->users = null;
        $this->borrowDetails = null;
        $this->cartList = collect();
        $this->item_qty = [];
        $this->remainingDays = 0;
        $this->overdueDays = 0;
        $this->dispatch('closeModal');

        // $this->dispatch('messageModal', status: 'info', position: 'top', message: 'Data has been reset.');
    }


    public function approveBorrowing()
    {
        if (!$this->borrowDetails) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'No borrowing record found. Please scan a valid barcode.');
            return;
        }

        if ($this->isApprovalDisabled()) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Approval failed: Insufficient stock for one or more items.');
            return;
        }

        $borrow = Borrowing::find($this->borrowDetails->id);
        if ($borrow && $borrow->status !== 1) {
            // Reduce item stock quantity
            foreach ($this->cartList as $cart) {
                $item = $cart->item;
                if ($item) {
                    $item->decrement('quantity', $cart->quantity); // Subtract borrowed quantity
                }
            }

            $borrow->update(['status' => 1, 'approved_by' => Auth::id()]);

            $this->borrowDetails->status = 1;

            BorrowingReturn::create([
                'borrowing_id' => $borrow->id,
            ]);

            $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Borrowing request approved. Stock updated.');
            $this->resetData();
            $this->dispatch('closeModal');
        } else {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'This request has already been approved or does not exist.');
        }
    }

    public function isApprovalDisabled()
    {
        if (!$this->borrowDetails) {
            return true;
        }

        foreach ($this->cartList as $cart) {
            $data = Cart::find($cart->id);


            if ($data && $data->quantity > $data->item->quantity) {
                return true;
            }
        }

        return false;
    }

    public function declinedBorrowing()
    {

        if (!$this->borrowDetails) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'No borrowing record found.');
            return;
        }

        $borrow = Borrowing::find($this->borrowDetails->id);
        if ($borrow && $borrow->status !== 2) {
            $borrow->update(['status' => 2, 'approved_by' => Auth::id()]);

            if ($this->remarks_msg) {
                Remarks::create([
                    'remarks_msg' => $this->remarks_msg,
                    'borrowing_id' => $borrow->id,
                ]);
            }

            $this->borrowDetails->status = 2; // Update UI without reloading


            $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Borrowing Declined.');
            $this->resetData();
        } else {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Already declined or not found.');
        }
    }

    public function completeBorrowing()
    {
        if (!$this->borrowDetails) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'No borrowing record found. Please scan a valid barcode.');
            return;
        }

        $borrow = Borrowing::find($this->borrowDetails->id);
        if ($borrow && $borrow->status !== 3) {
            // Reduce item stock quantity
            foreach ($this->cartList as $cart) {
                $item = $cart->item;
                if ($item) {
                    $item->increment('quantity', $cart->quantity);
                }
            }

            $borrow->update(['status' => 3, 'approved_by' => Auth::id()]);

            $this->borrowDetails->status = 3;

            if ($borrow->borrowingReturn) {
                $borrow->borrowingReturn->update([
                    'returned_at' => now(),
                    'notes' => 'Items returned in good condition'
                ]);
            } else {
                // Create new return record
                $borrow->borrowingReturn()->create([
                    'borrowing_id' => $borrow->id,
                    'returned_at' => now(),
                    'notes' => 'Items returned in good condition'
                ]);
            }

            $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Borrowing request approved. Stock updated.');
            $this->resetData();
            $this->dispatch('closeModal');
        } else {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'This request has already been approved or does not exist.');
        }
    }


    public function render()
    {
        $borrow_pending = Borrowing::where('status', 0)->paginate($this->PerPage, pageName: 'pending-page');
        $borrow_approved = Borrowing::where('status', 1)->paginate($this->PerPage, pageName: 'approved-page');
        $borrow_cancel = Borrowing::where('status', 2)->paginate($this->PerPage, pageName: 'cancel-page');
        $borrow_complete = Borrowing::where('status', 3)->paginate($this->PerPage, pageName: 'complete-page');

        return view('livewire.admin.borrowing.history', compact('borrow_pending', 'borrow_approved', 'borrow_cancel', 'borrow_complete'));
    }
}
