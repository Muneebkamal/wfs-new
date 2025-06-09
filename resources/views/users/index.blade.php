@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h5 class="mb-0">Users</h5>
    </div>
    <div class="col-md-12">
        <div class="card">
           <div class="card-header">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center gap-2">
                    <select id="statusFilter" class="form-select">
                        <option value="">All</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        <option value="deleted">Deleted</option>
                    </select>
                    <button id="applyFilter" class="btn btn-sm btn-secondary">Apply</button>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm  float-end">+ Add User</a>
                </div>
            </div>
                
            </div>

            <div class="card-body">
                <h6 class="mb-3">User List</h6>
                <div class="table-responsive">
                    <table id="users-table" class="table table-bordered table-hover" id="users-table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th style="width: 160px;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
$(document).ready(function() {
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('get.users.data') }}",
            data: function (d) {
                d.status = $('#statusFilter').val(); // send selected status to server
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'full_name', name: 'full_name' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'role', name: 'role' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
    // Toggle status AJAX
    $('#users-table').on('click', '.toggle-status', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: '/users/' + userId + '/toggle-status',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                table.ajax.reload(null, false); // Reload table without resetting paging
            },
            error: function() {
                alert('Something went wrong!');
            }
        });
    });
    $('#applyFilter').on('click', function () {
        table.ajax.reload(); // Reload DataTable with new filter
    });
});

</script>
@endsection