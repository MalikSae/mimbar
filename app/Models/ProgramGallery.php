<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_type',
        'file_path',
        'caption',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}
