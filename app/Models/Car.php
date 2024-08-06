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
        'garage_id',
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
        return $this->hasMany(Rating::class);
    }
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
    public function reservations()
    {
        return $this->hasMany(CarReservation::class);
    }


    // إضافة دالة لحساب السعر بناءً على مدة تسجيل دخول المستخدم
    public function getDiscountedRate2(User $user)
    {
        $createdDaysAgo = $user->created_at->diffInDays(now());

        // إذا كان المستخدم قد سجل الدخول منذ أكثر من يومين، احسب الخصم
        if ($createdDaysAgo > 2 && $createdDaysAgo <= 4) {
            return $this->daily_rate * 0.01; // خصم 1%
        }
        if ($createdDaysAgo > 4 && $createdDaysAgo <= 8) {
            return $this->daily_rate * 0.02; // خصم 10%
        }
        if ($createdDaysAgo > 8 && $createdDaysAgo <= 16) {
            return $this->daily_rate * 0.03; // خصم 10%
        }
        if ($createdDaysAgo > 16 && $createdDaysAgo <= 30) {
            return $this->daily_rate * 0.05; // خصم 10%
        }
        if ($createdDaysAgo > 30 && $createdDaysAgo <= 90) {
            return $this->daily_rate * 0.1; // خصم 10%
        }
        if ($createdDaysAgo > 90 ) {
            return $this->daily_rate * 0.15; // خصم 10%
        }
        return $this->daily_rate;
    }
     // طريقة لحساب السعر المخفض بناءً على مدة تسجيل المستخدم
    public function getDiscountedRate(User $user)
    {
        $createdDaysAgo = $user->created_at->diffInDays(now());
        $discountPercentage = 0;

        if ($createdDaysAgo > 2 && $createdDaysAgo <= 4) {
            $discountPercentage = 1; // خصم 1%
        } elseif ($createdDaysAgo > 4 && $createdDaysAgo <= 8) {
            $discountPercentage = 2; // خصم 2%
        } elseif ($createdDaysAgo > 8 && $createdDaysAgo <= 16) {
            $discountPercentage = 3; // خصم 3%
        } elseif ($createdDaysAgo > 16 && $createdDaysAgo <= 30) {
            $discountPercentage = 5; // خصم 5%
        } elseif ($createdDaysAgo > 30 && $createdDaysAgo <= 90) {
            $discountPercentage = 10; // خصم 10%
        } elseif ($createdDaysAgo > 90) {
            $discountPercentage = 15; // خصم 15%
        }

        return $this->applyDiscount($this->daily_rate, $discountPercentage);
    }

    // طريقة لتطبيق الخصم على السعر
    private function applyDiscount($rate, $percentage)
    {
        return $rate - ($rate * ($percentage / 100));
    }

    // طريقة لحساب الخصومات الموسمية
    public function getSeasonalDiscountedRate()
    {
        $currentMonth = now()->month;
        $seasonalDiscount = 0;

        if ($currentMonth == 12) { // خصومات موسم العطلات في ديسمبر
            $seasonalDiscount = 20; // خصم 20%
        }

        return $this->applyDiscount($this->daily_rate, $seasonalDiscount);
    }

    // حساب السعر النهائي مع أخذ جميع الخصومات في الاعتبار
    public function getFinalRate(User $user)
    {
        $discountedRate = $this->getDiscountedRate($user);
        $finalRate = $this->getSeasonalDiscountedRate();

        // في حالة وجود خصم موسمي، يتم تطبيق الخصم الإضافي على السعر المخفض للمستخدم
        if ($finalRate < $this->daily_rate) {
            return $this->applyDiscount($discountedRate, 20); // افترض أن الخصم الموسمي هو 20%
        }

        return $discountedRate;
    }

    public function getDiscountDetails(User $user)
    {
        $createdDaysAgo = $user->created_at->diffInDays(now());
        $discountPercentage = 0;
        $seasonalDiscountPercentage = 0;

        if ($createdDaysAgo > 2 && $createdDaysAgo <= 4) {
            $discountPercentage = 1; // خصم 1%
        } elseif ($createdDaysAgo > 4 && $createdDaysAgo <= 8) {
            $discountPercentage = 2; // خصم 2%
        } elseif ($createdDaysAgo > 8 && $createdDaysAgo <= 16) {
            $discountPercentage = 3; // خصم 3%
        } elseif ($createdDaysAgo > 16 && $createdDaysAgo <= 30) {
            $discountPercentage = 5; // خصم 5%
        } elseif ($createdDaysAgo > 30 && $createdDaysAgo <= 90) {
            $discountPercentage = 10; // خصم 10%
        } elseif ($createdDaysAgo > 90) {
            $discountPercentage = 15; // خصم 15%
        }

        $currentMonth = now()->month;
        if ($currentMonth == 12) { // خصومات موسم العطلات في ديسمبر
            $seasonalDiscountPercentage = 20; // خصم 20%
        }

        return [
            'user_discount' => $discountPercentage,
            'seasonal_discount' => $seasonalDiscountPercentage
        ];
    }




}
