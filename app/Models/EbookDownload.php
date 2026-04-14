<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EbookDownload extends Model
{
    protected $fillable = [
        'ebook_id',
        'name',
        'whatsapp',
        'want_donate',
        'donation_amount',
        'unique_code',
        'total_transfer',
        'payment_status',
        'downloaded_at',
    ];

    protected $casts = [
        'want_donate'   => 'boolean',
        'downloaded_at' => 'datetime',
    ];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }
}
