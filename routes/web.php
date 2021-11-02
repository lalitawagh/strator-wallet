<?php
use Illuminate\Support\Facades\Route;
use Riteserve\LedgerFoundation\Http\Controllers\LedgerFoundationController;
use Riteserve\LedgerFoundation\Http\Controllers\Ledgers\AssetClassController;

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
});
