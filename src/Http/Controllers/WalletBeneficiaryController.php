<?php

namespace Kanexy\LedgerFoundation\Http\Controllers;

use Kanexy\Cms\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kanexy\Banking\Models\Account;
use Kanexy\Cms\I18N\Models\Country;
use Spatie\QueryBuilder\QueryBuilder;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\Cms\Setting\Models\Setting;
use Spatie\QueryBuilder\AllowedFilter;
use Kanexy\PartnerFoundation\Cxrm\Models\Contact;
use Kanexy\PartnerFoundation\Cxrm\Events\ContactDeleted;
use Kanexy\PartnerFoundation\Workspace\Models\Workspace;
use Kanexy\PartnerFoundation\Cxrm\Events\ContactDeleting;
use Kanexy\PartnerFoundation\Cxrm\Policies\ContactPolicy;
use Kanexy\LedgerFoundation\Http\Requests\UpdateBeneficiaryRequest;

class WalletBeneficiaryController extends Controller
{


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
            $beneficiaries = $contacts->beneficiaries()->where('workspace_id', $workspace->id)->where('ref_type', 'wallet')->verified()->latest()->paginate();
        } else {

            $beneficiaries = $contacts->beneficiaries()->where('ref_type', 'wallet')->verified()->latest()->paginate();
        }



        return view("ledger-foundation::beneficiaries.index", compact('beneficiaries', 'workspace'));
    }

    public function edit(Contact $beneficiary)
    {
        $this->authorize(ContactPolicy::EDIT, $beneficiary);
        $countryWithFlags = Country::orderBy("name")->get();
        $countries = Country::get();
        $user = Auth::user();
        $defaultCountry = Setting::getValue('default_country');
        return view("ledger-foundation::beneficiaries.edit", compact('user', 'beneficiary', 'countries', 'defaultCountry', 'countryWithFlags'));
    }

    public function update(UpdateBeneficiaryRequest $request, Contact $beneficiary)
    {
        $data = $request->validated();

        $beneficiary->update($data);

        if (auth()->user()->isSuperAdmin()) {
            return redirect()->route("dashboard.wallet.beneficiaries.index")->with([
                'status' => 'success',
                'message' => 'The beneficiary updated successfully.',
            ]);
        }

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

        if (auth()->user()->isSuperAdmin()) {
            return redirect()->route("dashboard.wallet.beneficiaries.index")->with([
                'status' => 'success',
                'message' => 'The beneficiary deleted successfully.',
            ]);
        }

        return redirect()->route("dashboard.wallet.beneficiaries.index", ['filter' => ['workspace_id' => $beneficiary->workspace_id]])->with([
            'status' => 'success',
            'message' => 'The beneficiary deleted successfully.',
        ]);
    }
}
