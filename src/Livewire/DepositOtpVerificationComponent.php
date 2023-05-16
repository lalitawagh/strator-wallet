<?php

namespace Kanexy\LedgerFoundation\Livewire;

use Kanexy\Cms\Models\OneTimePassword;
use Kanexy\Cms\Notifications\EmailOneTimePasswordNotification;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\Cms\Setting\Models\Setting;
use Livewire\Component;

class DepositOtpVerificationComponent extends Component
{
    public $countryWithFlags;

    public $defaultCountry;

    public $user;

    public $code;

    public $sent_resend_otp;

    public $oneTimePassword;

    public function mount($countryWithFlags, $defaultCountry, $user)
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
        $manualOtp = Setting::getValue('otp');

        if (isset($manualOtp) && ($manualOtp == $data['code'])) {
            $oneTimePassword->update(['verified_at' => now()]);

      
            if (!is_null(session()->get('deposit_request.payment_method'))) {
                return redirect()->route("dashboard.wallet.deposit-payment", ['workspace_id' => session()->get('deposit_request.workspace_id')]);
            }else if (!is_null(session()->get('stellar_request')) && session()->get('stellar_request.type') == 'stellar') { 
                return redirect()->route("dashboard.wallet.stellar-payment-method", ['workspace_id' => session()->get('stellar_request.workspace_id')]);
            }else {

                return redirect()->route("dashboard.wallet.store-payment-details", ['workspace_id' => session()->get('deposit_request.workspace_id')]);
            }
        }

        if ($oneTimePassword->code !== $data['code']) {
            $this->addError('code', 'The otp you entered did not match.');
        } else if (now()->greaterThan($oneTimePassword->expires_at)) {
            $this->addError('code', 'The otp you entered has expired.');
        } else {
            $oneTimePassword->update(['verified_at' => now()]);

            if (!is_null(session()->get('deposit_request.payment_method'))) {
                return redirect()->route("dashboard.wallet.deposit-payment", ['workspace_id' => session()->get('deposit_request.workspace_id')]);
            } else if (!is_null(session()->get('stellar_request')) && session()->get('stellar_request.type') == 'stellar') { 
                return redirect()->route("dashboard.wallet.stellar-payment-method", ['workspace_id' => session()->get('stellar_request.workspace_id')]);
            }else {

                return redirect()->route("dashboard.wallet.store-payment-details", ['workspace_id' => session()->get('deposit_request.workspace_id')]);
            }
        }
    }

    public function resendOtp(OneTimePassword $oneTimePassword)
    {
        $otpService = Setting::getValue('transaction_otp_service');
        if ($this->user->hasActiveOneTimePassword($otpService)) {
            $oneTimePassword = $this->user->oneTimePasswords()->whereType($otpService)->first();
        }

        if($otpService == 'email' && config('services.disable_email_service') == false)
        {
            $this->user->notify(new EmailOneTimePasswordNotification($oneTimePassword));
        }else if($otpService == 'sms' && config('services.disable_sms_service') == false)
        {
            $this->user->notify(new SmsOneTimePasswordNotification($oneTimePassword));
        }

        $this->sent_resend_otp = true;
    }

    public function render()
    {
        return view('ledger-foundation::Livewire.deposit-otp-verification-component');
    }
}
