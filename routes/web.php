<?php
use Illuminate\Support\Facades\Route;
use Kanexy\LedgerFoundation\Http\Controllers\LedgerFoundationController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\AssetClassController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\AssetTypeController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\CommodityTypeController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\ExchangeRateController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\LedgerController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\DepositController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\DisputeController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\ExchangeController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\PayoutController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\ReceiveController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\TransactionController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\WalletController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\WithdrawController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['web','auth'],'prefix'=>'dashboard/ledger-foundation','as'=>'dashboard.ledger-foundation.'],function()  {
    Route::get('/', [LedgerFoundationController::class,'index']);
    Route::resource("asset-class",AssetClassController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('asset-type', AssetTypeController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('commodity-type', CommodityTypeController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('ledger', LedgerController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('dispute', DisputeController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('wallet-payout', PayoutController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('wallet-receive', ReceiveController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('wallet-deposit', DepositController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('wallet-transaction', TransactionController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('wallet-exchange', ExchangeController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('wallet-withdraw', WithdrawController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource("exchange-rate",ExchangeRateController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::name('wallet.deposit-initial')->get('wallet-deposit-initial', [DepositController::class, 'depositInitial']);
    Route::name('wallet.store-deposit-initial')->post('wallet-deposit-initial', [DepositController::class, 'storeDepositInitial']);
    Route::name('wallet.deposit-detail')->get('wallet-deposit-detail', [DepositController::class, 'depositDetail']);
    Route::name('wallet.store-deposit-detail')->post('wallet-deposit-detail', [DepositController::class, 'storeDepositDetail']);
    Route::name('wallet.deposit-payment')->get('wallet-deposit-payment', [DepositController::class, 'depositPayment']);
    Route::name('wallet.store-deposit-payment')->post('wallet-deposit-payment-paypal', [DepositController::class, 'storeDepositPayment']);
    Route::name('wallet.stripe-payment')->post('wallet-stripe-payment', [DepositController::class, 'stripePayment']);
    Route::name('wallet.store-deposit-stripe-payment')->post('wallet-deposit-stripe-payment', [DepositController::class, 'storeDepositStripePayment']);
    Route::name('wallet.deposit-final')->get('wallet-deposit-final', [DepositController::class, 'depositFinal']);
    Route::name('wallet.deposit-money')->get('wallet-deposit-money', [DepositController::class, 'depositMoney']);

});

Route::group(['middleware' =>['web','auth'],'prefix' => 'customer/signup', 'as' => 'customer.signup.'], function () {
    Route::resource('wallet', WalletController::class)->only(['index', 'create', 'store', 'show']);
});
