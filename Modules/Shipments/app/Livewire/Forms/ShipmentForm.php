<?php

namespace Modules\Shipments\Livewire\Forms;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Form;
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
    public function isOrderInfoValid(): bool
    {
        return $this->brand_id !== '' && $this->brand_id !== '0'
        && ($this->company_id !== '' && $this->company_id !== '0')
        && ($this->order_number !== '' && $this->order_number !== '0')
        && ! $this->getErrorBag()->any();
    }

    #[Computed]
    public function isBillingValid(): bool
    {
        return $this->billing_name !== '' && $this->billing_name !== '0'
        && ($this->billing_street !== '' && $this->billing_street !== '0')
        && ($this->billing_housenumber !== '' && $this->billing_housenumber !== '0')
        && ($this->billing_zipcode !== '' && $this->billing_zipcode !== '0')
        && ($this->billing_city !== '' && $this->billing_city !== '0')
        && ($this->billing_country !== '' && $this->billing_country !== '0')
        && ! $this->getErrorBag()->any();
    }

    #[Computed]
    public function isDeliveryValid(): bool
    {
        return $this->delivery_name !== '' && $this->delivery_name !== '0'
        && ($this->delivery_street !== '' && $this->delivery_street !== '0')
        && ($this->delivery_housenumber !== '' && $this->delivery_housenumber !== '0')
        && ($this->delivery_zipcode !== '' && $this->delivery_zipcode !== '0')
        && ($this->delivery_city !== '' && $this->delivery_city !== '0')
        && ($this->delivery_country !== '' && $this->delivery_country !== '0')
        && ! $this->getErrorBag()->any();
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
