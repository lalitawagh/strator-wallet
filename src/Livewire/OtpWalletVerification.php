<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Carbon\Carbon;
use Kanexy\Cms\Models\OneTimePassword;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\PartnerFoundation\Core\Helper;
use Livewire\Component;

class OtpWalletVerification extends Component
{
    public $countryWithFlags;

    public $defaultCountry;

    public $user;

    public $workspace;

    public $mobile;

    public $code;

    public $oneTimePassword;

    public $sent_resend_otp;

    public $type;

    public function mount($countryWithFlags, $defaultCountry, $user, $workspace, $type)
    {
        $this->countryWithFlags = $countryWithFlags;
        $this->defaultCountry = $defaultCountry;
        $this->user = $user;
        $this->workspace = $workspace;
        $this->mobile = $user->phone;
        $this->type = $type;
    }
    public function oneTimePassword($otp)
    {
        $this->oneTimePassword = $otp;
    }

    public function resendOtp()
    {
        $oneTimePassword = OneTimePassword::find(session('oneTimePassword'));
        if (Carbon::now()->gt($oneTimePassword->expires_at) && $oneTimePassword->verified_at == null) {

            $oneTimePassword->update(['code' => rand(100000, 999999), 'expires_at' => now()->addMinutes(OneTimePassword::getExpiringDuration())]);
        }
        
        if(config('services.disable_sms_service') == false){
            $oneTimePassword->holder->notify(new SmsOneTimePasswordNotification($oneTimePassword));
        }

        $this->sent_resend_otp = true;
    }

    public function verifyOtp()
    { 
        $data = $this->validate([
            'code' => 'required',
        ]);
       
        $this->contact = session('contact');

        $oneTimePassword = $this->contact->oneTimePasswords()->first();
        $manualOtp = Setting::getValue('otp');

        if (isset($manualOtp) && ($manualOtp == $data['code'])) {
            $oneTimePassword->update(['verified_at' => now()]);

            if ($this->type == 'withdraw') {
                return redirect()->route('dashboard.wallet.withdraw.create', ['workspace_id' => $this->workspace])->with([
                    'status' => 'success',
                    'message' => 'The beneficiary created successfully.',
                ]);
            } elseif ($this->type == 'transfer') {
                return redirect()->route('dashboard.wallet.payout.create', ['workspace_id' => $this->workspace, 'type' => $this->type])->with([
                    'status' => 'success',
                    'message' => 'The beneficiary created successfully.',
                ]);
            }elseif ($this->type == 'stellar') {
                return redirect()->route('dashboard.wallet.stellar-payouts.create', ['filter' => ['workspace_id' => Helper::activeWorkspaceId()]])->with([
                    'status' => 'success',
                    'message' => 'The beneficiary created successfully.',
                ]);
            } else {
                return redirect()->route('dashboard.wallet.payout.create', ['workspace_id' => $this->workspace])->with([
                    'status' => 'success',
                    'message' => 'The beneficiary created successfully.',
                ]);
            }
        }

        if ($oneTimePassword->code !== $data['code']) {
            $this->addError('code', 'The otp you entered did not match.');
        } else if (now()->greaterThan($oneTimePassword->expires_at)) {
            $this->addError('code', 'The otp you entered has expired.');
        } else {
            $oneTimePassword->update(['verified_at' => now()]);

            $requestTransfer = session('money_transfer_request');
            $requestTransfer['beneficiary_id'] = $this->contact->id;

            session(['money_transfer_request' => $requestTransfer]);

            if ($this->type == 'withdraw') {
                return redirect()->route('dashboard.wallet.withdraw.create', ['workspace_id' => $this->workspace])->with([
                    'status' => 'success',
                    'message' => 'The beneficiary created successfully.',
                ]);
            } elseif ($this->type == 'transfer') {
                return redirect()->route('dashboard.wallet.payout.create', ['workspace_id' => $this->workspace, 'type' => $this->type])->with([
                    'status' => 'success',
                    'message' => 'The beneficiary created successfully.',
                ]);
            }elseif ($this->type == 'stellar') {
                return redirect()->route('dashboard.wallet.stellar-payouts.create', ['filter' => ['workspace_id' => Helper::activeWorkspaceId()]])->with([
                    'status' => 'success',
                    'message' => 'The beneficiary created successfully.',
                ]);
            } else {
                return redirect()->route('dashboard.wallet.payout.create', ['workspace_id' => $this->workspace])->with([
                    'status' => 'success',
                    'message' => 'The beneficiary created successfully.',
                ]);
            }
        }
    }

    public function render()
    {
        return view('ledger-foundation::Livewire.otp-wallet-verification-component');
    }
}
