@extends('cms::dashboard.layouts.default')

@section('content')
    @yield('subcontent')
@endsection

@push('scripts')
<script>
function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode != 46 && charCode > 31
     && (charCode < 48 || charCode > 57))
      return false;

   return true;
}
</script>
@endpush
