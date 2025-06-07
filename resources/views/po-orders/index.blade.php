@extends('layouts.app')

@section('title', 'PO Orders List')

@section('content')
<div class="row">
    <div class="col-md-12 d-flex justify-content-between mb-3">
        <h5 class="m-0">
            PO Orders ()
        </h5>
        <div class="d-flex align-items-center">
            <a href="#" class="btn btn-sm btn-primary me-2">Show Hidden Items</a>
            <a class="btn btn-sm btn-primary" href="#"><i class="fas fa-plus"></i> Add PO Order</a>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="tabe-responsive">
                    <table id="po-order-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CREATED BY</th>
                                <th>COMPANY NAME</th>
                                <th>LOCATION NAME</th>
                                <th>SHIP VIA</th>
                                <th>PURCHASE ORDER DATE</th>
                                <th>ORDER UNITS</th>
                                <th>TOTAL COST</th>
                                <th>PO AMOUNT</th>
                                <th>AMOUNT PAID</th>
                                <th>DIFFERENCE</th>
                                <th>ACTION</th>
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
    $("#po-order-table").dataTable();
</script>
@endsection