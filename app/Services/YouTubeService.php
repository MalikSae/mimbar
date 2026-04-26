<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class YouTubeService
{
    /**
     * Ambil video terbaru dari channel YouTube menggunakan YouTube Data API v3.
     * Hasil di-cache selama 6 jam untuk mengurangi kuota API.
     *
     * @param int $maxResults Jumlah video yang diambil (default: 12)
     * @return array
     */
    public function getLatestVideos(int $maxResults = 12): array
    {
        $apiKey    = config('services.youtube.api_key');
        $channelId = config('services.youtube.channel_id');

        // Jika API key belum dikonfigurasi, kembalikan array kosong
        if (empty($apiKey) || $apiKey === 'isi_dengan_api_key') {
            return [];
        }

        return Cache::remember('youtube_videos_' . $channelId . '_' . $maxResults, 60 * 360, function () use ($apiKey, $channelId, $maxResults) {

            // Step 1: Ambil uploads playlist ID dari channel
            $channelUrl = "https://www.googleapis.com/youtube/v3/channels"
                . "?part=contentDetails"
                . "&id={$channelId}"
                . "&key={$apiKey}";

            $channelResponse = Http::timeout(10)->get($channelUrl);

            if (!$channelResponse->successful()) {
                return [];
            }

            $channelData = $channelResponse->json();
            $uploadsPlaylistId = $channelData['items'][0]['contentDetails']['relatedPlaylists']['uploads'] ?? null;

            if (!$uploadsPlaylistId) {
                return [];
            }

            // Step 2: Ambil video dari playlist uploads
            $playlistUrl = "https://www.googleapis.com/youtube/v3/playlistItems"
                . "?part=snippet"
                . "&playlistId={$uploadsPlaylistId}"
                . "&maxResults={$maxResults}"
                . "&key={$apiKey}";

            $playlistResponse = Http::timeout(10)->get($playlistUrl);

            if (!$playlistResponse->successful()) {
                return [];
            }

            $playlistData = $playlistResponse->json();
            $items = $playlistData['items'] ?? [];

            // Step 3: Format data video
            return array_map(function ($item) {
                $snippet = $item['snippet'];
                $videoId = $snippet['resourceId']['videoId'] ?? '';

                // Pilih thumbnail resolusi terbaik yang tersedia
                $thumbnail = $snippet['thumbnails']['maxres']['url']
                    ?? $snippet['thumbnails']['high']['url']
                    ?? $snippet['thumbnails']['medium']['url']
                    ?? $snippet['thumbnails']['default']['url']
                    ?? '';

                return [
                    'video_id'     => $videoId,
                    'title'        => $snippet['title'] ?? 'Tanpa Judul',
                    'description'  => $snippet['description'] ?? '',
                    'thumbnail'    => $thumbnail,
                    'published_at' => $snippet['publishedAt'] ?? null,
                    'url'          => "https://www.youtube.com/watch?v={$videoId}",
                    'embed_url'    => "https://www.youtube.com/embed/{$videoId}",
                ];
            }, $items);
        });
    }
}
