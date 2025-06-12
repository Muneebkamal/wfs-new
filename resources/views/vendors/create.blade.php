@extends('layouts.app')

@section('title', 'Vendors')

@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h4>Add Vendor</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('vendors.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Company Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $vendor->name ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>Vendor Alias</label>
                        <input type="text" name="vendor_alias" class="form-control" value="{{ old('vendor_alias', $vendor->vendor_alias ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $vendor->address ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>Address 2</label>
                        <input type="text" name="address1" class="form-control" value="{{ old('address1', $vendor->address1 ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city', $vendor->city ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>State</label>
                        <input type="text" name="state" class="form-control" value="{{ old('state', $vendor->state ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control" value="{{ old('country', $vendor->country ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>Zip Code</label>
                        <input type="text" name="zip_code" class="form-control" value="{{ old('zip_code', $vendor->zip_code ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>Contact Name</label>
                        <input type="text" name="contact_name" class="form-control" value="{{ old('contact_name', $vendor->contact_name ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>Contact Email</label>
                        <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $vendor->contact_email ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label>Other Method</label>
                        <input type="text" name="other_method" class="form-control" value="{{ old('other_method', $vendor->other_method ?? '') }}">
                    </div>

                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check mt-4">
                            <input type="checkbox" class="form-check-input" name="map" value="1" id="mapCheckbox" {{ old('map', $vendor->map ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="mapCheckbox">Map</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>Payment Terms</label>
                        <select name="paymet_term" class="form-select">
                        @foreach ( $paymetTerms as $term)
                        <option value="{{ $term->name }}" {{ old('paymet_term', $vendor->paymet_term ?? '') == $term->name ? 'selected' : '' }}>
                            {{ $term->name }}
                            </option>
                        @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Currency</label>
                        <select name="currecncy" class="form-select">
                            <option value="USD" {{ old('currecncy', $vendor->currecncy ?? '') === 'USD' ? 'selected' : '' }}>USD</option>
                            <!-- Add more currencies here if needed -->
                        </select>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection