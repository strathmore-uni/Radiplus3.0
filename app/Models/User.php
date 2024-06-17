<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class User extends Model 
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'password', 'role', 'activation_token','profile_picture',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
};
