<?php

namespace Kanexy\LedgerFoundation\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Helper;
use Kanexy\Cms\Models\OneTimePassword;
use Kanexy\Cms\Notifications\EmailOneTimePasswordNotification;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\Cms\Rules\AlphaSpaces;
use Kanexy\Cms\Rules\MobileNumber;
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\LedgerFoundation\Model\Wallet;
use Kanexy\PartnerFoundation\Cxrm\Events\ContactCreated;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Livewire\Component;

class StellarBeneficiary extends Component
{
    public $mobile;

    public $membership_urn;

    public $membership_name;

    public $workspace;

    public $first_name;

    public $middle_name;

    public $last_name;

    public $email;

    public $nick_name;

    public $public_key;

    public $notes;

    public $classification = ['beneficiary'];

    public $beneficiary_created;

    public $code;

    public $contact;

    public $countryWithFlags;

    public $defaultCountry;

    public $oneTimePassword;

    public $sent_resend_otp;

    public $country_code;

    public $user;

    public $type;

    public $stellarAccount;

    public function mount($workspace, $countryWithFlags, $defaultCountry, $type)
    {
      
        $this->workspace = $workspace;
        $this->countryWithFlags = $countryWithFlags;
        $this->defaultCountry = $defaultCountry;
        $this->type = $type;
        $this->user = Auth::user();
        $this->country_code = $this->user->country_id;
        $this->mobile = !is_null($this->mobile) ?? Helper::normalizePhone($this->mobile);
    }


    public function getCountry($value)
    {
        $this->country_code = $value;
        $this->dispatchBrowserEvent('UpdateLivewireSelect');
    }

    public function getMembershipDetails()
    {
        $this->mobile = Helper::normalizePhone($this->mobile);
        $user = User::wherePhone($this->mobile)->first();
        $workspace =  $user?->workspaces()->first();
        $this->stellarAccount = Wallet::whereHolderId($workspace?->id)->whereType('steller')->first();
        $this->membership_urn = NULL;
        $this->first_name = NULL;
        $this->middle_name = NULL;
        $this->last_name = NULL;
        $this->public_key = NULL;
        $this->membership_name = NULL;
        if(!is_null($this->stellarAccount))
        {
            $membership = $workspace?->memberships()->first();
            $this->public_key = $this->stellarAccount?->meta['publicKey'];
            $this->membership_urn = $membership?->urn;
            $this->membership_name = $membership?->name;
            $this->first_name = $user->first_name;
            $this->middle_name = $user->middle_name;
            $this->last_name = $user->last_name;
        }

    }

    public function changeCountryCode($value)
    {
        $this->country_code = $value;
    }

    public function createBeneficiary()
    {
        $data = $this->validate([
            'first_name' => ['required', new AlphaSpaces, 'string', 'max:40'],
            'middle_name' => ['nullable', new AlphaSpaces, 'string', 'max:40'],
            'last_name' => ['required', new AlphaSpaces, 'string', 'max:40'],
            'email' => 'nullable|email',
            'mobile' => ['required', new MobileNumber],
            'notes' => 'nullable',
            'nick_name' => 'nullable',
            'country_code' => 'nullable'
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $existContact = Contact::where(['workspace_id' => $this->workspace->id, 'mobile' => Helper::normalizePhone($data['mobile']), 'ref_type' => 'stellar'])->first();

        if (!is_null($existContact)) {
            $this->addError('mobile', 'Beneficiary already exist');
        } else {

            if (is_null($this->membership_urn)) {
                $this->addError('mobile', 'Membership not exists with this mobile number');
            } else {

                $data['mobile'] = Helper::normalizePhone($data['mobile']);
                $data['workspace_id'] = $this->workspace->id;
                $data['ref_type'] = 'stellar';
                $data['classification'] = $this->classification;
                $data['status'] = 'active';
                $data['meta'] = ['country_code' => $data['country_code'],'beneficiary_public_key' => $this->public_key];

                /** @var Contact $contact */
                $contact = Contact::create($data);

                event(new ContactCreated($contact));

                $this->contact = $contact;

                $otpService = Setting::getValue('transaction_otp_service');
                if($otpService == 'email')
                {
                    if(config('services.disable_email_service') == false){
                        $contact->notify(new EmailOneTimePasswordNotification($contact->generateOtp("email")));
                    }
                    else{
                        $contact->generateOtp("email");
                    }
                }else
                {
                    if(config('services.disable_sms_service') == false){
                        $contact->notify(new SmsOneTimePasswordNotification($contact->generateOtp("sms")));
                    }
                    else{
                        $contact->generateOtp("sms");
                    }
                }

                $this->oneTimePassword = $this->contact->oneTimePasswords()->first()->id;
                //$user->generateOtp("sms");
                session(['contact' => $contact, 'oneTimePassword' => $this->oneTimePassword]);
                $this->beneficiary_created = true;
                $this->dispatchBrowserEvent('showStellarOtpModel', ['modalType' => $this->type]);
            }
        }
    }

    public function resendOtp(OneTimePassword $oneTimePassword)
    {
        if (Carbon::now()->gt($oneTimePassword->expires_at) && $oneTimePassword->verified_at == null) {

            $oneTimePassword->update(['code' => rand(100000, 999999), 'expires_at' => now()->addMinutes(OneTimePassword::getExpiringDuration())]);
        }

        $otpService = Setting::getValue('transaction_otp_service');
        if($otpService == 'email' && config('services.disable_email_service') == false)
        {
            $oneTimePassword->holder->notify(new EmailOneTimePasswordNotification($oneTimePassword));
        }else if($otpService == 'sms' && config('services.disable_sms_service') == false)
        {
            $oneTimePassword->holder->notify(new SmsOneTimePasswordNotification($oneTimePassword));
        }

        $this->sent_resend_otp = true;
    }

    public function verifyOtp()
    {
        $user = auth()->user();
        $data = $this->validate([
            'code' => 'required',
        ]);
        
        $oneTimePassword = $this->contact->oneTimePasswords()->first();

        if ($oneTimePassword->code !== $data['code']) {
            $this->addError('code', 'The otp you entered did not match.');
        } else if (now()->greaterThan($oneTimePassword->expires_at)) {
            $this->addError('code', 'The otp you entered has expired.');
        } else {
            $oneTimePassword->update(['verified_at' => now()]);
           
            return redirect()->route("dashboard.wallet.stellar-payouts.create", ['workspace_id' => $this->workspace->id])->with([
                'status' => 'success',
                'message' => 'The beneficiary created successfully.',
            ]);
        }
    }

    public function render()
    {
        return view('ledger-foundation::Livewire.stellar-beneficiary');
    }
}
