
@extends("ledger-foundation::wallet.deposit.skeleton")

@section('deposit-content')
<div class="px-5 sm:px-5 mt-0 pt-0">
    <form action="" method="">
        {{-- <div id="horizontal-form" class="p-5"> --}}
        @if($details['payment_method'] == 'Paypal')
            <div id="paypal-button-container"></div>
        @else
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
            <div class="text-right mt-5 form-inline text-right mt-5 float-right">
                <a href="#" class="btn btn-secondary w-20 inline-block mr-2">Preview</a>
                <a href="{{ route('dashboard.ledger-foundation.wallet.deposit-final') }}" class="btn btn-primary w-24">Next</a>
            </div>
        @endif
    </form>

</div>
@endsection

<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}"></script>

@push('scripts')
<script>
    paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        application_context: {
          brand_name : 'Wallet Deposit',
          user_action : 'PAY_NOW',
        },
        purchase_units: [{
          amount: {
            value: '{{ $details['amount'] }}'
          }
        }],
      });
    },

    onApprove: function(data, actions) {

      let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {

          if(details.status == 'COMPLETED'){
            return fetch('/dashboard/ledger-foundation/wallet-deposit-payment-paypal', {
                      method: 'post',
                      headers: {
                          'content-type': 'application/json',
                          "Accept": "application/json, text-plain, */*",
                          "X-Requested-With": "XMLHttpRequest",
                          "X-CSRF-TOKEN": token
                      },
                      body: JSON.stringify({
                          orderId     : data.orderID,
                          id : details.id,
                          status: details.status,
                          payerEmail: details.payer.email_address,
                          paymentDetails : details.purchase_units,
                          payer_id : details.payer.payer_id,
                          payer: details.payer
                      })
                  })
                  .then(status)
                  .then(function(response){
                      // redirect to the completed page if paid
                      window.location.href = '/dashboard/ledger-foundation/wallet-deposit-final';
                  })
                  .catch(function(error) {
                      // redirect to failed page if internal error occurs
                    //   window.location.href = '/pay-failed?reason=internalFailure';
                  });
          }else{
            //   window.location.href = '/pay-failed?reason=failedToCapture';
          }
      });
    },

    onCancel: function (data) {
        window.location.href = '/pay-failed?reason=userCancelled';
    }



    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.

    function status(res) {
      if (!res.ok) {
          throw new Error(res.statusText);
      }
      return res;
    }
  </script>
@endpush
