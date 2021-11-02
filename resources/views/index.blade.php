@extends('ledger-foundation::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('ledger-foundation.name') !!}
    </p>
@endsection
