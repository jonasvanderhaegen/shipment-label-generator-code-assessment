<?php

namespace Modules\Shipments\Livewire\Pages;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Shipments\Models\Shipment;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

#[Layout('shipments::layouts.master')]
#[Title('Web interface')]
class Index extends Component
{
    use withPagination;

    public bool $isModalOpen = false;

    /** @var array<string, string> */
    protected $listeners = ['closeModal' => 'closeModal'];

    public function download(Shipment $shipment): BinaryFileResponse
    {
        return response()->download(
            Storage::disk('public')->path($shipment->pdf_path),
            $shipment->pdf_filename
        );
    }

    public function delete(Shipment $shipment): void
    {
        $shipment->delete();
        $this->resetPage(pageName: 'shipments-page');
    }

    public function openModal(): void
    {
        $this->isModalOpen = true;
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
    }

    // TODO: low prio: Filter shipments based on q searchquery string.

    public function render(): View
    {
        return view('shipments::livewire.pages.index', [
            'shipments' => Shipment::paginate(7, pageName: 'shipments-page'),
        ]);
    }
}
