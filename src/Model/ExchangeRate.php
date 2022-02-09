<?php

namespace Kanexy\LedgerFoundation\Model;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kanexy\Cms\Setting\Models\Setting;

class ExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'base_currency',
        'exchange_currency',
        'frequency',
        'valid_date',
        'is_hard_stop',
        'exchange_fee',
        'exchange_rate',
        'note',
    ];

    public function ledger()
    {
        return $this->hasOne(Ledger::class,'id','base_currency');
    }

    public static function getExchangeRateDetails($sender_wallet,$receiver_wallet)
    {
        dd($receiver_wallet);
        $sender_asset_category = $sender_wallet?->ledger->asset_category;
        $receiver_asset_category = $receiver_wallet->asset_category;

        if (@$sender_asset_category != \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL &&  @$receiver_asset_category != \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL)
        {
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id',$sender_wallet?->ledger->asset_type);
            $exchange_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $receiver_wallet->asset_type);

            $base_currency_name = $base_currency['name'];
            $exchange_currency_name = $exchange_currency['name'];
            $exchange_rate = Currency::convert()->from($base_currency_name)->to($exchange_currency_name)->get();
            $fee = $sender_wallet?->ledger->payout_fee;
        } else {
            $exchange_rate_details = ExchangeRate::where(['base_currency' => $sender_wallet->ledger_id,'exchange_currency' => $receiver_wallet->ledger_id])->first();
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $sender_wallet?->ledger->asset_type);
            $exchange_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $receiver_wallet->asset_type);

            $base_currency_name = ($sender_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL) ? 'Coin' : $base_currency['name'];
            $exchange_currency_name = ($exchange_currency['asset_category'] == \Kanexy\LedgerFoundation\Enums\AssetCategory::VIRTUAL) ? 'Coin' : $exchange_currency['name'];
            $exchange_rate =  $exchange_rate_details?->exchange_rate;
            $fee = $exchange_rate_details?->exchange_fee;
        }

        $exchange_rate_details = [
            'exchange_rate' => $exchange_rate,
            'fee' => $fee,
            'base_currency_name' => $base_currency_name,
            'exchange_currency_name' => $exchange_currency_name,
        ];

        return $exchange_rate_details;
    }
}
