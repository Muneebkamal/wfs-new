@extends('layouts.app')

@section('title', 'Deposited in HYPERWALLET Account')

@section('content')
<div class="">
    <h5 class="m-0">Deposited in HYPERWALLET Account</h5>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form>
                    @csrf
                    
                    <div class="row align-items-end">
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
                <table id="deposit_hyperwallet_account" class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Period Start Date</th>
                        <th>Period End Date</th>
                        <th>Transaction Description</th>
                        <th>Amount</th>
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
    $('#deposit_hyperwallet_account').dataTable();
</script>
@endsection