<?php

namespace Modules\Shipments\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Shipments\Events\ShipmentCreated;
use Modules\Shipments\Listeners\InitializePipeline;

use Modules\Shipments\Events\ShipmentDeleted;
use Modules\Pdf\Listeners\RemoveFilesFromStorage;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        ShipmentCreated::class => [
            InitializePipeline::class,
        ],
        ShipmentDeleted::class => [
            RemoveFilesFromStorage::class,
        ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void
    {
        //
    }
}
