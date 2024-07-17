<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabOrder extends Model
{
    use HasFactory;

    // Adding fillables
    protected $fillable = [
        'test_name', 'price', 'name', 'email', 'phone', 'address', 'radiology_image', 'payment_status', 'delivery_status', 'user_id'
    ];
}
