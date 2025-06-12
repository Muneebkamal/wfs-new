@extends('layouts.app')

@section('title', 'Create Location')

@section('content')
 <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Create Location</h4>
                <form method="POST" action="{{ route('locations.store') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Location Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Suffix</label>
                            <input type="text" name="suffix" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Company</label>
                            <input type="text" name="company" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="emails" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Mobile</label>
                            <input type="text" name="mobile" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Fax</label>
                            <input type="text" name="fax" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Website</label>
                            <input type="url" name="website" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Street</label>
                            <input type="text" name="street" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Zip</label>
                            <input type="text" name="zip" class="form-control">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" class="form-control">
                        </div>
                    </div>

                    <div class="mt-4 float-end">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('locations.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection
@section('scripts')
<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @elseif(session('error'))
        toastr.error("{{ session('error') }}");
    @elseif(session('info'))
        toastr.info("{{ session('info') }}");
    @elseif(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
@endsection
