<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'category_id', 'author_id', 'admin_id',
        'title', 'slug', 'excerpt',
        'content', 'featured_image', 'status', 'published_at',
        'author_name', 'author_photo', 'author_bio', 'reading_time', 'tags',
        // Terjemahan Arab
        'title_ar', 'slug_ar', 'excerpt_ar', 'content_ar',
    ];

    protected $casts = ['published_at' => 'datetime'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->orderByDesc('published_at');
    }

    /**
     * Nama penulis: dari relasi Author jika ada,
     * fallback ke kolom author_name lama, terakhir "Tim Mimbar".
     */
    public function getAuthorNameAttribute(): string
    {
        return $this->author?->name
            ?? $this->getRawOriginal('author_name')
            ?? 'Tim Mimbar';
    }

    /**
     * Bio penulis: dari relasi Author jika ada,
     * fallback ke kolom author_bio lama, terakhir teks default yayasan.
     */
    public function getAuthorBioAttribute(): string
    {
        return $this->author?->bio
            ?? $this->getRawOriginal('author_bio')
            ?? 'Yayasan Mimbar Al-Tauhid hadir dengan program dakwah yang menarik dan inovatif.';
    }
}
