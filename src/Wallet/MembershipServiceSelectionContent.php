<?php

namespace Kanexy\LedgerFoundation\Wallet;

use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Components\Contracts\Component;

class MembershipServiceSelectionContent extends Component
{
    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view("ledger-foundation::widget.wallet-component", compact("user"));
    }
}
