<?php

namespace Kanexy\LedgerFoundation\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Ledger extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'code',
        'ledger_type',
        'symbol',
        'exchange_type',
        'exchange_rate',
        'exchange_from',
        'asset_category',
        'asset_class',
        'asset_type',
        'commodity_category',
        'image',
        'payout_fee',
        'deposit_fee',
        'withdraw_fee',
        'status',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('Wallet-Ledger')->logOnly(['*'])->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
