<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'icon',
        'link_text',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($policy) {
            if (empty($policy->slug)) {
                $policy->slug = \Illuminate\Support\Str::slug($policy->title);
            }
        });

        static::updating(function ($policy) {
            if (empty($policy->slug) || $policy->isDirty('title')) {
                $policy->slug = \Illuminate\Support\Str::slug($policy->title);
            }
        });
    }
}
