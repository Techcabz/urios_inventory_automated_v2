<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Str; 

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'reference',
        'user_id',
        'status',
        'quantity',
        'item_id'
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            // Generate a UUID before creating the item
            $item->uuid = Str::uuid();
    
            // Generate a unique reference number
            $item->reference = IdGenerator::generate([
                'table' => 'items',
                'field' => 'reference',
                'length' => 10,
                'prefix' => 'BOR-',
            ]);
        });
    }
}
