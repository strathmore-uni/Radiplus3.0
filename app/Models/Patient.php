<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone_number',
        'date_of_birth',
        'address',
        'medical_history',
        'gender',
        'profile_picture',
    ];

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class);
    }
}
