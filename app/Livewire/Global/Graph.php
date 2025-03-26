<?php

namespace App\Livewire\Global;

use Livewire\Component;
use App\Models\Borrowing;
use App\Models\Item;

class Graph extends Component
{
    public function render()
    {

        $borrow_completed = Borrowing::where('status', 3)->count(); // Completed Borrowings

        $items = Item::count();

        $monthlyData = Borrowing::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, status, COUNT(*) as count')
            ->groupBy('month', 'year', 'status')
            ->get();

        $months = [];
        $completed = [];
        $cancelled = [];
        $total = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 1));
            $completed[] = $monthlyData->where('month', $i)->where('status', 3)->sum('count'); // Completed
            $cancelled[] = $monthlyData->where('month', $i)->where('status', 2)->sum('count'); // Cancelled
        }



        return view('livewire.global.graph', ['months' => $months, 'completed' => $completed, 'cancelled' => $cancelled]);
    }
}
