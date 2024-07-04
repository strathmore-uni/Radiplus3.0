<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'radiologist_id',
        'referral_date',
        'status',
        'imaging_exam_status',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function radiologist(): BelongsTo
    {
        return $this->belongsTo(Radiologist::class);
    }
}