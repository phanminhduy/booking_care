<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Time_doctor extends Model
{
    use HasFactory;

    protected $fillable =[
        'doctor_id',
        'time_id',
    ];

    public $timestamps = false;

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
    public function time(): BelongsTo
    {
        return $this->belongsTo(Time::class);
    }
    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class);
    }


}
