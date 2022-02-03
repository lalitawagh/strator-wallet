<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\Cms\Setting\Models\Setting;
use Livewire\Component;

class LedgerConfigFieldComponent extends Component
{
    public $asset_types;

    public string $asset_category;

    public function mount($asset_types)
    {

        $this->asset_types = $asset_types;
    }

    public function changeAssetCategory($value)
    {
        $this->asset_category = $value;
        $this->asset_types = collect(Setting::getValue('asset_types',[]))->where('asset_category', $value);

    }

    public function render()
    {
       return view('ledger-foundation::Livewire.ledger-config-field-component');
    }
}