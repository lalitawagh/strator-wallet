<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Enums\RegistrationStep;
use Kanexy\LedgerFoundation\Enums\WalletStatus;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Membership\Enums\MembershipStatus;

class WalletController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $ledgers = Ledger::get();
        $workspace = $user->workspaces()->first();
        $membership = $workspace->memberships()->first();

        collect($ledgers)->map(function ($ledger) use($user) {

            if($ledger->status == \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE && $ledger->ledger_type == \Kanexy\LedgerFoundation\Enums\LedgerType::WALLET)
            {
                $data = [
                    "name" => $user->getFullName(),
                    "urn" => Wallet::generateUrn(),
                    "ledger_id" => $ledger->getKey(),
                    "holder_type" => $user->getMorphClass(),
                    "holder_id" => $user->getKey(),
                    "balance" => 0,
                    "status" => WalletStatus::ACTIVE,
                ];

                Wallet::create($data);
            }
        });

        if($user->is_banking_user == 1)
        {
            $user->registrationStep(RegistrationStep::BANKING_SELECTED);

            return redirect()->route("customer.signup.address.index");
        }

        $membership->status = MembershipStatus::ACTIVE;
        $membership->update();

        $user->registrationStep(RegistrationStep::DASHBOARD);

        return redirect()->route("dashboard.index");
    }
}
