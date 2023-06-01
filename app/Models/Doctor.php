<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Doctor extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    public $timestamps = false;

    protected $fillable =[
        'name',
        'birth_date',
        'specialist_id',
        'avatar',
        'email',
        'password',
        'phone',
        'gender',
        'nationality',
        'address',
        'degree',
        'experience',
        'price',
    ];

    public function getGenderNameAttribute(): string
    {
        return ($this->gender === 0) ? 'Nữ' : 'Nam';
    }

    public function getAgeAttribute(): int
    {
        return date_diff(date_create($this->birth_date), date_create())->y;
    }

    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class);
    }
    public function time_doctor(): HasMany
    {
        return $this->hasMany(Time_doctor::class);
    }
    public function appointment(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
