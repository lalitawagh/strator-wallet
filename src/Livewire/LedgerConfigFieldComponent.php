<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\LedgerFoundation\Entities\AssetType;
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
        $this->asset_types = AssetType::whereAssetCategory($value)->get();
    }

    public function render()
    {
       return view('ledger-foundation::Livewire.ledger-config-field-component');
    }
}
