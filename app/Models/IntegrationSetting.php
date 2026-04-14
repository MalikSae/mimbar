<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrationSetting extends Model
{
    protected $fillable = [
        'key',
        'group',
        'label',
        'value',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Group constants
    const GROUP_FONNTE    = 'wa_fonnte';
    const GROUP_META_PIXEL = 'meta_pixel';
    const GROUP_META_CAPI  = 'meta_capi';

    /**
     * Get a setting value by key, with optional default.
     */
    public static function getValue(string $key, $default = null): ?string
    {
        $record = static::where('key', $key)->first();
        return $record ? $record->value : $default;
    }

    /**
     * Upsert a value by key.
     */
    public static function setValue(string $key, string $group, string $label, ?string $value, bool $isActive = true): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'group'     => $group,
                'label'     => $label,
                'value'     => $value,
                'is_active' => $isActive,
            ]
        );
    }

    /**
     * Get all settings as key => value map.
     */
    public static function getGroupMap(string $group): array
    {
        return static::where('group', $group)
            ->get()
            ->mapWithKeys(fn($item) => [$item->key => $item->value])
            ->toArray();
    }
}
