<?php

namespace Modules\Shipments\Observers;

use Modules\Shipments\Models\Shipment;
use Modules\Shipments\Events\ShipmentCreated;
use Modules\Shipments\Events\ShipmentDeleted;

class ShipmentObserver
{
    /**
     * Handle the ShipmentObserver "created" event.
     */
    public function created(Shipment $shipment): void
    {
        ShipmentCreated::dispatch($shipment);
    }

    /**
     * Handle the ShipmentObserver "deleted" event.
     */
    public function deleted(Shipment $shipment): void
    {
        ShipmentDeleted::dispatch($shipment);
    }

    /**
     * Handle the ShipmentObserver "force deleted" event.
     */
    public function forceDeleted(Shipment $shipment): void
    {
        ShipmentDeleted::dispatch($shipment);
    }
}
