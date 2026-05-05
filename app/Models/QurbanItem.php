<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QurbanItem extends Model
{
    protected $fillable = [
        'type', 'name', 'price', 'description',
        'is_available', 'is_campaign', 'sort_order', 'weight_info', 'image'
    ];

    protected $casts = [
        'price'        => 'decimal:2',
        'is_available' => 'boolean',
        'is_campaign'  => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(QurbanOrder::class, 'item_id');
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->orderBy('sort_order');
    }
}
