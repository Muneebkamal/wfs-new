@extends('layouts.app')

@section('title', 'Edit Location')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Edit Location</h4>
                <form method="POST" action="{{ route('locations.update', $location->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Location Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $location->name) }}" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $location->title) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $location->first_name) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $location->middle_name) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $location->last_name) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Suffix</label>
                            <input type="text" name="suffix" class="form-control" value="{{ old('suffix', $location->suffix) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Company</label>
                            <input type="text" name="company" class="form-control" value="{{ old('company', $location->company) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Email</label>
                            <input type="email" name="emails" class="form-control" value="{{ old('email', $location->email) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $location->phone) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Mobile</label>
                            <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $location->mobile) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Fax</label>
                            <input type="text" name="fax" class="form-control" value="{{ old('fax', $location->fax) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Website</label>
                            <input type="url" name="website" class="form-control" value="{{ old('website', $location->website) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Street</label>
                            <input type="text" name="street" class="form-control" value="{{ old('street', $location->street) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="{{ old('city', $location->city) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" value="{{ old('state', $location->state) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Zip</label>
                            <input type="text" name="zip" class="form-control" value="{{ old('zip', $location->zip) }}">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" class="form-control" value="{{ old('country', $location->country) }}">
                        </div>
                    </div>

                    <div class="mt-4 float-end">
                        <button type="submit" class="btn btn-primary">Update</button>
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
