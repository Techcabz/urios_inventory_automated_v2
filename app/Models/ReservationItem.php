<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservationItem extends Model
{
    use HasFactory;

    protected $table = 'reservation_item';


    protected $fillable = [
        'reservation_id',
        'item_id',
        'quantity'
    ];

    public function Items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

}
