
@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
<div class="px-5 sm:px-20 mt-0 pt-0">
    <div class="p-5 text-center">
        <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
        <div class="text-3xl mt-5">Success!</div>
        <div class="text-gray-600 mt-2">Deposit Completed Successfully</div>
        <div class=" mt-3 font-medium text-base">Deposit Amount:$10.00</div>
    </div>
    <div class="px-5 pb-8 text-center mt-3">
        <button class="btn btn-secondary w-24 mr-2 mb-2">Print</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary">Deposit Money Again</button>
    </div>
</div>
@endsection
