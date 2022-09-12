<?php

namespace Kanexy\LedgerFoundation\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kanexy\LedgerFoundation\Enums\WalletStatus;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\Cms\Models\User;
use Kanexy\LedgerFoundation\Model\Ledger;

class RegisterWalletsForLedger implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ledger;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Ledger $ledger)
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
        $users = User::where('id','!=',1)->get();

        if ($this->ledger->status == \Kanexy\LedgerFoundation\Enums\LedgerStatus::ACTIVE && $this->ledger->ledger_type == \Kanexy\LedgerFoundation\Enums\LedgerType::WALLET) {

            foreach ($users as $user) {
               
                $wallet = Wallet::where(['ledger_id' => $this->ledger->getKey(), "holder_type" => $user->getMorphClass(), "holder_id" => $user->getKey()])->first();

                if (!is_null($wallet)) {
                    $urn = $wallet->urn;
                } else {
                    $urn = Wallet::generateUrn();
                }

                $data = [
                    "name" => $user->getFullName(),
                    "urn" => $urn,
                    "ledger_id" => $this->ledger->getKey(),
                    "holder_type" => $user->getMorphClass(),
                    "holder_id" => $user->getKey(),
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
