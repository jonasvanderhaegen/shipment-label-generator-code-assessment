<?php

namespace Modules\Shipments\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Url;
use Livewire\Attributes\Isolate;

#[Isolate]
class SearchComponent extends Component
{
    #[Url(as: 'q', except: '', history: true)]
    public $searchText = "";

    public $placeholder;

    #[On('search:clear-results')]
    public function clear()
    {
        $this->reset('searchText');
    }

    public function render()
    {
        return view('shipments::livewire.components.search-component');
    }
}
