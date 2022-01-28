<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Enums\RegistrationStep;
use Kanexy\LedgerFoundation\Entities\Ledger;
use Kanexy\LedgerFoundation\Entities\Wallet;
use Kanexy\LedgerFoundation\Http\Enums\WalletStatus;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;

class WalletController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $ledgers = Ledger::get();

        collect($ledgers)->map(function ($ledger) use($user) {

            if($ledger->status == \Kanexy\LedgerFoundation\Http\Enums\LedgerStatusEnum::ACTIVE && $ledger->ledger_type == 'wallet')
            {
                $data = [
                    "name" => $user->getFullName(),
                    "urn" => Transaction::generateUrn(),
                    "ledger_id" => $ledger->getKey(),
                    "holder_type" => $user->getMorphClass(),
                    "holder_id" => $user->getKey(),
                    "balance" => 0,
                    "status" => WalletStatus::INACTIVE
                ];

                Wallet::create($data);
            }

        });

        if($user->is_banking_user == 1)
        {
            $user->registrationStep(RegistrationStep::BANKING_SELECTED);

            return redirect()->route("customer.signup.address.index");
        }

        $user->registrationStep(RegistrationStep::DASHBOARD);

        return redirect()->route("dashboard.index");
    }
}
