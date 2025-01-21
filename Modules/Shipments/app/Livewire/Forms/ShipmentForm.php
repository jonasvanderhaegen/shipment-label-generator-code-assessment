<?php

namespace Modules\Shipments\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use Modules\Shipments\Models\Shipment;

class ShipmentForm extends Form
{
    // Velden voor ordergegevens
    #[Validate('required|string')]
    public string $brand_id = '';

    // Velden voor ordergegevens
    #[Validate('required|string')]
    public string $company_id = '';

    // Velden voor ordergegevens
    #[Validate('required|string')]
    public string $order_number = '';

    // Velden voor factuuradres
    #[Validate('string')]
    public string $billing_company_name = '';

    // Velden voor factuuradres
    #[Validate('required|string')]
    public string $billing_name = '';

    #[Validate('required|string')]
    public string $billing_street = '';

    #[Validate('required|string')]
    public string $billing_housenumber = '';

    #[Validate('required')]
    public string $billing_zipcode = '';

    #[Validate('required|string')]
    public string $billing_city = '';

    #[Validate('required|string')]
    public string $billing_country = '';

    // Velden voor bezorgadres
    #[Validate('required|string')]
    public string $delivery_company_name = '';

    #[Validate('required|string')]
    public string $delivery_name = '';

    #[Validate('required|string')]
    public string $delivery_street = '';

    #[Validate('required|string')]
    public string $delivery_housenumber = '';

    #[Validate('required')]
    public string $delivery_zipcode = '';

    #[Validate('required|string')]
    public string $delivery_city = '';

    #[Validate('required|string')]
    public string $delivery_country = '';

    #[Validate('required|integer')]
    public int $combination_id = 1;

    #[Computed]
    public function isOrderInfoValid()
    {
        return !empty($this->brand_id)
        && !empty($this->company_id)
        && !empty($this->order_number)
        && !$this->getErrorBag()->any();
    }

    #[Computed]
    public function isBillingValid()
    {
        return !empty($this->billing_name)
        && !empty($this->billing_street)
        && !empty($this->billing_housenumber)
        && !empty($this->billing_zipcode)
        && !empty($this->billing_city)
        && !empty($this->billing_country)
        && !$this->getErrorBag()->any();
    }

    #[Computed]
    public function isDeliveryValid()
    {
        return !empty($this->delivery_name)
        && !empty($this->delivery_street)
        && !empty($this->delivery_housenumber)
        && !empty($this->delivery_zipcode)
        && !empty($this->delivery_city)
        && !empty($this->delivery_country)
        && !$this->getErrorBag()->any();
    }


    // Methode om de verzending op te slaan
    public function store(): void
    {
        $this->validate();
        $this->component->dispatch('toggleProgressionFromChild');
        $shipment = Shipment::create($this->all());
        $this->reset(['except' => 'combination_id']);
        $this->component->dispatch('downloadFromChild');
    }
}
