<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'program_id', 'reference_code', 'donor_name', 'donor_email',
        'donor_phone', 'amount', 'bank_destination', 'is_anonymous',
        'status', 'notes', 'verified_at', 'whatsapp', 'message',
        'unique_code', 'expired_at',
    ];

    protected $casts = [
        'amount'       => 'decimal:2',
        'is_anonymous' => 'boolean',
        'verified_at'  => 'datetime',
        'expired_at'   => 'datetime',
    ];

    public function program()
    {
        return $this->belongsTo(DonationProgram::class, 'program_id');
    }

    public function proof()
    {
        return $this->hasOne(DonationProof::class);
    }

    public static function generateReferenceCode()
    {
        return 'DNT-' . strtoupper(uniqid());
    }
}
