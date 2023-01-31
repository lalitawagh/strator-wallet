<?php

namespace Kanexy\LedgerFoundation\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Kanexy\Cms\Helper;
use Kanexy\Cms\Models\OneTimePassword;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\Cms\Rules\AlphaSpaces;
use Kanexy\Cms\Rules\MobileNumber;
use Kanexy\PartnerFoundation\Cxrm\Events\ContactCreated;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Livewire\Component;

class WalletBeneficiary extends Component
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
        $workspace = User::wherePhone($this->mobile)->first()?->workspaces()->first();
        $membership = $workspace?->memberships()->first();

        $this->membership_urn = $membership?->urn;
        $this->membership_name = $membership?->name;
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
            'mobile' => ['required', new MobileNumber],
            'email' => 'nullable|email',
            'notes' => 'nullable',
            'nick_name' => 'nullable',
            'country_code' => 'nullable',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($this->type == 'transfer' && $data['mobile'] != $user->phone) {
            $this->addError('mobile', 'You can create self beneficiary');
        }

        $existContact = Contact::where(['workspace_id' => $this->workspace->id, 'mobile' => Helper::normalizePhone($data['mobile']), 'ref_type' => 'wallet'])->first();

        if (!is_null($existContact)) {
            $this->addError('mobile', 'Beneficiary already exist');
        } else {

            if (is_null($this->membership_urn)) {
                $this->addError('mobile', 'Membership not exists with this mobile number');
            } else {

                $data['mobile'] = Helper::normalizePhone($data['mobile']);
                $data['workspace_id'] = $this->workspace->id;
                $data['ref_type'] = 'wallet';
                $data['classification'] = $this->classification;
                $data['status'] = 'active';
                $data['meta'] = ['country_code' => $data['country_code']];

                /** @var Contact $contact */
                $contact = Contact::create($data);

                event(new ContactCreated($contact));

                $this->contact = $contact;

                if(config('services.disable_sms_service') == false){
                    $contact->notify(new SmsOneTimePasswordNotification($contact->generateOtp("sms")));
                }else{
                    $contact->generateOtp("sms");
                }

                $this->oneTimePassword = $this->contact->oneTimePasswords()->first()->id;
                //$user->generateOtp("sms");
                session(['contact' => $contact, 'oneTimePassword' => $this->oneTimePassword]);
                $this->beneficiary_created = true;
                $this->dispatchBrowserEvent('showOtpModel', ['modalType' => $this->type]);
            }
        }
    }

    public function resendOtp(OneTimePassword $oneTimePassword)
    {
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

            return redirect()->route("dashboard.wallet.payout.create", ['workspace_id' => $this->workspace->id])->with([
                'status' => 'success',
                'message' => 'The beneficiary created successfully.',
            ]);
        }
    }

    public function render()
    {
        return view('ledger-foundation::Livewire.wallet-beneficiary');
    }
}
