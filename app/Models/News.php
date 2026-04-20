<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'category_id', 'title', 'slug', 'excerpt',
        'content', 'featured_image', 'status', 'published_at',
        'location', 'hijri_date', 'tags',
        // Terjemahan Arab
        'title_ar', 'excerpt_ar', 'content_ar',
    ];

    protected $casts = ['published_at' => 'datetime'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->orderByDesc('published_at');
    }
}
