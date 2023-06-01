<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use Notifiable;
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name_booking',
        'phone_booking',
        'name_patient',
        'phone_patient',
        'email',
        'gender',
        'birth_date',
    ];

    public function getGenderNameAttribute(): string
    {
        return ($this->gender === 0) ? 'Nữ' : 'Nam';
    }

    public function getAgeAttribute(): int
    {
        return date_diff(date_create($this->birth_date), date_create())->y;
    }
}
