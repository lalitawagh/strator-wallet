<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Enums\AssetCategory;
use Kanexy\LedgerFoundation\Enums\ExchangeType;
use Livewire\Component;

class LedgerConfigFieldComponent extends Component
{
    public $asset_types;

    public $asset_categories;

    public $commodity_types;

    public $ledger;

    public $exchange_rate;

    public $asset_type;

    public string $selected_asset_category;

    public string $selected_exchange_type;

    public string $selected_asset_type;

    public function mount($asset_types, $asset_categories, $commodity_types, $ledger)
    {
        $this->asset_types = $asset_types;
        $this->asset_categories = $asset_categories;
        $this->commodity_types = $commodity_types;
        $this->ledger = $ledger;
        $this->selected_exchange_type =  $ledger ? $ledger?->exchange_type : '';
        $this->selected_asset_category =  $ledger ? $ledger?->asset_category : '';
        $this->selected_asset_type =  $ledger ? $ledger?->asset_type : '';
        $this->exchange_rate = $ledger ? $ledger?->exchange_rate : '';
    }

    public function changeExchangeType($value)
    {
        $this->selected_exchange_type = $value;
        $asset_categories = AssetCategory::toArray();
        $data = [];

        foreach ($asset_categories as $asset_category) {
            if ($value == ExchangeType::FIAT) {
                if ($asset_category == AssetCategory::FIAT_CURRENCY) {
                    $data[] = $asset_category;
                }
            } else {
                if ($asset_category != AssetCategory::FIAT_CURRENCY) {
                    $data[] = $asset_category;
                }
            }
        }
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
        $this->asset_categories = $data;
    }

    public function changeAssetCategory($value)
    {
        $this->selected_asset_category = $value;
        $this->asset_types = collect(Setting::getValue('asset_types', []))->where('asset_category', $value);
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }

    public function changeAssetType($value)
    {
        $this->selected_asset_type = $value;
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }

    public function render()
    {
        return view('ledger-foundation::Livewire.ledger-config-field-component');
    }
}
