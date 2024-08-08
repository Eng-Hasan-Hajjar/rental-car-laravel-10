<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarReservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'status',
        'pickup_garage_id',
        'dropoff_garage_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function pickupGarage()
    {
        return $this->belongsTo(Garage::class, 'pickup_garage_id');
    }

    public function dropoffGarage()
    {
        return $this->belongsTo(Garage::class, 'dropoff_garage_id');
    }

}
