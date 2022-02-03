<?php

namespace Kanexy\LedgerFoundation\Services;

use Illuminate\Support\Facades\Http;

class WalletService
{
    public function stripeBalanceTransactionHistoryDetails($balance_transaction)
    {
        return Http::withToken(config('services.stripe.secret'))
            ->acceptJson()
            ->get('https://api.stripe.com/v1/balance/history/' . $balance_transaction)
            ->throw()
            ->json();
    }
}
