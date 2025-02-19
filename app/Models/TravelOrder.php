<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelOrder extends Model
{
    use HasFactory;

    protected $table = 'travelers';

    protected $fillable = [
        'user_id',
        'date',
        'time',
        'returndate',
        'destanation',
        'purpose',
        'image',
        'status'
    ];

    public function vehicle()
    {
        return $this->hasMany(travelordervehicle::class, 'travel_id', 'id');
    }
}
