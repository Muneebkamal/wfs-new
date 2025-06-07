@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex">
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" value="" id="seller-fulfilled" checked />
                    <label class="form-check-label" for="seller-fulfilled"> Seller Fulfilled </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="wfs-fulfilled" checked />
                    <label class="form-check-label" for="wfs-fulfilled"> WFS Fulfilled </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>DATE</th>
                                    <th>SALES</th>
                                    <th>ORDERS</th>
                                    <th>UNITS</th>
                                    <th>REFUNDS</th>
                                    <th>SELLER FULFILLED</th>
                                    <th>WFS FULFILLED</th>
                                    <th>GROSS PROFIT</th>
                                    <th>NET PROFIT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#">Today</a>
                                    </td>
                                    <td>06-01-2025</td>
                                    <td>$0.00</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>$0.00</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>$0.00</td>
                                    <td>$0.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">Yesterday</a>
                                    </td>
                                    <td>05-31-2025</td>
                                    <td>$0.00</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>$0.00</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>$0.00</td>
                                    <td>$0.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">This Month</a>
                                    </td>
                                    <td>Jun-2025</td>
                                    <td>$0.00</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>$0.00</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>$0.00</td>
                                    <td>$0.00</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#">Last Month</a>
                                    </td>
                                    <td>May-2025</td>
                                    <td>$0.00</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>$0.00</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>$0.00</td>
                                    <td>$0.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12 mt-4">
            <div class="nav-align-top">
                <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                    <li class="nav-item mb-1 mb-sm-0">
                    <button
                        type="button"
                        class="nav-link active"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-products"
                        aria-controls="navs-pills-justified-products"
                        aria-selected="true">
                        <span class="d-none d-sm-inline-flex align-items-center">
                        <i class="icon-base ti tabler-package ti-xs me-1 icon-sm me-1_5"></i>Products
                        </span>
                        <i class="icon-base ti tabler-package icon-sm d-sm-none"></i>
                    </button>
                    </li>
                    <li class="nav-item mb-1 mb-sm-0">
                    <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-orders"
                        aria-controls="navs-pills-justified-orders"
                        aria-selected="false">
                        <span class="d-none d-sm-inline-flex align-items-center"
                        ><i class="icon-base ti tabler-shopping-cart icon-sm me-1_5"></i>Orders</span
                        >
                        <i class="icon-base ti tabler-shopping-cart icon-sm d-sm-none"></i>
                    </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-justified-products" role="tabpanel">
                        <form action="">
                            <div class="row align-items-end">
                                <div class="col-md-12">
                                    <h5>Products (Date)</h5>
                                </div>
                                <div class="col-md-3">
                                    <label for="sku">SKU</label>
                                    <input type="text" id="sku" name="sku" class="form-control form-control-sm" placeholder="Enter SKU">
                                </div>
                                <div class="col-md-3">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" id="product_name" name="product_name" class="form-control form-control-sm" placeholder="Enter Product Name" value="">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-sm btn-primary">Apply</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive mt-5">
                            <table id="dashboard_products_table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>SKU</th>
                                        <th>Product Name</th>
                                        <th>WPID</th>
                                        <th>Quantity</th>
                                        <th>Avail to Sale</th>
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
                    <div class="tab-pane fade" id="navs-pills-justified-orders" role="tabpanel">
                        <form action="">
                            <div class="row align-items-end">
                                <div class="col-md-12">
                                    <h5>Orders (Date)</h5>
                                </div>
                                <div class="col-md-3">
                                    <label for="product_name">Order ID</label>
                                    <input type="text" id="order_id" name="product_name" class="form-control form-control-sm" placeholder="Enter Customer Order ID" value="">
                                </div>
                                <div class="col-md-3">
                                    <label for="sku">SKU</label>
                                    <input type="text" id="sku" name="sku" class="form-control form-control-sm" placeholder="Enter SKU">
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-sm btn-primary">Apply</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive mt-5">
                            <table id="dashboard_orders_table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Order ID</th>
                                        <th>SKU</th>
                                        <th>Product Name</th>
                                        <th>WPID</th>
                                        <th>Quantity</th>
                                        <th>Refund</th>
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
    </div>
@endsection

@section('scripts')
<script>
    $('#dashboard_products_table').dataTable();
    $('#dashboard_orders_table').dataTable();
</script>
@endsection