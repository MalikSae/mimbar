<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author',
        'description',
        'synopsis',
        'quote',
        'table_of_contents',
        'category',
        'cover_image',
        'file_path',
        'file_url',
        'preview_url',
        'page_count',
        'year',
        'file_size',
        'download_count',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function downloads()
    {
        return $this->hasMany(EbookDownload::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function incrementDownload()
    {
        $this->increment('download_count');
    }
}
