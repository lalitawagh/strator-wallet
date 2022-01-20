
@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
<div class="px-5 sm:px-5 mt-0 pt-0">
    <form action="" method="">
        {{-- <div id="horizontal-form" class="p-5"> --}}
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="horizontal-form-1" class="form-label sm:w-24"> Card Type</label>
                <div class="sm:w-5/6">
                    <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1" name="currency">
                        <option>Debit Card</option>
                        <option>Credit Card</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="horizontal-form-3" class="form-label sm:w-24">Card Number</label>
                <div class="sm:w-5/6">
                    <input id="horizontal-form-3" type="text" class="form-control" placeholder="3546879542685421">
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="horizontal-form-2" class="form-label sm:w-24">Expiry</label>
                <div class="sm:w-5/6">
                    <input id="horizontal-form-2" type="text" class="form-control" placeholder="11/22">
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="horizontal-form-2" class="form-label sm:w-24">CVV</label>
                <div class="sm:w-5/6">
                    <input id="horizontal-form-2" type="text" class="form-control" placeholder="135">
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-12 form-inline mt-2">
                <label for="horizontal-form-3" class="form-label sm:w-24">Cardholder</label>
                <div class="sm:w-5/6">
                    <input id="horizontal-form-3" type="text" class="form-control" placeholder="Jack">
                </div>
            </div>
    </form>
    <div class="text-right mt-5 form-inline text-right mt-5 float-right">
        <a href="#" class="btn btn-secondary w-20 inline-block mr-2">Preview</a>
        <a href="{{ route('dashboard.ledger-foundation.wallet.deposit-final') }}" class="btn btn-primary w-24">Next</a>
    </div>
</div>
@endsection
