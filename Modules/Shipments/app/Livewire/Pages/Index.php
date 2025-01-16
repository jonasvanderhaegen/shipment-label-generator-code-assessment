<?php

namespace Modules\Shipments\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

use Modules\Shipments\Models\Shipment;

#[Layout('shipments::layouts.master')]
#[Title('Web interface')]
class Index extends Component
{
    use withPagination;

    public bool $isModalOpen = false;

    protected $listeners = ['closeModal' => 'closeModal'];

    public function download(Shipment $shipment)
    {
        return response()->download(
            Storage::disk('public')->path($shipment->pdf_path),
            $shipment->pdf_filename
        );
    }

    public function delete(Shipment $shipment)
    {
        $shipment->delete();
        $this->resetPage(pageName: 'shipments-page');
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    // TODO: low prio: Filter shipments based on q searchquery string.

    public function render()
    {
        return view('shipments::livewire.pages.index', [
            'shipments' => Shipment::paginate(7, pageName: 'shipments-page'),
        ]);
    }
}
