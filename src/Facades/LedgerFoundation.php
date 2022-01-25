<?php

namespace Kanexy\LedgerFoundation\Facades;

use Illuminate\Support\Facades\Facade;

class LedgerFoundation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Kanexy\LedgerFoundation\LedgerFoundation::class;
    }
}
