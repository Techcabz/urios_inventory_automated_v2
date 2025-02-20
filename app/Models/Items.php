<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'reference',
        'name',
        'status',
        'quantity',
        'category_id',
        'purchase_date',
        'purchase_price',
        'warranty_expiry',
        'description',
        'assigned_to',
        'image_path',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->reference = IdGenerator::generate([
                'table' => 'items',
                'field' => 'reference',
                'length' => 10,
                'prefix' => 'ITEM-',
            ]);
        });
    }
}
