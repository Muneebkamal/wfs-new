@extends('layouts.app')

@section('title', 'Inventory Valuation Report')

@section('content')
<div class="d-flex justify-content-between">
    <h5 class="m-0">Inventory Valuation Report</h5>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form>
                    @csrf
                    
                    <div class="row align-items-end">
                        <div class="col-md-3"> 
                            <label>SKU</label>
                            <input type="text" id="sku" name="sku" class="form-control-sm form-control" placeholder="SKU">
                        </div>
                        <div class="col-md-3"> 
                            <label>Product Name</label>
                            <input type="text" class="form-control-sm form-control" name="product_name" id="product_name" placeholder="Product Name">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary">Apply</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12 table-responsive mt-3">
                <table id="inventory_valuation_report" class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>SKU</th>
                        <th>WFS Avail to Sale Qty</th>
                        <th>WFS On Hand Qty</th>
                        <th>Product Price</th>
                        <th>Total</th>
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
    $('#inventory_valuation_report').dataTable();
</script>
@endsection