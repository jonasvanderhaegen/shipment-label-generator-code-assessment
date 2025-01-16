<?php

namespace Modules\Pdf\Pipelines;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Modules\Shipments\Models\Shipment;
use Illuminate\Support\Facades\Storage;

class CleanUpTemporaryFiles
{
    public function __construct()
    {
    }

    public function handle(Shipment $shipment, Closure $next)
    {
        $name = Str::replace('#', '', $shipment->order_number);

        $files = [
            "pdfs/temporary/{$name}-left.pdf",
            "pdfs/temporary/{$name}-right.pdf",
            "temp-{$name}.pdf",
        ];

        foreach ($files as $file) {
            if (Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
        }

        return $next($shipment);
    }
}
