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
use App\Notifications\CustomerNotification;
use Illuminate\Support\Facades\Notification;

class History extends Component
{
    public $remarks_msg;
    public $userDetails, $users, $borrowDetails;
    public $cartList;
    public $item_qty = [];
    public $remainingDays = 0;
    public $overdueDays = 0;

    protected $PerPage = 3;

    public $damagedQuantities = [];
    use LivewireWithPagination, LivewireWithoutUrlPagination;




    public function mount()
    {
        $this->cartList = collect();
    }

    public function markItemsAsDamaged()
    {
        // foreach ($this->cartList as $cart) {
        //     $item = $cart->item;
        //     $borrowedQty = $cart->quantity;
        //     $damagedQty = $this->damagedQuantities[$item->id] ?? 0;

        //     // Safety check: cannot damage more than borrowed
        //     if ($damagedQty > $borrowedQty) {
        //         $damagedQty = $borrowedQty;
        //     }

        //     $returnedQty = $borrowedQty - $damagedQty;

        //     // Update the item stock:
        //     if ($returnedQty > 0) {
        //         $item->quantity += $returnedQty; // Only return non-damaged quantity
        //     }

        //     // Handle damaged items
        //     if ($damagedQty > 0) {
        //         // You can log it, or update a separate 'damaged_quantity' field if you want
        //         // For example:
        //         // $item->damaged_quantity += $damagedQty;
        //     }

        //     $item->save();
        // }

        // Update borrowing status
        $this->borrowDetails->status = 3;
        $this->borrowDetails->save();

        // Close modal
        $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Borrowing request complete. Stock updated.', modal: '#confirmMarkDoneModal');

        $this->resetData();
    }

    public function continueWithRestriction()
    {
        // $this->completeBorrowing();
    }

    public function continueRemoveRestriction()
    {
        //  $this->completeBorrowing();
        $this->users->update([
            'user_status' => 0, // restricted
            'restricted_until' => Null,
        ]);
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

            $users = User::find($borrow->user_id);

            $link = route('cart.status', ['uuid' => $borrow->uuid]);
            $details = [
                'greeting' => "Borrowing Approved",
                'body' => "Your borrowing request has been approved by the administrator.",
                'lastline' => '',
                'regards' => "Please visit: $link"
            ];

            Notification::send($users, new CustomerNotification($details));

            $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Borrowing request approved. Stock updated.', modal: '#viewDetailModal');
            $this->resetData();
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

            $users = User::find($borrow->user_id);

            $link = route('cart.status', ['uuid' => $borrow->uuid]);
            $details = [
                'greeting' => "Borrowing Approved",
                'body' => "Your borrowing request  has been cancelled by the administrator. For more information, please visit the office. . <br> Sorry for the inconvenience.",
                'lastline' => '',
                'regards' => "Please visit: $link"
            ];

            Notification::send($users, new CustomerNotification($details));


            $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Borrowing Declined.', modal: '#viewDetailModal');
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

            $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Borrowing request approved. Stock updated.', modal: '#confirmMarkDoneModal');
            $this->resetData();
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
