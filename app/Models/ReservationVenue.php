<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationVenue extends Model
{
    use HasFactory;

    protected $table = 'reservation_venue';


    protected $fillable = [
        'reservation_id',
        'venue_id',
        'quantity'
    ];
    public function Venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id', 'id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }
}
