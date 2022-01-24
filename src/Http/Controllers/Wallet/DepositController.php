<?php

namespace Kanexy\LedgerFoundation\Http\Controllers\Wallet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Kanexy\Cms\Controllers\Controller;
use Kanexy\LedgerFoundation\Entities\AssetType;
use Kanexy\LedgerFoundation\Entities\Wallet;
use Kanexy\LedgerFoundation\Http\Enums\AssetCategoryEnum;
use Kanexy\PartnerFoundation\Banking\Models\Transaction;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe;

class DepositController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallets = Wallet::forHolder($user)->with('ledger')->get();
        $currencies = AssetType::whereAssetCategory(AssetCategoryEnum::FIAT_CURRENCY)->get();

        return view("ledger-foundation::wallet.deposit.deposit-initial", compact('wallets', 'currencies'));
    }

    public function depositInitial()
    {
        return view("ledger-foundation::wallet.deposit.deposit-initial");
    }

    public function storeDepositInitial(Request $request)
    {
        $data = $request->validate([
            'wallet'            => 'required',
            'currency'          => 'required',
            'amount'            => 'required',
            'payment_method'    => 'required'
        ]);
        $data['fee'] = 2;

        session(['deposit_request' => $data]);

        return redirect()->route('dashboard.ledger-foundation.wallet.deposit-detail');
    }

    public function depositDetail()
    {
        $details = session('deposit_request');

        return view("ledger-foundation::wallet.deposit.deposit-detail", compact('details'));
    }

    public function storeDepositDetail()
    {
        $details = session('deposit_request');

        return redirect()->route('dashboard.ledger-foundation.wallet.deposit-payment');
    }

    public function depositPayment()
    {
        $details = session('deposit_request');


        return view("ledger-foundation::wallet.deposit.deposit-payment",compact('details'));
    }

    public function storeDepositPayment(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $depositRequest = session('deposit_request');

        $user = Auth::user();
        $workspace = $user->workspaces()->first();

        if($data['status'] == 'COMPLETED')
        {
            Transaction::create([
                'urn' => Transaction::generateUrn(),
                'amount' => $depositRequest['amount'],
                'workspace_id' => $workspace->getKey(),
                'type' => 'credit',
                'payment_method' => 'wallet',
                'note' => null,
                // 'ref_id' =>  $data['paymentDetails'][0]['payments']['captures'][0]['id'],
                'ref_type' => 'paypal',
                'settled_amount' => $depositRequest['amount'],
                'settled_currency' => $depositRequest['currency'],
                'settlement_date' => date('Y-m-d'),
                'settled_at' => now(),
                'transaction_fee' => $depositRequest['fee'],
                'status' => 'accepted',
                'meta' => [
                    'sender_ref_id' => $data['payer_id'],
                    'sender_name' => $data['payer']['name']['given_name'].' '.$data['payer']['name']['surname'],
                    'sender_merchant_id' => $data['paymentDetails'][0]['payee']['merchant_id'],
                    'beneficiary_id' => Auth::user()->id,
                    'beneficiary_ref_id' => $depositRequest['wallet'],
                    'beneficiary_name' => Auth::user()->getFullName(),
                    'transaction_id' => $data['paymentDetails'][0]['payments']['captures'][0]['id'],
                ],
            ]);

            $wallet = Wallet::find($depositRequest['wallet']);
            $balance = $wallet->balance + $depositRequest['amount'];
            $wallet->update(['balance' => $balance]);
        }

        return response()->json(['status' => 'success']);
    }

    public function storeDepositPaymentStripe(Request $request)
    {
        $depositRequest = session('deposit_request');
        $stripe =  Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $data = Stripe\Charge::create ([
                "amount" => $request->input('amount') * 100,
                "currency" => $depositRequest['currency'],
                "source" => $request->input('stripeToken'),
                "description" => "Test payment."
        ]);

        $feeDetails = Http::withToken(config('services.stripe.secret'))
            ->acceptJson()
            ->get('https://api.stripe.com/v1/balance/history/'. $data->balance_transaction)
            ->throw()
            ->json();

        $data['transaction_fee'] = $feeDetails['fee'];

        return response()->json(['status' => 'success','data' => $data]);

    }


    public function storeDepositPaymentStripeFinal(Request $request)
    {
        $depositRequest = session('deposit_request');
        $response = $request->all();

        if($response['data']['status'] == 'succeeded')
        {

            $user = Auth::user();
            $workspace = $user->workspaces()->first();
            $depositRequest['stripe_fee'] = $response['data']['transaction_fee']/100;
            $depositRequest['stripe_receipt_url'] = $response['data']['receipt_url'];
            session(['deposit_request' => $depositRequest]);

            Transaction::create([
                'urn' => Transaction::generateUrn(),
                'amount' => $depositRequest['amount'] + $depositRequest['fee'],
                'workspace_id' => $workspace->getKey(),
                'type' => 'credit',
                'payment_method' => 'wallet',
                'note' => null,
                // 'ref_id' =>  $data['paymentDetails'][0]['payments']['captures'][0]['id'],
                'ref_type' => 'stripe',
                'settled_amount' => $depositRequest['amount'] + $depositRequest['fee'],
                'settled_currency' => $depositRequest['currency'],
                'settlement_date' => date('Y-m-d'),
                'settled_at' => now(),
                'transaction_fee' => $depositRequest['fee'],
                'status' => 'accepted',
                'meta' => [
                    'sender_payment_id' => $response['data']['id'],
                    'sender_name' => $response['data']['source']['name'],
                    'sender_card_id' => $response['data']['payment_method'],
                    'sender_card_fingerprint' => $response['data']['source']['fingerprint'],
                    'stripe_balance_transaction' => $response['data']['balance_transaction'],
                    'beneficiary_id' => Auth::user()->id,
                    'beneficiary_ref_id' => $depositRequest['wallet'],
                    'beneficiary_name' => Auth::user()->getFullName(),
                    'stripe_fee' => ($response['data']['transaction_fee'])/100,
                    'stripe_receipt_url' => $response['data']['receipt_url']
                ],
            ]);
            $totalAmount = $depositRequest['amount'] - ($response['data']['transaction_fee']/100);
            $wallet = Wallet::find($depositRequest['wallet']);
            $balance = $wallet->balance + $totalAmount;
            $wallet->update(['balance' => $balance]);
        }
        return response()->json(['status' => 'success']);
    }

    public function depositFinal()
    {
        $details = session('deposit_request');
        return view("ledger-foundation::wallet.deposit.deposit-final",compact('details'));
    }
}
