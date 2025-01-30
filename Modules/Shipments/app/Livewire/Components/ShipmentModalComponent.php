<?php

namespace Modules\Shipments\Livewire\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Isolate;
use Livewire\Component;
use Modules\Shipments\Livewire\Forms\ShipmentForm;
use Modules\Shipments\Models\Combination;
use Modules\Shipments\Models\Shipment;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

#[Isolate]
class ShipmentModalComponent extends Component
{
    public ShipmentForm $form;

    public ?int $openSection = null;

    /** @var array<string, string> */
    public array $countries = [];

    public bool $progression = false;

    /** @var array<int, Combination> */
    public array $deliveryOptions = [];

    /** @var array<string, string> */
    protected $listeners = [
        'toggleProgressionFromChild' => 'toggleProgressionOnParent',
        'downloadFromChild' => 'downloadOnParent',
    ];

    public function downloadOnParent(): BinaryFileResponse
    {
        $shipment = Shipment::latest()->first();

        return response()->download(
            Storage::disk('public')->path($shipment->pdf_path),
            $shipment->pdf_filename
        );
    }

    public function toggleSection(int $section): void
    {
        $this->openSection = $this->openSection === $section ? null : $section;
    }

    public function fillFieldsWithFakeData(): void
    {
        $this->form->order_number = '#'.fake()->bothify('#######');
        $this->form->billing_company_name = $this->form->delivery_company_name = fake('nl_NL')->company();
        $this->form->billing_name = $this->form->delivery_name = fake('nl_NL')->name();
        $this->form->billing_street = fake('nl_NL')->streetName();
        $this->form->billing_housenumber = (string) fake('nl_NL')->buildingNumber();
        $this->form->billing_zipcode = fake('nl_NL')->postcode();
        $this->form->billing_city = fake('nl_NL')->city();
        $this->form->billing_country = $this->form->delivery_country = 'NL';
        $this->form->delivery_street = 'Daltonstraat';
        $this->form->delivery_housenumber = '65';
        $this->form->delivery_zipcode = '3316GD';
        $this->form->delivery_city = 'Dordrecht';
    }

    public function toggleProgressionOnParent(): void
    {
        $this->progression = ! $this->progression;
    }

    public function close(): void
    {
        $this->dispatch('closeModal');
        $this->toggleProgressionOnParent();
    }

    public function mount(): void
    {
        $this->countries = [
            'Netherlands' => 'NL',
        ];

        $this->openSection = 1;

        $this->form->brand_id = config('shipments.id.brand');

        $this->form->company_id = config('shipments.id.company');
    }

    /**
     * @return Collection<int, Combination>
     */
    #[Computed(persist: true, seconds: 3600)]
    public function deliveryOptions(): Collection
    {
        return Combination::all();
    }

    public function save(): void
    {
        $this->form->store();
    }

    public function render(): View
    {
        return view('shipments::livewire.components.shipment-modal-component');
    }
}
