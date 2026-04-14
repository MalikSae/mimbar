<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationProof extends Model
{
    protected $fillable = [
        'donation_id', 'file_path', 'sender_name',
        'sender_bank', 'transfer_date', 'transfer_amount',
    ];

    protected $casts = [
        'transfer_date'   => 'date',
        'transfer_amount' => 'decimal:2',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
