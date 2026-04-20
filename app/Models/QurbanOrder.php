<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QurbanOrder extends Model
{
    protected $fillable = [
        'item_id', 'order_number', 'reference_code', 'donor_name', 'whatsapp', 'phone',
        'email', 'is_anonymous', 'prayer', 'unique_code',
        'quantity', 'status', 'expired_at', 'shohibul_name', 'total_amount',
        'bank_destination', 'notes'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'expired_at'   => 'datetime',
        'is_anonymous' => 'boolean',
    ];

    public function item()
    {
        return $this->belongsTo(QurbanItem::class, 'item_id');
    }

    public function proof()
    {
        return $this->hasOne(QurbanProof::class, 'order_id');
    }

    public static function generateReferenceCode()
    {
        return 'QRB-' . strtoupper(uniqid());
    }
}
