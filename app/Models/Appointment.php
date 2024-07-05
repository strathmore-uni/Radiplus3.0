<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Specify which fields can be mass assigned
    protected $fillable = [
        'patient_name',
        'patient_email',
        'patient_phone',
        'appointment_date',
        'appointment_time',
        'referring_doctor',
        'radiologist',
        'appointment_type',
        'status',
    ];

    // Cast the date field to a date type
    protected $casts = [
        'appointment_date' => 'date',
    ];
}
