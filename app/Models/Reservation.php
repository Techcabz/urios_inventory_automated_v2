<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';


    protected $fillable = [
        'reference_num',
        'users_id',
        'date_filled',
        'school_premises',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'date_return',
        'time_return',
        'purpose',
        'remarks',
        'signature',
        'status',
        'department_id'
    ];

    public function userDetails()
    {
        return $this->belongsTo(UserDetails::class, 'users_id', 'id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function item()
    {
        return $this->hasMany(ReservationItem::class, 'reservation_id', 'id');
    }

    public function venue()
    {
        return $this->hasMany(ReservationVenue::class, 'reservation_id', 'id');
    }
}
