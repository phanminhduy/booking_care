<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    public $timestamps = false;
    protected $fillable =[
        'id',
        'name',
        'avatar',
        'birth_date',
        'email',
        'password',
        'phone',
        'gender',
        'address',
        'role',
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
