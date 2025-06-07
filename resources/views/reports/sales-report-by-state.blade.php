@extends('layouts.app')

@section('title', 'Sales Report by State')

@section('content')
<div class="d-flex justify-content-between">
    <h5 class="m-0">Sales Report by State</h5>
    <a href="#" class="btn btn-sm btn-primary">Download CSV</a>
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

            <div class="col-md-12 table-responsive mt-3">
                <table id="sales_report_by_state" class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Shipping State</th>
                        <th>Orders Count</th>
                        <th>Products Count</th>
                        <th>Total Charge Amount</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('#sales_report_by_state').dataTable();
</script>
@endsection