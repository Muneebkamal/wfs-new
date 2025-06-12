@extends('layouts.app')

@section('title', 'Vendors')

@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Payment Terms List</h4>
            <button class="btn btn-primary" >
              <a href="{{ route('vendors.create') }}" class="text-white"> Create Vendor</a>
            </button>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered" id="vendorsTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Vendor Alias</th>
                <th>Address</th>
                <th>Address 2</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Zipcode</th>
                <th>Phone</th>
                <th>Contact Name</th>
                <th>Contact Email</th>
                <th>Order Method</th>
                <th>Map</th>
                <th>Notes</th>
                <th>Payment Terms</th>
                <th>Default Currency</th>
                <th>Action</th>
              </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function(){
    var table = $('#vendorsTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('vendors.index') }}",
      columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'name', name: 'name' },
          { data: 'vendor_alias', name: 'vendor_alias' },
          { data: 'address', name: 'address' },
          { data: 'address1', name: 'address1' },
          { data: 'city', name: 'city' },
          { data: 'state', name: 'state' },
          { data: 'country', name: 'country' },
          { data: 'zip_code', name: 'zip_code' },
          { data: 'phone', name: 'phone' },
          { data: 'contact_name', name: 'contact_name' },
          { data: 'contact_email', name: 'contact_email' },
          { data: 'order_method', name: 'order_method' },
          { data: 'map', name: 'map', orderable: false, searchable: false },
          { data: 'notes', name: 'notes' },
          { data: 'payment_terms', name: 'payment_terms' },
          { data: 'currecncy', name: 'currecncy' },
          { data: 'action', name: 'action', orderable: false, searchable: false }
      ]
    });
  })
</script>
@endsection
