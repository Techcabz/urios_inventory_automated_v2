<?php

namespace App\Livewire\Admin\Borrowing\Report;

use App\Models\Borrowing;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $borrowings = Borrowing::orderByDesc('created_at')->get();

        return view('livewire.admin.borrowing.report.index', [
            'borrowings' => $borrowings
        ]);
    }
}
