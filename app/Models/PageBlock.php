<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageBlock extends Model
{
    use HasUlids;

    public const TYPES = ['hero', 'rich_text', 'image', 'donation_form', 'cta_button', 'progress_bar', 'testimonial'];

    protected $fillable = [
        'landing_page_id',
        'type',
        'order',
        'content',
        'desktop_settings',
        'mobile_settings',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'desktop_settings' => 'array',
            'mobile_settings' => 'array',
        ];
    }

    public function landingPage(): BelongsTo
    {
        return $this->belongsTo(LandingPage::class);
    }
}
