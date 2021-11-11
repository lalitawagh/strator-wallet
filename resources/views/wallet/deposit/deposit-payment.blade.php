
@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
<div class="px-5 sm:px-20 mt-0 pt-0">
    <form action="" method="">
        {{-- <div id="horizontal-form" class="p-5"> --}}


            <div class="flex">
                <div class="w-1/2 px-2">
                    <div class="form-inline">
                        <label for="horizontal-form-1" class="form-label sm:w-24"> Card Type</label>
                        <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1" name="currency">

                            <option>Debit Card</option>
                            <option>Credit Card</option>
                        </select>


                    </div>
                </div>
                <div class="w-1/2 px-2">
                    <div class="form-inline">
                        <label for="horizontal-form-3" class="form-label sm:w-24">Card Number</label>
                        <input id="horizontal-form-3" type="text" class="form-control" placeholder="3546879542685421">
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 px-2">
                    <div class="form-inline mt-2">
                        <label for="horizontal-form-2" class="form-label sm:w-24">Expiry</label>
                        <input id="horizontal-form-2" type="text" class="form-control" placeholder="11/22">
                    </div>
                </div>
                <div class="w-1/2 px-2">
                    <div class="form-inline mt-2">
                        <label for="horizontal-form-2" class="form-label sm:w-24">CVV</label>
                        <input id="horizontal-form-2" type="text" class="form-control" placeholder="135">
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 px-2">
                    <div class="form-inline mt-2">
                        <label for="horizontal-form-3" class="form-label sm:w-24">Cardholder</label>
                        <input id="horizontal-form-3" type="text" class="form-control" placeholder="Jack">
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2 px-2">
                <div class="form-inline mt-2">
                    <label for="horizontal-form-3" class="form-label sm:w-24"></label>
                    <button class="btn btn-primary w-24 ml-2">Save</button>
                </div>
                </div>
            </div>

        {{-- </div> --}}


    <div class="text-right mt-5 form-inline text-right mt-5 float-right">
        <a href="#" class="btn btn-secondary w-20 inline-block mr-2">Preview</a>
        <a href="{{ route('dashboard.ledger-foundation.wallet.deposit-final') }}" class="btn btn-primary w-24">Next</a>
    </div>
    </form>
</div>
@endsection
