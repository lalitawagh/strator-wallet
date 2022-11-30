<?php

namespace Kanexy\LedgerFoundation\Model;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kanexy\Cms\Setting\Models\Setting;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ExchangeRate extends Model
{
    use HasFactory, LogsActivity;

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
        return $this->hasOne(Ledger::class, 'id', 'base_currency');
    }

    public static function getExchangeRateDetailsForPayout($sender_wallet, $receiver_wallet, $walletDefaultCountry, $amount)
    {
        $exchange_rate_details = ExchangeRate::where(['base_currency' => $receiver_wallet?->ledger_id, 'exchange_currency' => $sender_wallet?->ledger_id])->first();
        $base_currency = collect(Setting::getValue('asset_types', []))->firstWhere('id', Ledger::find($receiver_wallet?->ledger_id)?->asset_type);
        $exchange_currency = collect(Setting::getValue('asset_types', []))->firstWhere('id', Ledger::find($sender_wallet?->ledger_id)?->asset_type);

        $exchangeFee = collect(Setting::getValue('wallet_fees', []))->where('base_currency', $sender_wallet?->ledger_id)->where('exchange_currency', $receiver_wallet?->ledger_id)->where('payment_type', 'payout')->first();
        $fee = 0;
        if (isset($exchangeFee) && !is_null($amount) && is_numeric($amount)) {
            $fee = ($exchangeFee['fee_type'] == 'percentage') ? $amount * ($exchangeFee['percentage'] / 100) : $exchangeFee['amount'];
        }

        $base_currency = @$base_currency['name'];
        $exchange_currency = @$exchange_currency['name'];
        $exchange_rate =  $exchange_rate_details?->exchange_rate;

        $exchange_rate_details = [
            'exchange_rate' => $exchange_rate,
            'fee' => $fee,
            'base_currency_name' => $base_currency,
            'exchange_currency_name' => $exchange_currency,
        ];

        return $exchange_rate_details;
    }

    public static function getExchangeRateDetailsForDeposit($sender_wallet, $receiver_wallet, $value, $amount)
    {
        $sender_asset_category = $sender_wallet?->ledger->asset_category;
        $receiver_asset_category = $receiver_wallet?->asset_category;

        $exchangeFee = collect(Setting::getValue('wallet_fees', []))->where('base_currency', $sender_wallet?->ledger_id)->where('exchange_currency', $receiver_wallet?->id)->where('payment_type', 'deposit')->first();

        $fee = 0;
        if (isset($exchangeFee) && !is_null($amount)) {
            $fee = ($exchangeFee['fee_type'] == 'percentage') ? $amount * ($exchangeFee['percentage'] / 100) : $exchangeFee['amount'];
        }

        if (@$sender_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY &&  @$receiver_asset_category == \Kanexy\LedgerFoundation\Enums\AssetCategory::FIAT_CURRENCY) {

            $base_currency = collect(Setting::getValue('asset_types', []))->firstWhere('id', $sender_wallet?->ledger->asset_type);
            $exchange_currency =  collect(Setting::getValue('asset_types', []))->firstWhere('id', $receiver_wallet?->asset_type);

            $base_currency = @$base_currency['name'];
            $exchange_currency = @$exchange_currency['name'];
            if (!is_null($base_currency) && !is_null($exchange_currency)) {
                $exchange_rate = Currency::convert()->from($exchange_currency)->to($base_currency)->get();
            }
        } else {

            $exchange_rate_details = ExchangeRate::where(['base_currency' => $sender_wallet?->ledger_id, 'exchange_currency' => @$value])->first();
            $base_currency = collect(Setting::getValue('asset_types', []))->firstWhere('id', $sender_wallet?->ledger->asset_type);
            $exchange_currency = collect(Setting::getValue('asset_types', []))->firstWhere('id',  $receiver_wallet?->asset_type);

            $base_currency = @$base_currency['name'];
            $exchange_currency = @$exchange_currency['name'];
            $exchange_rate =  $exchange_rate_details?->exchange_rate;
        }

        $exchange_rate_details = [
            'exchange_rate' => @$exchange_rate,
            'fee' => $fee,
            'base_currency_name' => $base_currency,
            'exchange_currency_name' => $exchange_currency,
        ];

        return $exchange_rate_details;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('Wallet Exchange Rate')->logOnly(['*'])->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
