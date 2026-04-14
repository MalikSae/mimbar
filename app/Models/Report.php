<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title', 'type', 'period', 'year',
        'file_path', 'is_visible', 'published_at',
    ];

    protected $casts = [
        'is_visible'   => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true)
                     ->orderByDesc('year')
                     ->orderByDesc('published_at');
    }
}
