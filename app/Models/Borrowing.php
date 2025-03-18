<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Str; 

class Borrowing extends Model
{
    use HasFactory;
    protected $table = 'borrowing';

    protected $fillable = [
        'uuid',
        'barcode_reference',
        'due_date',
        'returned_at',
        'reason',
        'status',
        'approved_by',
        'user_id'
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function borrowingCarts()
    {
        return $this->hasMany(Borrowing_cart::class, 'borrowing_id', 'id');
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
            $item->uuid = Str::uuid();
    
            // This line is incorrect because the column name is `barcode_reference`, not `reference`
            $item->barcode_reference = IdGenerator::generate([
                'table' => 'borrowing',
                'field' => 'barcode_reference',
                'length' => 10,
                'prefix' => 'BOR-',
            ]);
        });
    }
    
}
