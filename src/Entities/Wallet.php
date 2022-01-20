<?php

namespace Kanexy\LedgerFoundation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'urn',
        'name',
        'holder_id',
        'holder_type',
        'ledger_id',
        'balance',
        'status',
    ];

    public function scopeForHolder($query, Model $model)
    {
        return $query->where(['holder_id' => $model->getKey(), 'holder_type' => $model->getMorphClass()]);
    }

    public function ledger()
    {
        return $this->hasOne(Ledger::class,'id','ledger_id');
    }
}
