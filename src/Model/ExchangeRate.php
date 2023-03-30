<?php

namespace Kanexy\LedgerFoundation\Model;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Enums\Permission;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
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

    public static function setPagination()
    {
        return true;
    }

    public static function setBulkActions()
    {
        return false;
    }

    public static function setBuilder($type): Builder
    {
        return ExchangeRate::query()->with('ledger')->latest();
    }

    public static function columns()
    {
        return [
            Column::make("Id", "id")->hideIf(true),
            Column::make("Created At", "created_at")->hideIf(true),

            Column::make("Exchange From", "ledger.name")
                ->sortable()
                ->searchable(),

            Column::make("Exchange To", "exchange_currency")->format(function ($value, $model) {
                $exchangeCurrency = \Kanexy\LedgerFoundation\Model\Ledger::whereId($model->exchange_currency)->first();
                return @$exchangeCurrency->name;
            })
                ->sortable()
                ->searchable(),

            Column::make("Frequency", "frequency")->format(function ($value){
                return trans('ledger-foundation::configuration.' . $value);
            })
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('frequency'),

            Column::make("Valid Date", "valid_date")
                ->sortable()
                ->secondaryHeaderFilter('valid_date'),

            Column::make("Exchange Rate", "exchange_rate")
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('exchange_rate'),

            Column::make('Actions','id')->format(function($value, $model, $row) {
                $actions = [];
                if (\Illuminate\Support\Facades\Auth::user()->hasPermissionTo(Permission::EXCHANGE_RATE_EDIT) || \Illuminate\Support\Facades\Auth::user()->hasPermissionTo(Permission::EXCHANGE_RATE_DELETE)){
                    if (\Illuminate\Support\Facades\Auth::user()->hasPermissionTo(Permission::EXCHANGE_RATE_EDIT)){
                        $actions[] = ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit-2" data-lucide="edit-2" class="lucide lucide-edit-2 w-4 h-4 mr-2"><path d="M17 3a2.828 2.828 0 114 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>','isOverlay' => '0','route' => route('dashboard.wallet.exchange-rate.edit', $value),'method' => 'GET','action' => 'Edit'];
                    }
                    if (\Illuminate\Support\Facades\Auth::user()->hasPermissionTo(Permission::EXCHANGE_RATE_DELETE)){
                        $actions[] = ['icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash" data-lucide="trash" class="lucide lucide-trash w-4 h-4 mr-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg>','isOverlay' => 'true','method' => 'GET','action' => "Delete",'route' => "Livewire.emit('showModal','".route('dashboard.wallet.exchange-rate.destroy',$model->id)."','DELETE','x-circle','Delete')"];
                    }
                }

                return view('cms::livewire.datatable-actions', ['actions' => $actions])->withUser($row);
            })

        ];
    }

    public static function setFilters()
    {
        return [
            SelectFilter::make('Frequency')
                ->options([
                    '' => 'All',
                    'daily' => 'Daily',
                    'weekly' => 'Weekly',
                    'monthly' => 'Monthly',
                    'quarterly' => 'Quarterly',
                    'yearly' => 'Yearly',
                ])
                ->filter(function (Builder $builder, string $value) {

                    $builder->where('frequency', $value);
                }),


            DateFilter::make('Valid Date')->filter(function (Builder $builder, string $value) {
                $builder->whereDate('valid_date', date('Y-m-d', strtotime($value)));
            }),

        ];

    }
}
