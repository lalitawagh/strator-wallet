@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
<div class="px-5 sm:px-5 mt-0 pt-0">
    <form action="{{ route('dashboard.ledger-foundation.wallet.store-deposit-initial') }}" method="POST">
        @csrf
        @livewire('deposit-wallet-component', ['wallets' => $wallets,'currencies' => $currencies])

        <div class="text-right mt-5">
            <button type="submit" class="btn btn-primary w-24">Next</button>
        </div>
    </form>
</div>
@endsection

