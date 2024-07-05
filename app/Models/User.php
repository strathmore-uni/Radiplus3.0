<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class User extends Model 
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'password','activation_token','profile_picture',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
        // Accessor for full name (if you store first and last names separately)
        public function getFullNameAttribute() {
            return "{$this->name} ";
        }
    
};
