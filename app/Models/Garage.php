<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'phone_number',
        'working_hours',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
