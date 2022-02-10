<?php

namespace Kanexy\LedgerFoundation\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kanexy\LedgerFoundation\Enums\WalletStatus;
use Kanexy\LedgerFoundation\Model\Wallet;

class RegisterWalletsForLedger implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ledger;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ledger)
    {
        $this->ledger = $ledger;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::isSubscribers()->get();

        if ($this->ledger->status == \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE && $this->ledger->ledger_type == \Kanexy\LedgerFoundation\Enums\LedgerType::WALLET) {

            foreach ($users as $user) {
                $data = [
                    "name" => $user->getFullName(),
                    "urn" => Wallet::generateUrn(),
                    "ledger_id" => $this->ledger->getKey(),
                    "holder_type" => $user->getMorphClass(),
                    "holder_id" => $user->getKey(),
                    "balance" => 0,
                    "status" => WalletStatus::ACTIVE,
                ];

                Wallet::updateOrCreate(
                    [
                        'ledger_id' => $this->ledger->getKey(),
                        "holder_type" => $user->getMorphClass(),
                        "holder_id" => $user->getKey()
                    ],
                    $data
                );
            }
        }
    }
}
