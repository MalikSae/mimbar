<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\TranslationService;

class TranslationController extends Controller
{
    /**
     * Translate fields via AJAX
     */
    public function translate(Request $request): JsonResponse
    {
        $request->validate([
            'fields' => 'required|array',
            'fields.*.text' => 'nullable|string',
            'fields.*.type' => 'nullable|string|in:text,html',
        ]);

        $service = app(TranslationService::class);
        $results = [];

        foreach ($request->fields ?? [] as $key => $field) {
            $text = $field['text'] ?? '';
            $type = $field['type'] ?? 'text';
            
            if (empty(trim($text))) {
                $results[$key] = $text;
                continue;
            }

            if ($type === 'html') {
                $results[$key] = $service->translateHtml($text);
            } else {
                $results[$key] = $service->translateText($text);
            }
        }

        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }
}
