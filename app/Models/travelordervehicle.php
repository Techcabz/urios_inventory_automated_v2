<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class travelordervehicle extends Model
{
    use HasFactory;

    protected $table = 'travelordervehicle';


    protected $fillable = [
        'travelordervehicle',
        'travel_id',
        'vehicle_id'
    ];

    public function travelorder()
    {
        return $this->belongsTo(TravelOrder::class, 'travel_id');
    }
}
