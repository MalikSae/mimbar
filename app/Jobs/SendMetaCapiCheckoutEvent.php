<?php

namespace App\Jobs;

use App\Models\QurbanOrder;
use App\Services\MetaCapiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMetaCapiCheckoutEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $clientIp;
    public $userAgent;
    public $fbp;
    public $fbc;
    public $eventSourceUrl;

    /**
     * Create a new job instance.
     */
    public function __construct(
        QurbanOrder $order,
        string $clientIp,
        string $userAgent,
        ?string $fbp = null,
        ?string $fbc = null,
        ?string $eventSourceUrl = null
    ) {
        $this->order = $order;
        $this->clientIp = $clientIp;
        $this->userAgent = $userAgent;
        $this->fbp = $fbp;
        $this->fbc = $fbc;
        $this->eventSourceUrl = $eventSourceUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(MetaCapiService $capiService): void
    {
        $capiService->sendEvent(
            'InitiateCheckout',
            $this->order,
            $this->clientIp,
            $this->userAgent,
            $this->fbp,
            $this->fbc,
            $this->eventSourceUrl
        );
    }
}
