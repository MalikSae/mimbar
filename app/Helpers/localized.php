<?php

if (!function_exists('localized')) {
    /**
     * Ambil field dalam bahasa aktif.
     * Jika locale = 'ar' dan field_ar tersedia → return field_ar
     * Selain itu → return field asli (Indonesia)
     *
     * Contoh penggunaan di Blade:
     *   {{ localized($article, 'title') }}
     *   {{ localized($program, 'name') }}
     */
    function localized(mixed $model, string $field): mixed
    {
        $arField = $field . '_ar';
        $locale  = app()->getLocale();

        if ($locale === 'ar' && isset($model->$arField) && filled($model->$arField)) {
            return $model->$arField;
        }

        return $model->$field;
    }
}
