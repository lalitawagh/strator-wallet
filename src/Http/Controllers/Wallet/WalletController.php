<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Enums\RegistrationStep;
use Kanexy\Cms\Enums\Status;
use Kanexy\Cms\Helper;
use Kanexy\Cms\Models\UserLog;
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
            UserLog::registrationStep(RegistrationStep::BANKING);

            $nextRoute = (new Helper())->getNextRoute(RegistrationStep::BANKING);

            return redirect($nextRoute->getUrl());
        }

        $membership->status = MembershipStatus::ACTIVE;
        $membership->update();

        UserLog::registrationStep(RegistrationStep::DASHBOARD);

        if(empty($user->registration_step))
        {
            $user->registrationStep(Status::COMPLETED);
        }
        return redirect()->route("dashboard.index");
    }
}
