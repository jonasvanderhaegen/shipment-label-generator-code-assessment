<?php

namespace Modules\Pdf\Pipelines;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Modules\Shipments\Models\Shipment;

class FetchShippingLabel
{
    public function handle(Shipment $shipment, Closure $next)
    {
        try {

            $response = Http::withBasicAuth(config('shipments.api.username'), config('shipments.api.password'))
            ->get( $shipment->api_label_pdf_url );

            if ($response->failed()) {
                throw new \Exception('Failed to fetch shipment label: ' . $response->body());
            }

            $shipment->base64String = $response->json('data');

            return $next($shipment);

        } catch (\Exception $e) {
            Log::error('Error in FetchShipmentData pipeline', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e; // Optioneel: doorgeven aan hogere lagen voor verdere afhandeling
        }

    }
}
