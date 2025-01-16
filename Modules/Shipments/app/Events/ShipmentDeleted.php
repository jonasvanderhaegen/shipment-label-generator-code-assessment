<?php

namespace Modules\Shipments\Events;


use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Modules\Shipments\Models\Shipment;

class ShipmentDeleted implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Shipment $shipment
    )
    {
        //
    }
}
