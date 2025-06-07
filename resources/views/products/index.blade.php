@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h4>Products ()</h4>

        <div class="card">
            <div class="card-body">
                <div class="row align-items-center mb-3">
                    <div class="col-md-12 text-end">
                        <button class="btn btn-sm btn-primary">Download CSV</button>
                    </div>
                </div>

                <form>
                    <div class="row align-items-end">
                        <div class="col-md-2"> 
                            <label>Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="">Select Fullfilled</option>
                                <option value="SellerFulfilled">SellerFulfilled</option>
                                <option value="WFSFulfilled">WFSFulfilled</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>SKU</label>
                            <input type="text" name="sku" class="form-control form-control-sm" placeholder="Enter SKU">
                        </div>
                        <div class="col-md-2">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control form-control-sm" placeholder="Enter Product Name">
                        </div>
                        @php
                            $start_date = date('Y-m-d');
                            $end_date = date('Y-m-d');
                        @endphp
                        <div class="col-md-2"> 
                            <label>Date</label>
                            <input type="hidden" name="date_range" id="date_range" value="{{ $start_date . '_' . $end_date }}">

                            <div id="reportrange" class="form-control form-control-sm d-flex align-items-center justify-content-between" style="cursor: pointer;">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span>{{ \Carbon\Carbon::parse($start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('F j, Y') }}</span>
                                <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary m-1">Apply</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-5">
                    <table id="products_table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Product Name</th>
                                <th>WPID</th>
                                <th>Quantity</th>
                                <th>Charge Amount</th>
                                <th>Shipping Customer</th>
                                <th>Product Price</th>
                                <th>Tax</th>
                                <th>Walmart Fees</th>
                                <th>Shipping Cost</th>
                                <th>Profit</th>
                                <th>Profit %</th>
                                <th>ROI</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#products_table').dataTable();
</script>
@endsection