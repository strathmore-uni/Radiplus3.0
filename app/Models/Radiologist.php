<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Radiologist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
	    'speciality',        
	    'phone_number',
        'address',
        'about',
        'profile_picture',
    ];
    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class);
    }
}
