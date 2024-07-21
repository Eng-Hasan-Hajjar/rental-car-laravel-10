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

    // إضافة دالة لحساب السعر بناءً على مدة تسجيل دخول المستخدم
    public function getDiscountedRate(User $user)
    {
        $createdDaysAgo = $user->created_at->diffInDays(now());

        // إذا كان المستخدم قد سجل الدخول منذ أكثر من يومين، احسب الخصم
        if ($createdDaysAgo > 2) {
            return $this->daily_rate * 0.9; // خصم 10%
        }

        return $this->daily_rate;
    }



}
