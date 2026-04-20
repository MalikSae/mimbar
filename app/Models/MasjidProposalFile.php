<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasjidProposalFile extends Model
{
    protected $fillable = [
        'proposal_id',
        'file_type',
        'file_path',
    ];

    public function proposal()
    {
        return $this->belongsTo(MasjidProposal::class, 'proposal_id');
    }
}
