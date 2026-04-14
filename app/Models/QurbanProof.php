<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QurbanProof extends Model
{
    protected $fillable = [
        'order_id', 'file_path', 'sender_name',
        'sender_bank', 'transfer_date',
    ];

    protected $casts = ['transfer_date' => 'date'];

    public function order()
    {
        return $this->belongsTo(QurbanOrder::class, 'order_id');
    }
}
