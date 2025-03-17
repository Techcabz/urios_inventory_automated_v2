<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing_cart extends Model
{
    use HasFactory;
    protected $table = 'borrowing_cart';

    protected $fillable = [
        'borrowing_id',
        'cart_id'
    ];
}
