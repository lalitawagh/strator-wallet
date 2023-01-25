<?php

namespace Kanexy\LedgerFoundation\Http\Controllers;

use Kanexy\Cms\Helper;
use Illuminate\Http\Request;
use Kanexy\Banking\Models\Account;
use Kanexy\Cms\I18N\Models\Country;
use Spatie\QueryBuilder\QueryBuilder;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Spatie\QueryBuilder\AllowedFilter;
use Kanexy\Banking\Services\WrappexService;
use Kanexy\Banking\Dtos\CreateBeneficiaryDto;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Kanexy\PartnerFoundation\Cxrm\Events\ContactCreated;
use Kanexy\PartnerFoundation\Cxrm\Events\ContactDeleted;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;
use Kanexy\PartnerFoundation\Cxrm\Events\ContactDeleting;
use Kanexy\PartnerFoundation\Cxrm\Policies\ContactPolicy;
use Kanexy\Cms\Notifications\SmsOneTimePasswordNotification;
use Kanexy\LedgerFoundation\Http\Requests\StoreBeneficiaryRequest;
use Kanexy\LedgerFoundation\Http\Requests\UpdateBeneficiaryRequest;

class WalletBeneficiaryController extends Controller
{
    private WrappexService $service;

    public function __construct(WrappexService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $this->authorize(ContactPolicy::INDEX, Contact::class);

        $contacts = QueryBuilder::for(Contact::class)
            ->allowedFilters([
                AllowedFilter::exact('workspace_id'),
            ]);

        $workspace = null;

        if ($request->has('filter.workspace_id')) {
            $workspace = Workspace::findOrFail($request->input('filter.workspace_id'));
        }

        $beneficiaries = $contacts->beneficiaries()->where('ref_type', 'wallet')->verified()->latest()->paginate();


        return view("ledger-foundation::beneficiaries.index", compact('beneficiaries', 'workspace'));
    }

    public function create(Request $request)
    {
        $this->authorize(ContactPolicy::CREATE, Contact::class);

        $workspace = Workspace::findOrFail($request->input('workspace_id'));

        $countries = Country::get();
        $defaultCountry = Setting::getValue('default_country');

        $accounts = Account::whereNotNull('account_number')->latest()->get(['id', 'name', 'account_number']);

        return view("ledger-foundation::beneficiaries.create", compact('countries', 'defaultCountry', 'workspace', 'accounts'));
    }



    public function edit(Contact $beneficiary)
    {
        $this->authorize(ContactPolicy::EDIT, $beneficiary);

        $countries = Country::get();
        $defaultCountry = Setting::getValue('default_country');

        return view("ledger-foundation::beneficiaries.edit", compact('beneficiary', 'countries', 'defaultCountry'));
    }

    public function update(UpdateBeneficiaryRequest $request, Contact $beneficiary)
    {
        $data = $request->validated();

        if ($data['type'] == 'company') {
            $data['display_name'] = Helper::removeExtraSpace($data['company_name']);
        } else {
            $data['display_name'] = Helper::removeExtraSpace(implode(' ', [$data['first_name'], $data['middle_name'], $data['last_name']]));
        }

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('Images', 'azure');
        }

        $beneficiary->update($data);

        return redirect()->route("dashboard.wallet.beneficiaries.index", ['filter' => ['workspace_id' => $beneficiary->workspace_id]])->with([
            'status' => 'success',
            'message' => 'The beneficiary updated successfully.',
        ]);
    }

    public function destroy(Contact $beneficiary)
    {
        $this->authorize(ContactPolicy::DELETE, $beneficiary);

        event(new ContactDeleting($beneficiary));

        $beneficiary->delete();

        event(new ContactDeleted($beneficiary));

        return redirect()->route("dashboard.wallet.beneficiaries.index", ['filter' => ['workspace_id' => $beneficiary->workspace_id]])->with([
            'status' => 'success',
            'message' => 'The beneficiary deleted successfully.',
        ]);
    }

    public function getPartnerAccount(Request $request)
    {
        $account_id = $request->input('account_id') ?? '';

        if (!empty($account_id)) {
            $account_details = Account::with('workspaces')->findOrFail($account_id);
        }

        return $account_details->toArray();
    }
}
