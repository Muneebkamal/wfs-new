@extends('layouts.app')

@section('title', 'Payment Terms')

@section('content')
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Payment Terms List</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Create Payment Term
            </button>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table table-bordered" id="payment-terms-table">
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
    <form id="paymentTermForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Payment Term</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="payment_term_id">
          <div class="mb-3">
            <label for="payment_term_name" class="form-label">Name</label>
            <input type="text" class="form-control" id="payment_term_name" name="name" required>
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
      var table = $('#payment-terms-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("payment-terms.index") }}', // Adjust to your route
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'name', name: 'name' },
          { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
    $('#paymentTermForm').on('submit', function(e) {
      e.preventDefault();

      let formData = {
          id: $('#payment_term_id').val(),
          name: $('#payment_term_name').val(),
          _token: '{{ csrf_token() }}'
      };
      $.ajax({
          url: "{{ route('payment-terms.store') }}", // You can use the same route for update if handled in controller
          method: 'POST',
          data: formData,
          success: function(response) {
              $('#createModal').modal('hide');
              $('#paymentTermForm')[0].reset();
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
    $('#payment_term_id').val(id);
    $('#payment_term_name').val(name);
    $('#createModal').modal('show');
  });
  // Optional: Call this function when editing
  window.editPaymentTerm = function(id, name) {
      $('#payment_term_id').val(id);
      $('#payment_term_name').val(name);
      $('#createModalLabel').text('Update Payment Term');
      $('#createModal').modal('show');
  };
  // Optional: Reset modal when closed
  $('#createModal').on('hidden.bs.modal', function () {
      $('#payment_term_id').val('');
      $('#payment_term_name').val('');
      $('#createModalLabel').text('Create Payment Term');
  });
</script>
@endsection
