@extends('layouts.app')

@section('title', 'Monthly Reports')

@section('content')
<div class="d-flex justify-content-between">
    <h5 class="m-0">Monthly Reports</h5>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form>
                    @csrf
                    
                    <div class="row align-items-end">
                        <div class="col-md-3"> 
                            <label>Status</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="">Select Fullfilled</option>
                                <option value="SellerFulfilled">SellerFulfilled</option>
                                <option value="WFSFulfilled">WFSFulfilled</option>
                            </select>
                        </div>
                        @php
                            $start_date = date('Y-m-d');
                            $end_date = date('Y-m-d');
                        @endphp
                        <div class="col-md-3"> 
                            <label>Date</label>
                            <input type="hidden" name="date_range" id="date_range" value="{{ $start_date . '_' . $end_date }}">

                            <div id="reportrange" class="form-control form-control-sm d-flex align-items-center justify-content-between" style="cursor: pointer;">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span>{{ \Carbon\Carbon::parse($start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('F j, Y') }}</span>
                                <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary">Apply</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12 table-responsive mt-5">
                <table id="monthly_report" class="table table-striped">
                    <thead>
                        <th>Month</th>
                        <th>Total Orders</th>
                        <th>Quantity</th>
                        <th>Charge Amount</th>
                        <th>Shipping Customer</th>
                        <th>Product Price</th>
                        <th>Tax</th>
                        <th>Walmart Fees</th>
                        <th>Shipping Cost</th>
                        <th>Profit</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection