<?php

namespace Kanexy\LedgerFoundation\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kanexy\PartnerFoundation\Core\Traits\InteractsWithUrn;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Wallet extends Model
{
    use HasFactory, InteractsWithUrn, LogsActivity;

    protected $fillable = [
        'urn',
        'name',
        'holder_id',
        'holder_type',
        'ledger_id',
        'balance',
        'status',
    ];

    public function holder()
    {
        return $this->morphTo();
    }

    public function scopeForHolder($query, Model $model)
    {
        return $query->where(['holder_id' => $model->getKey(), 'holder_type' => $model->getMorphClass()]);
    }

    public function ledger()
    {
        return $this->hasOne(Ledger::class, 'id', 'ledger_id');
    }

    public function debit($amount)
    {
        $balance = $this->balance - $amount;
        $this->update(['balance' => $balance]);
    }

    public function credit($amount)
    {
        $balance = $this->balance + $amount;
        $this->update(['balance' => $balance]);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('Wallet')->logOnly(['*'])->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
