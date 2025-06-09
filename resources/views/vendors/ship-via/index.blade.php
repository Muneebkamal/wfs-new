@extends('layouts.app')

@section('title', 'Payment Terms')

@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Ship Via</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Create Ship Via
            </button>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table table-bordered" id="ship-via-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="shipViaForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Ship Via</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="ship_via_id">
          <div class="mb-3">
            <label for="ship_via_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="ship_via_name" name="name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
  $(document).ready(function(){
      var table = $('#ship-via-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("ship-via.index") }}', // Adjust to your route
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'name', name: 'name' },
          { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
    $('#shipViaForm').on('submit', function(e) {
      e.preventDefault();

      let formData = {
          id: $('#ship_via_id').val(),
          name: $('#ship_via_name').val(),
          _token: '{{ csrf_token() }}'
      };
      $.ajax({
          url: "{{ route('ship-via.store') }}", // You can use the same route for update if handled in controller
          method: 'POST',
          data: formData,
          success: function(response) {
              $('#createModal').modal('hide');
              $('#shipViaForm')[0].reset();
              table.ajax.reload(); // Reload DataTable with new filter
              // Refresh DataTable or list if you're showing terms
              toastr.success(response.message || 'Saved successfully');
          },
          error: function(xhr) {
              toastr.error('Something went wrong!');
          }
      });
    });
      
  })
  // Handle edit button click
  $(document).on('click', '.editBtn', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    $('#ship_via_id').val(id);
    $('#ship_via_name').val(name);
    $('#createModal').modal('show');
  });
  // Optional: Call this function when editing
  window.editPaymentTerm = function(id, name) {
      $('#ship_via_id').val(id);
      $('#ship_via_name').val(name);
      $('#createModalLabel').text('Update Payment Term');
      $('#createModal').modal('show');
  };
  // Optional: Reset modal when closed
  $('#createModal').on('hidden.bs.modal', function () {
      $('#ship_via_id').val('');
      $('#ship_via_name').val('');
      $('#createModalLabel').text('Create Payment Term');
  });
</script>
@endsection
