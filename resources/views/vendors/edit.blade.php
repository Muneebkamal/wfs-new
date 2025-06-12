@extends('layouts.app')

@section('title', isset($vendor->id) ? 'Edit Vendor' : 'Add Vendor')

@section('content')
<div class="row">
    <div class="card w-100">
        <div class="card-header">
            <h4>{{ isset($vendor->id) ? 'Edit Vendor' : 'Add Vendor' }}</h4>
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ isset($vendor->id) ? route('vendors.update', $vendor->id) : route('vendors.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($vendor->id))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    @foreach ([
                        'name' => 'Company Name',
                        'vendor_alias' => 'Vendor Alias',
                        'address' => 'Address',
                        'address1' => 'Address 2',
                        'city' => 'City',
                        'state' => 'State',
                        'country' => 'Country',
                        'zip_code' => 'Zip Code',
                        'contact_name' => 'Contact Name',
                        'contact_email' => 'Contact Email',
                        'other_method' => 'Other Method',
                    ] as $field => $label)
                        <div class="col-md-4">
                            <label for="{{ $field }}">{{ $label }}</label>
                            <input type="{{ $field === 'contact_email' ? 'email' : 'text' }}"
                                   name="{{ $field }}"
                                   id="{{ $field }}"
                                   class="form-control @error($field) is-invalid @enderror"
                                   value="{{ old($field, $vendor->$field ?? '') }}">
                            @error($field)
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach

                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-check mt-4">
                            <input type="checkbox" name="map"
                                   id="mapCheckbox"
                                   class="form-check-input @error('map') is-invalid @enderror"
                                   value="1" {{ old('map', $vendor->map ?? false) ? 'checked' : '' }}>
                            <label for="mapCheckbox" class="form-check-label">Map</label>
                            @error('map')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="payment_term">Payment Terms</label>
                        <select name="payment_term"
                                id="payment_term"
                                class="form-select @error('payment_term') is-invalid @enderror">
                            <option value="">Select term...</option>
                            @foreach($paymentTerms as $term)
                                <option value="{{ $term->id }}"
                                    {{ old('payment_term', $vendor->payment_term ?? '') == $term->name ? 'selected' : '' }}>
                                    {{ $term->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_term')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="currency">Currency</label>
                        <select name="currency"
                                id="currency"
                                class="form-select @error('currency') is-invalid @enderror">
                            <option value="USD" {{ old('currency', $vendor->currency ?? '') === 'USD' ? 'selected' : '' }}>USD</option>
                            <!-- Add more currency options as needed -->
                        </select>
                        @error('currency')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($vendor->id) ? 'Update Vendor' : 'Create Vendor' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
