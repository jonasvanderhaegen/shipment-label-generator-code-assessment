<?php

namespace Modules\Shipments\Pipelines;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Modules\Shipments\Models\Shipment;

class FetchShipmentData
{
    public function handle(Shipment $shipment, Closure $next)
    {
        try {
            // Log initial request for debugging
            Log::info('Fetching shipment data for order', ['order_number' => $shipment->order_number]);

            $data = [
                'zpl_direct' => false,
                'product_combination_id' => $shipment->combination->option_id,
                'brand_id' => $shipment->brand_id,
                'reference' => $shipment->order_number,
                'receiver_contact' => [
                    'companyname' => $shipment->delivery_company_name,
                    'name' => $shipment->delivery_name,
                    'street' => $shipment->delivery_street,
                    'housenumber' => $shipment->delivery_housenumber,
                    'postalcode' => $shipment->delivery_zipcode,
                    'locality' => $shipment->delivery_city,
                    'country' => $shipment->delivery_country,
                ],
                'shipment_products' => [
                    [
                        'amount' => "2",
                        'name' => 'Jeans - Black - 36',
                        'sku' => "69205",
                        'ean' =>  '8710552295268',
                    ],
                    [
                        'amount' => "1",
                        'name' => 'Sjaal - Rood Oranje',
                        'sku' => "25920",
                        'ean' =>  '3059943009097',
                    ]
                ]
            ];

            $response = Http::withBasicAuth(config('shipments.api.username'), config('shipments.api.password'))
            ->post(config('shipments.api.url') . "companies/{$shipment->company_id}/shipments", $data);

            if ($response->failed()) {
                throw new \Exception('Failed to create shipment: ' . $response->body());
            }

            $data = $response->json('data');

            $shipment->update([
                'api_shipment_id' => $data['id'],
                'api_tracking_id' => $data['tracking_id'],
                'api_tracking_url' => $data['tracking_url'],
                'api_label_pdf_url' => $data['label_pdf_url']
            ]);

            return $next($shipment);

        } catch (\Exception $e) {
            Log::error('Error in FetchShipmentData pipeline', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }
}
