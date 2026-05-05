<?php

namespace App\Services;

use App\Models\IntegrationSetting;
use App\Models\QurbanOrder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaCapiService
{
    /**
     * Send an event to Meta Conversions API
     *
     * @param string $eventName (e.g., 'InitiateCheckout', 'Purchase')
     * @param QurbanOrder $order
     * @param string $clientIp
     * @param string $userAgent
     * @param string|null $fbp
     * @param string|null $fbc
     * @param string|null $eventSourceUrl
     * @return bool
     */
    public function sendEvent(
        string $eventName,
        QurbanOrder $order,
        string $clientIp,
        string $userAgent,
        ?string $fbp = null,
        ?string $fbc = null,
        ?string $eventSourceUrl = null
    ): bool {
        // Check if CAPI is active
        $capiActive = IntegrationSetting::getValue('capi_active') === '1';
        if (!$capiActive) {
            return false;
        }

        $pixelId = IntegrationSetting::getValue('pixel_id');
        $accessToken = IntegrationSetting::getValue('capi_access_token');
        $testCode = IntegrationSetting::getValue('capi_test_code');

        if (!$pixelId || !$accessToken) {
            Log::warning("Meta CAPI is active but missing Pixel ID or Access Token.");
            return false;
        }

        // Hash user data
        $hashedEmail = $order->email ? hash('sha256', strtolower(trim($order->email))) : null;
        // Clean phone number: remove + and leading 0, assume ID country code 62
        $phone = preg_replace('/[^0-9]/', '', $order->whatsapp);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        $hashedPhone = $phone ? hash('sha256', $phone) : null;

        $userData = [
            'client_ip_address' => $clientIp,
            'client_user_agent' => $userAgent,
        ];

        if ($hashedEmail) $userData['em'] = [$hashedEmail];
        if ($hashedPhone) $userData['ph'] = [$hashedPhone];
        if ($fbp) $userData['fbp'] = $fbp;
        if ($fbc) $userData['fbc'] = $fbc;

        // Optional parameters
        $userData['country'] = [hash('sha256', 'id')]; // Default to Indonesia for Qurban

        $customData = [
            'value' => (float) $order->total_amount,
            'currency' => 'IDR',
            'content_ids' => [$order->qurban_item_id],
            'content_type' => 'product',
        ];

        $event = [
            'event_name' => $eventName,
            'event_time' => time(),
            'action_source' => 'website',
            'user_data' => $userData,
            'custom_data' => $customData,
            'event_id' => 'order_' . $order->id . '_' . $eventName, // Deduplication
        ];

        if ($eventSourceUrl) {
            $event['event_source_url'] = $eventSourceUrl;
        }

        $payload = [
            'data' => [$event],
        ];

        if ($testCode) {
            $payload['test_event_code'] = $testCode;
        }

        $url = "https://graph.facebook.com/v19.0/{$pixelId}/events";

        try {
            $response = Http::withToken($accessToken)->post($url, $payload);

            if ($response->successful()) {
                Log::info("Meta CAPI Event {$eventName} sent successfully for Order {$order->id}");
                return true;
            } else {
                Log::error("Meta CAPI Error for Order {$order->id}: " . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error("Meta CAPI Exception for Order {$order->id}: " . $e->getMessage());
            return false;
        }
    }
}
