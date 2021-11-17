<?php

namespace Riteserve\LedgerFoundation\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'status',
    ];
}
