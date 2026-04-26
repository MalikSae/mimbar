<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationCache extends Model
{
    protected $fillable = [
        'source_hash',
        'source_text',
        'translated_text',
        'source_lang',
        'target_lang',
    ];
}
