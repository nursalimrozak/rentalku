<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['footer_column_id', 'label', 'url', 'order'];

    public function column()
    {
        return $this->belongsTo(FooterColumn::class, 'footer_column_id');
    }
}
