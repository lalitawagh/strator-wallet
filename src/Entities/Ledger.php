<?php

namespace Kanexy\LedgerFoundation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

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
        'status',
    ];

    public function assetClass()
    {
        return $this->hasOne(AssetClass::class,'id','asset_class');
    }

    public function assetType()
    {
        return $this->hasOne(AssetType::class,'id','asset_type');
    }
}
