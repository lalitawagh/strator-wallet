<?php

namespace Kanexy\LedgerFoundation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'status',
    ];
}
