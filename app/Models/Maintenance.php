<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Maintenance extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'car_id',
        'date',
        'end_date',
        'description',
        'cost',
        'status',
        'proof_file_path',
    ];

    protected $casts = [
        'date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
