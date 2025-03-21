<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Str; 

class BorrowingReturn extends Model
{
    use HasFactory;
    protected $table = 'borrowing_return';

    protected $fillable = [
        'barcode_return',
        'borrowing_id'
    ];

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($item) {
            
            $item->barcode_return = IdGenerator::generate([
                'table' => 'borrowing_return',
                'field' => 'barcode_return',
                'length' => 6,
                'prefix' => 'C',
            ]);
        });
    }
}
