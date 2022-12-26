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
use Kanexy\Cms\Setting\Models\Setting;
use Kanexy\PartnerFoundation\Core\Dtos\CreateBeneficiaryDto;
use Kanexy\PartnerFoundation\Core\Services\WrappexService;
use Kanexy\PartnerFoundation\Cxrm\Events\ContactCreated;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;
use Livewire\Component;

class WithdrawBeneficiaryComponent extends Component
{
    public $mobile;

    public $membership_urn;

    public $membership_name;

    public $workspace;

    public $first_name;

    public $middle_name;

    public $last_name;

    public $email;

    public $notes;

    public $classification = ['beneficiary'];

    public $beneficiary_created;

    public $code;

    public $contact;

    public $countryWithFlags;

    public $defaultCountry;

    public $oneTimePassword;

    public $account_number;

    public $account_name;

    public $sort_code;

    public $sent_resend_otp;

    public $country_code;

    public $user;

    public function mount($workspace, $countryWithFlags, $defaultCountry)
    {
        $this->workspace = $workspace;
        $this->countryWithFlags = $countryWithFlags;
        $this->defaultCountry = $defaultCountry;
        $this->user = Auth::user();
    }

    public function getMembershipDetails()
    {
        $mobile = Helper::normalizePhone($this->mobile);
        $workspace = User::wherePhone($mobile)->first()?->workspaces()->first();
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
        $user = Auth::user();

        $data = $this->validate([
            'first_name' => ['required', new AlphaSpaces, 'string', 'max:40'],
            'middle_name' => ['nullable', new AlphaSpaces, 'string', 'max:40'],
            'last_name' => ['required', new AlphaSpaces, 'string', 'max:40'],
            'email' => 'nullable|email',
            'mobile' => ['nullable', new MobileNumber],
            'notes' => 'nullable',
            'country_code' => 'nullable',
            'account_number' => 'required|digits:8',
            'account_name' => 'required',
            'sort_code' => 'required|digits:6',
        ]);

        $data['classification'] = $this->classification;

        $user = Auth::user();

        $exitsBeneficiary = Contact::beneficiaries()->verified()->forWorkspace($user->workspaces()->first())->whereRefType('wrappex')->where(['meta->beneficiary_type' => 'withdraw'])->first();

        if (isset($exitsBeneficiary) && $user->country_code == '91') {
            $this->addError('beneficiary', 'You can create only one beneficiary');
        } else {

            $ukMasterAccount =  collect(Setting::getValue('wallet_master_accounts',[]))->firstWhere('country', 231);
            $account = Account::whereAccountNumber($ukMasterAccount['account_number'])->first();
            $workspace = Workspace::findOrFail($account->holder_id);

            $info['first_name'] = $data['first_name'];
            $info['middle_name'] = $data['middle_name'];
            $info['last_name'] = $data['last_name'];
            $info['email'] = $data['email'];
            $info['display_name'] = implode(' ', [$data['first_name'], $data['middle_name'], $data['last_name']]);
            $info['meta'] = [
                'bank_account_number' => $data['account_number'],
                'bank_code' => $data['sort_code'],
                'bank_code_type' => 'sort-code',
                'beneficiary_type' => 'withdraw',
                'bank_account_name' => $data['account_name'],
            ];
            $info['classification'] = $this->classification;
            $data['meta'] = $info['meta'];


            $service = new WrappexService;
            $beneficiaryRefId = $service->createBeneficiary(
                new CreateBeneficiaryDto($workspace->ref_id, $info)
            );

            $data['workspace_id'] = $user->workspaces()->first()?->id;
            $data['ref_id']       = $beneficiaryRefId;
            $data['ref_type']     = 'wrappex';

            /** @var Contact $contact */
            $contact = Contact::create($data);

            event(new ContactCreated($contact));

            /** @var \App\Models\User $user */
            $user = auth()->user();
            $this->contact = $contact;

            if(config('services.disable_sms_service') == false){
                $contact->notify(new SmsOneTimePasswordNotification($contact->generateOtp("sms")));
            }else
            {
                $contact->generateOtp("sms");
            }
            // $contact->generateOtp("sms");
            $this->oneTimePassword = $this->contact->oneTimePasswords()->first()->id;
            //$user->generateOtp("sms");
            session(['contact' => $contact, 'oneTimePassword' => $this->oneTimePassword]);
            $this->beneficiary_created = true;
            $this->dispatchBrowserEvent('showOtpModel');
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

            return redirect()->route("dashboard.wallet.withdraw.create", ['workspace_id' => $this->workspace->id])->with([
                'status' => 'success',
                'message' => 'The beneficiary created successfully.',
            ]);
        }
    }

    public function render()
    {
        return view('ledger-foundation::Livewire.withdraw-beneficiary');
    }
}
