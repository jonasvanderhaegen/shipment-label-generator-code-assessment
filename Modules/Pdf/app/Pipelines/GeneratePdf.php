<?php

namespace Modules\Pdf\Pipelines;

use Closure;

use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;
use Modules\Shipments\Models\Shipment;
use Spatie\Browsershot\Browsershot;

use Illuminate\Support\Str;

class GeneratePdf
{
    public function handle(Shipment $shipment, Closure $next)
    {
        ray($shipment->combination);

        $name = Str::replace('#', '', $shipment->order_number); // Desired file name without extension

        $order_lines = [
            [
                'amount_ordered' => 2,
                'name' => 'Jeans - Black - 36',
                'sku' => 69205,
                'ean' =>  '8710552295268',
            ],
            [
                'amount_ordered' => 1,
                'name' => 'Sjaal - Rood Oranje',
                'sku' => 25920,
                'ean' =>  '3059943009097',
            ]
        ];

        Pdf::view('pdf::pdfs.shipment', compact('shipment', 'order_lines'))
        ->withBrowsershot(function (Browsershot $browsershot) {
            $browsershot
            ->setNodeBinary(config('pdf.binaries.node_path'))
            ->setNpmBinary('pdf.binaries.npm_path');
        })
        ->portrait()
        ->format(Format::A5)
        ->disk('public')
        ->save("pdfs/temporary/{$name}-left.pdf");

        $next($shipment);
    }
}
