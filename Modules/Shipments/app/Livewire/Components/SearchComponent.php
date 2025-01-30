<?php

namespace Modules\Shipments\Livewire\Components;

use Illuminate\View\View;
use Livewire\Attributes\Isolate;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Isolate]
class SearchComponent extends Component
{
    #[Url(as: 'q', except: '', history: true)]
    public string $searchText = '';

    public ?string $placeholder;

    #[On('search:clear-results')]
    public function clear(): void
    {
        $this->reset('searchText');
    }

    public function render(): View
    {
        return view('shipments::livewire.components.search-component');
    }
}
