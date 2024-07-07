<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'color',
        'seats',
        'daily_rate',
        'status',
        'description',
        'image',
        'fleet_id',
    ];
    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function ratings()
    {
        return $this->hasMany(RatingCar::class);
    }
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
