<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Carbon\Carbon;

class Driver extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'phone_number',
        'status',
        'photo',
        'gender',
        'date_of_birth',
        'bio',
        'in_city_rate',
        'out_of_town_rate',
        'rating',
        'experience_years',
        'sim',
        'ktp',
        'kk'
    ];
    
    protected $casts = [
        'date_of_birth' => 'date',
        'in_city_rate' => 'decimal:2',
        'out_of_town_rate' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    public function getAgeAttribute()
    {
        return $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null;
    }
}
