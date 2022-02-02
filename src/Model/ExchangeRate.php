<?php

namespace Kanexy\LedgerFoundation\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
