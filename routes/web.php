<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PoOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WalmartItemCronController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});
Route::middleware(['auth'])->group(function () {
    // User management routes
    Route::resource('/users', UsersController::class);
    Route::get('/get/users/data', [UsersController::class, 'getUsers'])->name('get.users.data');
    Route::post('/users/{id?}/toggle-status', [UsersController::class, 'toggleStatus'])->name('toggle.users.status');
    //settings routes
    Route::resource('/settings',SettingsController::class);
    //vendors rounds
    //payment terms routes
    Route::get('payment/terms',[VendorController::class,'paymentTermIndex'])->name('payment-terms.index');
    Route::post('payment/terms/store',[VendorController::class,'paymentTermsStore'])->name('payment-terms.store');
    //ship via routes
    Route::get('ship/via',[VendorController::class,'shipViaIndex'])->name('ship-via.index');
    Route::post('ship/via/store',[VendorController::class,'ShipViaStore'])->name('ship-via.store');
    //locations routes
    Route::get('locations',[VendorController::class,'locationIndex'])->name('locations.index');
    Route::get('locations/data', [VendorController::class, 'getLocationData'])->name('locations.data');
    Route::get('locations/create', [VendorController::class, 'createLocation'])->name('locations.create');
    Route::post('locations/store', [VendorController::class, 'storeLocation'])->name('locations.store');
    Route::get('locations/edit/{id?}', [VendorController::class, 'editLocation'])->name('locations.edit');
    Route::put('locations/update/{id?}', [VendorController::class, 'updateLocation'])->name('locations.update');


    //vendors routes
    Route::resource('/vendors', VendorController::class);
    //view routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/po-orders', [PoOrderController::class, 'index'])->name('po.order.index');
    Route::get('/po-order-create', [PoOrderController::class, 'create'])->name('po.order.create');

    //Reports routes
    Route::get('/reconciliation-report', [ReportController::class, 'index'])->name('reconciliation.report.index');
    Route::get('/wfs-storage-fee', [ReportController::class, 'storageFee'])->name('reconciliation.report.storage-fee');
    Route::get('/walmart-shipping-label-service-charge', [ReportController::class, 'shippingLabelServiceCharge'])->name('reconciliation.report.shipping-label-service-charge');
    Route::get('/wfs-lost-inventory', [ReportController::class, 'wfsLostInventory'])->name('reconciliation.report.wfs-lost-inventory');
    Route::get('/wfs-found-inventory', [ReportController::class, 'wfsFoundInventory'])->name('reconciliation.report.wfs-found-inventory');
    Route::get('/wfs-inbound-transportation-fee', [ReportController::class, 'wfsInboundTransportationFee'])->name('reconciliation.report.wfs-inbound-transportation-fee');
    Route::get('/wfs-rc-inventory-disposal-fee', [ReportController::class, 'wfsRCInventoryDisposalFee'])->name('reconciliation.report.wfs-rc-inventory-disposal-fee');
    Route::get('/deposit-hyperwallet-account', [ReportController::class, 'depositHyperwalletAccount'])->name('reconciliation.report.deposit-hyperwallet-account');
    Route::get('/wfs-refund', [ReportController::class, 'wfsRefund'])->name('reconciliation.report.wfs-refund');
    Route::get('/walmart-product-advertising', [ReportController::class, 'walmartProductAdvertising'])->name('reconciliation.report.walmart-product-advertising');
    Route::get('/sales-report-by-state', [ReportController::class, 'SalesReportByState'])->name('reconciliation.report.sales-report-by-state');
    Route::get('/montly-report', [ReportController::class, 'monthlyReport'])->name('reconciliation.report.montly-report');
    Route::get('/inventory-valuation-report', [ReportController::class, 'inventoryValuationReport'])->name('reconciliation.report.inventory-valuation-report');
    //cron jobs
    Route::get('/walmart-item-cron', [WalmartItemCronController::class, 'fetchWalmartItems'])->name('walmart.item.cron');
});
