<?php

namespace App\Services;

use Exception;
use DOMDocument;
use Illuminate\Support\Facades\Http;

class TranslationService
{
    private int $maxChars = 450;

    /**
     * Translate plain text from Indonesian to Arabic
     */
    public function translateText(string $text): string
    {
        if (trim($text) === '') return $text;

        // Jika teks pendek, langsung translate
        if (mb_strlen($text) <= $this->maxChars) {
            return $this->callApi($text);
        }

        // Teks panjang: pecah per kalimat, translate per chunk
        $sentences = preg_split('/(?<=[.!?؟])\s+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        $chunks = [];
        $current = '';

        foreach ($sentences as $sentence) {
            if (mb_strlen($current . ' ' . $sentence) > $this->maxChars) {
                if ($current !== '') $chunks[] = trim($current);
                $current = $sentence;
            } else {
                $current .= ($current ? ' ' : '') . $sentence;
            }
        }
        if ($current !== '') $chunks[] = trim($current);

        $results = [];
        foreach ($chunks as $chunk) {
            $results[] = $this->callApi($chunk);
            usleep(200000); // 0.2 detik jeda antar chunk
        }

        return implode(' ', $results);
    }

    private function callApi(string $text): string
    {
        try {
            $url = "https://api.mymemory.translated.net/get?q="
                 . urlencode($text)
                 . "&langpair=id|ar"
                 . "&de=admin@mimbar.com";

            $response = Http::timeout(10)->get($url);

            if ($response->successful()) {
                $data = $response->json();
                $responseStatus = $data['responseStatus'] ?? 200;

                // Jika API return error (mis. 400 query too long), return teks asli
                if ((int)$responseStatus !== 200) return $text;

                return $data['responseData']['translatedText'] ?? $text;
            }
            return $text;
        } catch (Exception $e) {
            return $text;
        }
    }

    /**
     * Translate HTML content while preserving tags
     */
    public function translateHtml(string $html): string
    {
        if (trim($html) === '') {
            return $html;
        }

        try {
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            
            // Wrap to retain UTF-8
            $wrappedHtml = '<?xml encoding="utf-8" ?>' . $html;
            $dom->loadHTML($wrappedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $xpath = new \DOMXPath($dom);
            $textNodes = $xpath->query('//text()');

            foreach ($textNodes as $node) {
                // Ignore script and style contents just in case
                if ($node->parentNode && in_array(strtolower($node->parentNode->nodeName), ['script', 'style'])) {
                    continue;
                }

                $text = $node->nodeValue;
                if (trim($text) !== '') {
                    $node->nodeValue = $this->translateText($text);
                }
            }

            // Save and clean
            $translatedHtml = $dom->saveHTML();
            $translatedHtml = str_replace('<?xml encoding="utf-8" ?>', '', $translatedHtml);
            $translatedHtml = trim($translatedHtml);
            
            // Decode numeric html entities caused by saveHTML
            $translatedHtml = html_entity_decode($translatedHtml, ENT_QUOTES | ENT_XML1, 'UTF-8');
            
            return $translatedHtml;
        } catch (Exception $e) {
            return $html;
        }
    }

    /**
     * Batch translation with delay to prevent rate limits
     */
    public function translateBatch(array $texts): array
    {
        $translated = [];
        foreach ($texts as $key => $text) {
            $translated[$key] = $this->translateText($text);
            usleep(300000); // 300ms pause
        }
        return $translated;
    }
}
