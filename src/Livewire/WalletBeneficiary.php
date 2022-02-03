<?php

namespace Kanexy\LedgerFoundation\Livewire;

use App\Models\User;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
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

    public function mount($workspace)
    {
        $this->workspace = $workspace;
    }

    public function getMembershipDetails()
    {
       $workspace = User::wherePhone($this->mobile)->first()?->workspaces()->first();
       $membership = $workspace?->memberships()->first();

       $this->membership_urn = $membership?->urn;
       $this->membership_name = $membership?->name;
    }

    public function createBeneficiary()
    {
        $data = $this->validate([
                'first_name' => 'required',
                'middle_name' => 'nullable',
                'last_name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'notes' => 'nullable',
                'nick_name' => 'nullable',
            ]);

        $data['workspace_id'] = $this->workspace->id;
        $data['ref_type'] = 'wallet';
        $data['classification'] = $this->classification;
        $data['status'] = 'active';

        /** @var Contact $contact */
        $contact = Contact::create($data);

        event(new ContactCreated($contact));

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->notify(new SmsOneTimePasswordNotification($contact->generateOtp("sms")));
        //$user->generateOtp("sms");

        $this->beneficiary_created = 1;
    }

    public function verifyOtp()
    {
        $user = auth()->user();
        $data = $this->validate([
                'code' => 'required',
            ]);

        $oneTimePassword = $user->oneTimePasswords()->first();

        if ($oneTimePassword->code !== $data['code']) {
            $this->addError('code', 'The otp you entered did not match.');
        } else if (now()->greaterThan($oneTimePassword->expires_at)) {
            $this->addError('code', 'The otp you entered has expired.');
        }else{
            $oneTimePassword->update(['verified_at' => now()]);

            return redirect()->route("dashboard.ledger-foundation.wallet-payout.create",['workspace_id' => $this->workspace->id])->with([
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
