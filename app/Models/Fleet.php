<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'description',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}