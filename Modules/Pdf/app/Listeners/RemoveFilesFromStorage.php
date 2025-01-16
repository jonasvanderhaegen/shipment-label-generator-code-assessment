<?php

namespace Modules\Pdf\Listeners;

use Modules\Shipments\Events\ShipmentDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RemoveFilesFromStorage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ShipmentDeleted $event): void
    {
        $name = Str::replace('#', '', $event->shipment->order_number);
        Storage::disk('public')->delete("pdfs/${name}.pdf");
    }
}
