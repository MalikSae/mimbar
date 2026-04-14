<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationProgram extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'image',
        'target_amount', 'collected_amount', 'status', 'sort_order',
        'category_id', 'featured_image', 'specs',
        'deadline_date', 'donor_count', 'department', 'gallery',
    ];

    protected $casts = [
        'target_amount'    => 'decimal:2',
        'collected_amount' => 'decimal:2',
        'specs'            => 'array',
        'gallery'          => 'array',
        'deadline_date'    => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'program_id');
    }

    public function getProgressPercentageAttribute(): int
    {
        if (!$this->target_amount || $this->target_amount <= 0) return 0;
        return min(100, (int) round(
            ($this->collected_amount / $this->target_amount) * 100
        ));
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')->orderBy('sort_order');
    }
}
