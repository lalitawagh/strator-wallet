<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Kanexy\Cms\Controllers\Controller;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PayoutController extends Controller
{
    public function index()
    {
        $transactions = QueryBuilder::for(Transaction::class)
            ->allowedFilters([
                AllowedFilter::exact('workspace_id'),
            ]);

        $transactions = Transaction::where("meta->transaction_type", 'payout')->latest()->paginate();

        return view("ledger-foundation::wallet.payout.index", compact('transactions'));
    }

    public function create()
    {
        return view("ledger-foundation::wallet.payout.payouts");
    }
}
