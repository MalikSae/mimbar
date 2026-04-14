<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    protected $fillable = ['caption', 'file_path', 'program_tag', 'taken_at'];

    protected $casts = ['taken_at' => 'date'];
}
