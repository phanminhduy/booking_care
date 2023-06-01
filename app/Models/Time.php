<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Time extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =[
        'date',
        'time_start',
        'time_end',
    ];

    public function getTimeAttribute()
    {
        return Carbon::parse($this->time_end)->diffinMinutes(Carbon::parse($this->time_start));
    }
    function getDateFormatAttribute()
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }
    public function time_doctor(): HasMany
    {
        return $this->hasMany(Time_doctor::class);
    }

}
