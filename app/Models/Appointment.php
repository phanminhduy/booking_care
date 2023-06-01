<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'time_doctor_id',
        'admin_id',
        'comment',
        'description',
        'feedback',
        'price',
        'status',
    ];

    public function getDateCreatedAtAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function time_doctor(): BelongsTo
    {
        return $this->belongsTo(Time_doctor::class);
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
