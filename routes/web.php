<?php

use Illuminate\Support\Facades\Route;
use Kanexy\Cms\Middleware\VerificationStepMiddleware;
use Kanexy\LedgerFoundation\Http\Controllers\LedgerFoundationController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\AssetClassController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\AssetTypeController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\CommodityTypeController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\ExchangeRateController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\FeeController;
use Kanexy\LedgerFoundation\Http\Controllers\Ledgers\LedgerController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\DashboardController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\DepositController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\DisputeController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\ExchangeController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\PayoutController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\ReceiveController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\TransactionController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\WalletController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\WithdrawController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\MasterAccountController;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\StellarPayouts;
use Kanexy\LedgerFoundation\Http\Controllers\Wallet\StellerController;
use Kanexy\LedgerFoundation\Http\Controllers\WalletBeneficiaryController;

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

Route::group(['middleware' => ['web', 'auth', VerificationStepMiddleware::class], 'prefix' => 'dashboard/wallet', 'as' => 'dashboard.wallet.'], function () {
    Route::name('wallet-dashboard')->get('/', [DashboardController::class, 'index']);
    Route::resource("master-account", MasterAccountController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource("asset-class", AssetClassController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('asset-type', AssetTypeController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('fee', FeeController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('commodity-type', CommodityTypeController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('ledger', LedgerController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('dispute', DisputeController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('payout', PayoutController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('receive', ReceiveController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('deposit', DepositController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('transaction', TransactionController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('/wallet/{wallet}/toggle-favorite', [TransactionController::class, 'toggleFavorite'])->name('wallet.toggleFavorite');
    Route::resource('exchange', ExchangeController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('withdraw', WithdrawController::class)->only(['index', 'create', 'store']);
    Route::resource("exchange-rate", ExchangeRateController::class)->only(['index', 'create', 'store', 'show', 'edit', 'destroy', 'update']);
    Route::resource('stellar-payouts', \Kanexy\LedgerFoundation\Http\Controllers\Wallet\StellarPayouts::class)->only(['index', 'create', 'store', 'show']);
    Route::name('deposit-overview')->get('deposit-overview', [DepositController::class, 'showDepositOverview']);
    Route::name('store-deposit-overview-detail')->post('store-deposit-overview-detail', [DepositController::class, 'storeDepositOverviewDetail']);
    Route::name('deposit-otp-confirmation')->get('deposit-otp-confirmation', [DepositController::class, 'showDepositOtpConfirmation']);

    Route::name('store-payment-details')->get('store-payment-details', [DepositController::class, 'storePaymentDetails']);
    Route::name('deposit-payment')->get('deposit-payment', [DepositController::class, 'showDepositPayment']);
    Route::name('paypal-payment')->post('paypal-payment', [DepositController::class, 'paypalPayment']);
    Route::name('stripe-payment')->post('stripe-payment', [DepositController::class, 'stripePayment']);
    Route::name('deposit-stripe-payment')->post('deposit-stripe-payment', [DepositController::class, 'storeStripeDepositPaymentDetails']);
    Route::name('deposit-final-detail')->get('deposit-final-detail', [DepositController::class, 'showFinalDepositDetail']);
    Route::name('deposit-money')->get('deposit-money', [DepositController::class, 'showDepositMoney']);
    Route::name('payout-verify')->get('payout-verify', [PayoutController::class, 'verify']);
    Route::resource('beneficiaries', WalletBeneficiaryController::class);
    Route::get('withdraw/verify', [WithdrawController::class, 'verify'])->name("withdraw.verify");
    Route::get('wallet-payout-accepted/{id}/{type}', [PayoutController::class, 'transferAccepted'])->name("wallet-payout.transferAccepted");
    Route::get('wallet-withdraw-accepted/{id}/{type}', [WithdrawController::class, 'withdrawAccepted'])->name("withdrawAccepted");
    Route::get('wallet-deposit-accepted/{id}/{type}', [DepositController::class, 'transferAccepted'])->name("wallet-deposit.transferAccepted");
    Route::get('wallet-deposit-pending/{id}/{type}', [DepositController::class, 'transferPending'])->name("wallet-deposit.transferPending");

    Route::get('create-steller-account', [StellerController::class, 'createAccount'])->name('create-steller-account');
    Route::get('get-balance', [StellerController::class, 'getBalance'])->name('get-balance');
    Route::get('crypto-portfolio', [StellerController::class, 'dashboard'])->name('stellar-dashboard');
    Route::get('crypto-exchange', [StellerController::class, 'exchange'])->name('stellar-exchange');
    Route::get('crypto-buying', [StellerController::class, 'buying'])->name('buying-crypto');

    Route::get('crypto-account', [StellerController::class, 'index'])->name('crypto-account');
    Route::get('stellar-payout-verify', [StellarPayouts::class, 'verify'])->name('stellar-payout-verify');
    Route::get('stellar-exchange-rate', [StellerController::class, 'exchangeRateView'])->name('stellar-exchange-rate');
    Route::post('stellar-exchange-rate', [StellerController::class, 'getExchangeRate'])->name('stellar-exchange-rate');
});

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'customer/signup', 'as' => 'customer.signup.'], function () {
    Route::resource('wallet', WalletController::class)->only(['index', 'create', 'store', 'show']);
});
