<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Enums\RegistrationStep;
use Kanexy\LedgerFoundation\Enums\WalletStatus;
use Kanexy\LedgerFoundation\Model\Ledger;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Core\Enums\WorkspaceStatus;
use Kanexy\PartnerFoundation\Membership\Enums\MembershipStatus;

class WalletController extends Controller
{
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $ledgers = Ledger::get();
        $workspace = $user->workspaces()->first();
        $membership = $workspace->memberships()->first();

        collect($ledgers)->each(function ($item) use ($user,$workspace) {

            if ($item->status == \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE && $item->ledger_type == \Kanexy\LedgerFoundation\Enums\LedgerType::WALLET) {
                $data = [
                    "name" => $user->getFullName(),
                    "urn" => Wallet::generateUrn(),
                    "ledger_id" => $item->getKey(),
                    "holder_type" => $workspace->getMorphClass(),
                    "holder_id" => $workspace->getKey(),
                    "balance" => 0,
                    "status" => WalletStatus::ACTIVE,
                ];

                Wallet::create($data);
            }
        });

        if (!$user->is_banking_user) {
            $workspace->status = WorkspaceStatus::ACTIVE;
            $workspace->update();
        }

        if ($user->is_banking_user == 1) {
            $user->logRegistrationStep(RegistrationStep::BANKING);

            $nextRoute = $user->getNextRegistrationRoute();

            return redirect($nextRoute->getUrl());
        }

        $membership->status = MembershipStatus::ACTIVE;
        $membership->update();

        return redirect()->route("dashboard.index");
    }
}
