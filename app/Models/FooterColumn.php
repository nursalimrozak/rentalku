<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterColumn extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['title', 'order'];

    public function links()
    {
        return $this->hasMany(FooterLink::class)->orderBy('order');
    }
}
