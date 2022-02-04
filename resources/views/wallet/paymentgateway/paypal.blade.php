<div id="paypal-button-container"></div>
@php
$total = @$details['fee'] + @$details['amount'];
@endphp
<script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}"></script>
@push('scripts')
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    application_context: {
                        brand_name: 'Wallet Deposit',
                        user_action: 'PAY_NOW',
                    },
                    purchase_units: [{
                        amount: {
                            value: '{{ $total }}'
                        }
                    }],
                });
            },

            onApprove: function(data, actions) {

                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {

                    if (details.status == 'COMPLETED') {
                        return fetch(
                                "{{ route('dashboard.wallet.paypal-payment',['workspace_id' => $details['workspace_id']]) }}", {
                                    method: 'post',
                                    headers: {
                                        'content-type': 'application/json',
                                        "Accept": "application/json, text-plain, */*",
                                        "X-Requested-With": "XMLHttpRequest",
                                        "X-CSRF-TOKEN": token
                                    },
                                    body: JSON.stringify({
                                        orderId: data.orderID,
                                        id: details.id,
                                        status: details.status,
                                        payerEmail: details.payer.email_address,
                                        paymentDetails: details.purchase_units,
                                        payer_id: details.payer.payer_id,
                                        payer: details.payer
                                    })
                                })
                            .then(status)
                            .then(function(response) {
                                // redirect to the completed page if paid
                                window.location.href =
                                    "{{ route('dashboard.wallet.deposit-final-detail',['workspace_id' => $details['workspace_id']]) }}";

                            })
                            .catch(function(error) {
                                // redirect to failed page if internal error occurs
                                window.location.href =
                                    "{{ route('dashboard.wallet.deposit.index',['workspace_id' => $details['workspace_id']]) }}";
                            });
                    } else {
                        window.location.href =
                            "{{ route('dashboard.wallet.deposit.index',['workspace_id' => $details['workspace_id']]) }}";
                    }
                });
            },

            onCancel: function(data) {
                window.location.href = "{{ route('dashboard.wallet.deposit.index',['workspace_id' => $details['workspace_id']]) }}";
            },

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
