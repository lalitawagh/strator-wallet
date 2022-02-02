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

Route::group(['middleware'=>['web','auth'],'prefix'=>'dashboard/wallet','as'=>'dashboard.wallet.'],function()  {
    Route::get('/', [LedgerFoundationController::class,'index']);
    Route::resource("asset-class",AssetClassController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('asset-type', AssetTypeController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('commodity-type', CommodityTypeController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('ledger', LedgerController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('dispute', DisputeController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('payout', PayoutController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('receive', ReceiveController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('deposit', DepositController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('transaction', TransactionController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('exchange', ExchangeController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('withdraw', WithdrawController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource("exchange-rate",ExchangeRateController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::name('deposit-overview')->get('deposit-overview', [DepositController::class, 'showDepositOverview']);
    Route::name('store-deposit-overview-detail')->post('store-deposit-overview-detail', [DepositController::class, 'storeDepositOverviewDetail']);
    Route::name('deposit-payment')->get('deposit-payment', [DepositController::class, 'showDepositPayment']);
    Route::name('paypal-payment')->post('paypal-payment', [DepositController::class, 'paypalPayment']);
    Route::name('stripe-payment')->post('stripe-payment', [DepositController::class, 'stripePayment']);
    Route::name('deposit-stripe-payment')->post('deposit-stripe-payment', [DepositController::class, 'storeStripeDepositPaymentDetails']);
    Route::name('deposit-final-detail')->get('deposit-final-detail', [DepositController::class, 'showFinalDepositDetail']);
    Route::name('deposit-money')->get('deposit-money', [DepositController::class, 'showDepositMoney']);

});

Route::group(['middleware' =>['web','auth'],'prefix' => 'customer/signup', 'as' => 'customer.signup.'], function () {
    Route::resource('wallet', WalletController::class)->only(['index', 'create', 'store', 'show']);
});
