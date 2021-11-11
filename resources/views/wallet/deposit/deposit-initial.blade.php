@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
<div class="px-5 sm:px-20 mt-0 pt-0">

    <form action="" method="">
        <div class="grid grid-cols-12 md:gap-10 mt-0">
            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                <label for="" class="form-label sm:w-40"> Wallet <span class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" value="" placeholder="VIP Coin">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                <label for="" class="form-label sm:w-40"> Amount <span class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" value="">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 md:gap-10 mt-0">
            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                <label for="" class="form-label sm:w-40"> Currency <span class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <input id="" type="text" class="form-control" value="" placeholder="EUR">
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-6 form-inline mt-0">
                <label for="" class="form-label sm:w-40"> Payement Method <span class="text-theme-6">*</span></label>
                <div class="sm:w-5/6">
                    <select data-search="true" class="tail-select mt-0 sm:mr-2 w-full  form-control mb-1" name="currency">
                            <option>Select</option>
                            <option>Paypal</option>
                            <option>Stripe</option>
                            <option>Bank</option>
                    </select>
                    <span class="block text-theme-6 mt-2"></span>
                </div>
            </div>
        </div>


    </form>
    <div class="text-right mt-5">
        <a href="{{ route('dashboard.ledger-foundation.wallet.deposit-detail') }}" class="btn btn-primary w-24">Next</a>
    </div>
</div>
@endsection
