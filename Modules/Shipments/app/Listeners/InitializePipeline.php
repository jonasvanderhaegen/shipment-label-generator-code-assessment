<?php

namespace Modules\Shipments\Listeners;

use Modules\Shipments\Events\ShipmentCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Pipeline\Pipeline;

use Modules\Shipments\Pipelines\FetchShipmentData;
use Modules\Pdf\Pipelines\FetchShippingLabel;
use Modules\Pdf\Pipelines\StoreTemporaryPdf;
use Modules\Pdf\Pipelines\GeneratePdf;
use Modules\Pdf\Pipelines\ConcatenatePdfs;
use Modules\Pdf\Pipelines\CleanUpTemporaryFiles;

class InitializePipeline
{
    public function __construct(
        private Pipeline $pipeline
    )
    {}

    public function handle(ShipmentCreated $event): void
    {
        $this->pipeline->send($event->shipment)
        ->through([
            FetchShipmentData::class,
            FetchShippingLabel::class,
            StoreTemporaryPdf::class,
            GeneratePdf::class,
            ConcatenatePdfs::class,
            CleanUpTemporaryFiles::class,
        ])
        ->thenReturn();
    }
}
