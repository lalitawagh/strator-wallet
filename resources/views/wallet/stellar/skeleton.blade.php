@extends('ledger-foundation::layouts.master')
@push('styles')
<link rel="stylesheet" href="{{ asset('dist/css/stellar.css') }}"/>
@endpush
@section('content')
    @yield('stellar-content')
    <div class="seller-menu gap-6 gap-6 px-5 pt-5 pb-3">
        <ul>
            <li>
                <a  href="{{ route('dashboard.wallet.stellar-dashboard') }}">
                    <img src="{{ asset('dist/images/crypto/menu-icon1.svg') }}">
                </a>
            </li>
            <li>
                <a class="cryptoMenu-active" href="{{ route('dashboard.wallet.stellar-exchange-rate') }}">
                    <img src="{{ asset('dist/images/crypto/menu-icon2.svg') }}">
                </a>
            </li>
            <li>
                <a href="">
                    <img src="{{ asset('dist/images/crypto/menu-icon3.svg') }}">
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.wallet.stellar-payouts.create', ['filter' => ['workspace_id' => \Kanexy\PartnerFoundation\Core\Helper::activeWorkspaceId()]]) }}">
                    <img src="{{ asset('dist/images/crypto/menu-icon4.svg') }}">
                </a>
            </li>
    
        </ul>
    </div>
@endsection