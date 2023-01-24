@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
    <div class="px-5 sm:px-5 mt-0 pt-0">
        <form method="POST">
            @csrf
            <input type="hidden" name="workspace_id" value="{{ request()->input('workspace_id') }}">

            @livewire('deposit-otp-verification-component',['countryWithFlags' => $countryWithFlags, 'defaultCountry' =>
            $defaultCountry, 'user' => $user])


        </form>
    </div>
@endsection

@push('scripts')
<script>
    $url = window.location.pathname.split('/');
    if ($url[3] == 'stellar-payment-otp-confirmation') {
        $('#color-scheme-content').addClass('dark');
    }
</script>
@endpush
