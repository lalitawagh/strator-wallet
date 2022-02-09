<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Kanexy\Cms\Models\OneTimePassword;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Livewire\Component;

class DepositOtpVerificationComponent extends Component
{
    public $countryWithFlags;

    public $defaultCountry;

    public $user;

    public $code;

    public $sent_resend_otp;

    public $oneTimePassword;

    public function mount($countryWithFlags,$defaultCountry,$user)
    {
        $this->countryWithFlags = $countryWithFlags;
        $this->defaultCountry = $defaultCountry;
        $this->user = $user;
    }

    public function verifyOtp()
    {
        $data = $this->validate([
            'code' => 'required',
        ]);

        $oneTimePassword = $this->user->oneTimePasswords()->first();

        if ($oneTimePassword->code !== $data['code']) {
            $this->addError('code', 'The otp you entered did not match.');
        } else if (now()->greaterThan($oneTimePassword->expires_at)) {
            $this->addError('code', 'The otp you entered has expired.');
        }else{
            $oneTimePassword->update(['verified_at' => now()]);

            if(!is_null(session()->get('deposit_request.payment_method')))
            {
                return redirect()->route("dashboard.wallet.deposit-payment",['workspace_id' => session()->get('deposit_request.workspace_id')]);
            }else{

                return redirect()->route("dashboard.wallet.store-payment-details",['workspace_id' => session()->get('deposit_request.workspace_id')]);
            }
        }
    }

    public function resendOtp(OneTimePassword $oneTimePassword)
    {
        if ($this->user->hasActiveOneTimePassword("sms")) {
            $oneTimePassword = $this->user->oneTimePasswords()->whereType("sms")->first();
        }
        $this->user->notify(new SmsOneTimePasswordNotification($oneTimePassword));
        // $this->user->generateOtp("sms");
        $this->sent_resend_otp = true;
    }

    public function render()
    {
       return view('ledger-foundation::Livewire.deposit-otp-verification-component');
    }
}
