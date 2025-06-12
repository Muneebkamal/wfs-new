@extends('layouts.app')

@section('title', 'Locations')

@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Locations List</h4>
            <button class="btn btn-primary" >
              <a href="{{ url('locations/create') }}" class="text-white">  Create Location</a>
            </button>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table table-bordered" id="location-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Location Name</th>
                    <th>Title</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Suffix</th>
                    <th>Company</th>
                    <th>Emails</th>
                    <th>Phone</th>
                    <th>Mobile</th>
                    <th>Fax</th>
                    <th>Website</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#location-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('locations.data') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'title', name: 'title' },
                { data: 'first_name', name: 'first_name' },
                { data: 'middle_name', name: 'middle_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'suffix', name: 'suffix' },
                { data: 'company', name: 'company' },
                { data: 'emails', name: 'emails' },
                { data: 'phone', name: 'phone' },
                { data: 'mobile', name: 'mobile' },
                { data: 'fax', name: 'fax' },
                { data: 'website', name: 'website' },
                { data: 'street', name: 'street' },
                { data: 'city', name: 'city' },
                { data: 'state', name: 'state' },
                { data: 'zip', name: 'zip' },
                { data: 'country', name: 'country' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });

</script>
@endsection
