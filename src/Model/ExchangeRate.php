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

    public static function getExchangeRateDetailsForPayout($sender_wallet,$receiver_wallet,$value)
    {
        $sender_asset_category = $sender_wallet?->ledger->asset_category;
        $receiver_asset_category = $receiver_wallet->asset_category;

        if(@$sender_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY &&  @$receiver_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY)
        {
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id',$receiver_wallet?->asset_type);
            $exchange_currency =  collect(Setting::getValue('asset_types',[]))->firstWhere('id',  @$value);

            $base_currency = @$base_currency['name'];
            $exchange_currency = @$exchange_currency['name'];
            if(!is_null($base_currency) && !is_null($exchange_currency))
            {
                $exchange_rate = Currency::convert()->from($base_currency)->to($exchange_currency)->get();
            }
            $fee = $receiver_wallet?->payout_fee;
        }else{

            $exchange_rate_details = ExchangeRate::where(['base_currency' => $sender_wallet?->ledger_id,'exchange_currency' => @$value])->first();
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', $receiver_wallet?->asset_type);
            $exchange_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', @$value);

            $base_currency = @$base_currency['name'];
            $exchange_currency = @$exchange_currency['name'];
            $exchange_rate =  $exchange_rate_details?->exchange_rate;
            $fee = $exchange_rate_details?->exchange_fee;
        }

        $exchange_rate_details = [
            'exchange_rate' => $exchange_rate,
            'fee' => $fee,
            'base_currency_name' => $base_currency,
            'exchange_currency_name' => $exchange_currency,
        ];

        return $exchange_rate_details;
    }

    public static function getExchangeRateDetailsForDeposit($sender_wallet,$receiver_wallet,$value)
    {
        $sender_asset_category = $sender_wallet?->ledger->asset_category;
        $receiver_asset_category = $receiver_wallet?->asset_category;

        if(@$sender_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY &&  @$receiver_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY)
        {
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id',@$value);
            $exchange_currency =  collect(Setting::getValue('asset_types',[]))->firstWhere('id', $receiver_wallet?->asset_type);

            $base_currency = @$base_currency['name'];
            $exchange_currency = @$exchange_currency['name'];
            if(!is_null($base_currency) && !is_null($exchange_currency))
            {
                $exchange_rate = Currency::convert()->from($base_currency)->to($exchange_currency)->get();
            }
            $fee = $receiver_wallet?->deposit_fee;
        }else{

            $exchange_rate_details = ExchangeRate::where(['base_currency' => $sender_wallet?->ledger_id,'exchange_currency' => @$value])->first();
            $base_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id', @$value);
            $exchange_currency = collect(Setting::getValue('asset_types',[]))->firstWhere('id',  $receiver_wallet?->asset_type);

            $base_currency = @$base_currency['name'];
            $exchange_currency = @$exchange_currency['name'];
            $exchange_rate =  $exchange_rate_details?->exchange_rate;
            $fee = $exchange_rate_details?->exchange_fee;
        }

        $exchange_rate_details = [
            'exchange_rate' => $exchange_rate,
            'fee' => $fee,
            'base_currency_name' => $base_currency,
            'exchange_currency_name' => $exchange_currency,
        ];

        return $exchange_rate_details;
    }
}
