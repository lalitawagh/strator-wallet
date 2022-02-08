@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
<div class="px-5 sm:px-5 mt-0 pt-0">
    <form action="{{ route('dashboard.wallet.deposit.store') }}" method="POST">
        @csrf
        @if (Session::has('error'))
        <span class="block text-theme-6">{{ Session::get('error') }}</span>
        @endif
        <input type="hidden" name="workspace_id" value="{{ request()->input('workspace_id') }}">
        @livewire('deposit-wallet-component', ['wallets' => $wallets,'currencies' => $currencies])

        <div class="text-right mt-5">
            <button type="submit" class="btn btn-primary w-24">Next</button>
        </div>
    </form>
</div>
@endsection

