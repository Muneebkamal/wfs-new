@extends('layouts.app')

@section('title', 'Reconciliation Reports')

@section('content')
<div class="">
    <h5 class="m-0">Reconciliation Reports ()</h5>
    <a href="#" class="btn btn-sm btn-primary">Upload Reconciliation Files</a>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 text-end">
                <button class="btn btn-sm btn-secondary">Reconcilation Avail Dates</button>
            </div>
            <div class="col-md-12">
                <form>
                    @csrf
                    
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label>Order ID</label>
                            <input type="text" name="order_id" class="form-control-sm form-control" placeholder="Enter Customer Order ID" value="">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary">Apply</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12 table-responsive mt-3">
                <table id="reconciliation_report" class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Amount Type</th>
                        <th>Customer Order</th>
                        <th>Transaction Type</th>
                        <th>Transaction Posted Time</th>
                        <th>Transaction Description</th>
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
    $('#reconciliation_report').dataTable();
</script>
@endsection