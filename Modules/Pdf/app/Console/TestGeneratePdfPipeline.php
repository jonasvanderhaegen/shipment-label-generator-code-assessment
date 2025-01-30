<?php

namespace Modules\Pdf\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Pipeline\Pipeline;
use Modules\Pdf\Pipelines\CleanUpTemporaryFiles;
use Modules\Pdf\Pipelines\ConcatenatePdfs;
use Modules\Pdf\Pipelines\FetchShippingLabel;
use Modules\Pdf\Pipelines\GeneratePdf;
use Modules\Pdf\Pipelines\StoreTemporaryPdf;
use Modules\Shipments\Models\Shipment;
use Modules\Shipments\Pipelines\FetchShipmentData;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class TestGeneratePdfPipeline extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'pdf:tgpp {shipment : The ID of the shipment}';

    /**
     * The console command description.
     */
    protected $description = 'Test the pipeline with specific model of Shipment';

    /**
     * Create a new command instance.
     */
    public function __construct(
        private Pipeline $pipeline,
        private Shipment $shipment
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $shipmentId = $this->argument('shipment');

        // Validate that the shipmentId is a number
        if (! is_numeric($shipmentId)) {
            $this->error('The shipmentId must be a valid number.');

            return; // Exit with error
        }

        $shipment = $this->shipment->find($shipmentId);

        if (! $shipment) {
            $this->error("Shipment with ID {$shipmentId} not found.");

            return; // Error exit code
        }

        $this->info("Processing shipment in pipeline: shipment with ID {$shipment->id}");

        $this->pipeline->send($shipment)
            ->through([
                // FetchShipmentData::class,
                FetchShippingLabel::class,
                StoreTemporaryPdf::class,
                GeneratePdf::class,
                ConcatenatePdfs::class,
                CleanUpTemporaryFiles::class,
            ])
            ->thenReturn();
    }

    /**
     * Get the console command arguments.
     *
     * @return array<int, array{string, int, string}>
     */
    protected function getArguments(): array
    {
        return [
            ['shipment', InputArgument::REQUIRED, 'Id of shipment is required'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array<int, array{string, string|null, int, string, mixed}>
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     *
     * @return array<string, string>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'shipment' => 'Which shipment ID should go in the pipeline?',
        ];
    }
}
