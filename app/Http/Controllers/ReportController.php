<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reports.reconciliation-reports.index');
    }

    public function storageFee()
    {
        return view('reports.reconciliation-reports.wfs-storage-fee');
    }

    public function shippingLabelServiceCharge()
    {
        return view('reports.reconciliation-reports.walmart-shipping-label-service-charge');
    }

    public function wfsLostInventory()
    {
        return view('reports.reconciliation-reports.wfs-lost-inventory');
    }

    public function wfsFoundInventory()
    {
        return view('reports.reconciliation-reports.wfs-found-inventory');
    }

    public function wfsInboundTransportationFee()
    {
        return view('reports.reconciliation-reports.wfs-inbound-transportation-fee');
    }

    public function wfsRCInventoryDisposalFee()
    {
        return view('reports.reconciliation-reports.wfs-rc-inventory-disposal-fee');
    }
    
    public function depositHyperwalletAccount()
    {
        return view('reports.reconciliation-reports.deposit-hyperwallet-account');
    }

    public function wfsRefund()
    {
        return view('reports.reconciliation-reports.wfs-refund');
    }

    public function walmartProductAdvertising()
    {
        return view('reports.reconciliation-reports.walmart-product-advertising');
    }

    public function SalesReportByState()
    {
        return view('reports.sales-report-by-state');
    }

    public function monthlyReport()
    {
        return view('reports.monthly-report');
    }

    public function inventoryValuationReport()
    {
        return view('reports.inventory-valuation-report');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
