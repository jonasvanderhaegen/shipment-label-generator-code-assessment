<?php

namespace Modules\Shipments\Livewire\Components;

use Livewire\Component;

use Modules\Shipments\Livewire\Forms\ShipmentForm;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Isolate;
use Illuminate\Support\Facades\Storage;
use Modules\Shipments\Models\Combination;

use Modules\Shipments\Models\Shipment;

#[Isolate]
class ShipmentModalComponent extends Component
{
    public ShipmentForm $form;

    public $openSection;

    public array $countries;

    public bool $progression = false;

    public array $deliveryOptions = [];

    protected $listeners = [
        'toggleProgressionFromChild' => 'toggleProgressionOnParent',
        'downloadFromChild' => 'downloadOnParent'
    ];


    public function downloadOnParent()
    {
        $shipment = Shipment::latest()->first();

        return response()->download(
            Storage::disk('public')->path($shipment->pdf_path),
            $shipment->pdf_filename
        );
    }


    public function toggleSection($section)
    {
        $this->openSection = $this->openSection === $section ? null : $section;
    }

    public function fillFieldsWithFakeData()
    {
        $this->form->order_number =  '#' . fake()->bothify('#######');
        $this->form->billing_company_name = $this->form->delivery_company_name = fake('nl_NL')->company();
        $this->form->billing_name = $this->form->delivery_name = fake('nl_NL')->name();
        $this->form->billing_street = fake()->streetName('nl_NL');
        $this->form->billing_housenumber = (string) fake('nl_NL')->buildingNumber();
        $this->form->billing_zipcode = fake('nl_NL')->postcode();
        $this->form->billing_city = fake('nl_NL')->city();
        $this->form->billing_country = $this->form->delivery_country = 'NL';
        $this->form->delivery_street = 'Daltonstraat';
        $this->form->delivery_housenumber = '65';
        $this->form->delivery_zipcode = '3316GD';
        $this->form->delivery_city = 'Dordrecht';
    }

    public function toggleProgressionOnParent()
    {
        $this->progression = !$this->progression;
    }

    public function close()
    {
        $this->dispatch('closeModal');
        $this->toggleProgressionOnParent();
    }

    public function mount()
    {
        $this->countries = [
            'Netherlands' => 'NL',
        ];

        $this->openSection = 1;

        $this->form->brand_id = config('shipments.id.brand');

        $this->form->company_id = config('shipments.id.company');

    }

    #[Computed(persist: true, seconds: 3600)]
    public function deliveryOptions()
    {
        return Combination::all();
    }

    public function save()
    {
        $this->form->store();
    }

    public function render()
    {
        return view('shipments::livewire.components.shipment-modal-component'
        );
    }
}
