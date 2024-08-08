<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'phone',
    'work',

    'nationality',
    'current_location',
    'gender',
    'birthday',
    'driving_license_number',
];
protected $dates = ['birthday'];

public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

}
