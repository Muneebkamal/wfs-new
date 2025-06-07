@extends('layouts.app')

@section('title', 'Po Order Create')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-0 mt-2 mb-2">
    <h5 class="m-0">Adding Products to Order :</h5>
    <a href="#" class="btn btn-sm btn-primary">Go Back to List</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Company Name</label>
                <select class="form-select" name="company_name">
                    <option value="9">Frontier Co-OP</option>
                    <option value="10">Brand Name</option>
                    <option value="11">Rego Trading</option>
                    <option value="12">United Pacific Design</option>
                    <option value="13">JC sale</option>
                    <option value="14">Lee</option>
                    <option value="15">Shepher</option>
                    <option value="16">Universal Wholesale</option>
                    <option value="17">SDA</option>
                    <option value="18">GSM</option>
                    <option value="19">International wholesale</option>
                    <option value="20">MC</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Emails</label>
                <input type="email" class="form-control" name="po_emails">
            </div>
            <div class="col-md-4">
                <label class="form-label">Po Amount</label><br>
                <h5 class="mt-2">$<span id="totalAmount">0.00</span></h5>
            </div>
            <div class="col-md-4">
                <label class="form-label">Mailing Address</label>
                <textarea class="form-control" name="po_mailing_address" rows="1"></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">Location Name</label>
                <select class="form-select" name="location_name">
                    <option value="3">Walmart</option>
                    <option value="2">3320</option>
                    <option value="1">USA</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Purchase Order Date</label>
                <input type="date" class="form-control" name="po_purchase_order_date" value="{{ now()->format('Y-m-d') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Supplier PO</label>
                <input type="text" class="form-control" name="po_supplier_po">
            </div>
            <div class="col-md-4">
                <label class="form-label">Shipping Address</label>
                <textarea class="form-control" name="po_shipping_address" rows="1"></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">Ship via</label>
                <select class="form-select" name="ship_via">
                    <option value="4">Direct to Walmart</option>
                    <option value="3">Truck</option>
                    <option value="2">UPS</option>
                    <option value="1">FedEx</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Amount Paid</label>
                <input type="number" step="0.1" class="form-control" name="amount_paid" value="">
            </div>
            <div class="col-md-4">
                <label class="form-label">Difference</label> <br>
                <h5 class="mt-2">$<span id="totaDifferent">0.00</span></h5>
                <input type="hidden" value="" id="totaDifferentInput" name="totaDifferent">
            </div>
        </div>

        <h5 class="text-primary">Item Details</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th colspan="2">
                        <select class="form-select" name="sku_search" id="sku_search" multiple style="width:300px;">
                        </select>
                    </th>
                    <th>ItemNo</th>
                    <th>Order Units</th>
                    <th>Order Case</th>
                    <th>Case Pack</th>
                    <th>Item Cost</th>
                    <th>Total Cost</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="itemTable">
            </tbody>
        </table>

        <div class="row mt-2 d-flex align-items-end">
            <div class="col-md-6">
            </div>
            <div class="col-md-3" style="border-left:2px ">
                <label for="vendor_message " class="mt-5">Your Message to Vendor</label>
                <textarea rows="4" cols="50" class="form-control" name="vendor_message"></textarea>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <label>Tax</label>
                        <input class="form-control" type="number" step="0.1" name="tax" id="tax">
                    </div>
                    <div class="col-md-12">
                        <label>Shipping Fee</label>
                        <input class="form-control" type="number" step="0.1" name="shipping_fee" id="shipping_fee">
                    </div>
                        <div class="col-md-12">
                        <label>Memo</label>
                        <input class="form-control" type="text" name="memo" id="memo">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection