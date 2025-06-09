@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">WFS Global Settings</h3>
            <form method="post" enctype="multipart/form-data" id="wfs-settings-form">
                @csrf
                <div class="row align-items-end g-3">
                    <div class="col-md-4">
                        <label for="posts_per_page" class="form-label">Posts Per Page</label>
                        <select name="posts_per_page" id="posts_per_page" class="form-select">
                           <option value="10" {{ $settings['posts_per_page'] == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $settings['posts_per_page'] == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $settings['posts_per_page'] == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $settings['posts_per_page'] == 100 ? 'selected' : '' }}>100</option>
                            <option value="200" {{ $settings['posts_per_page'] == 200 ? 'selected' : '' }}>200</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#wfs-settings-form').on('submit', function (e) {
            e.preventDefault(); // Prevent normal form submission
            let formData = new FormData(this);
            $.ajax({
                url: '{{ route("settings.store") }}', // Adjust this to your route
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Show a success message or reload
                    showToast('success', 'Settings saved successfully!');
                },
                error: function (xhr) {
                    // Handle error (validation, server error, etc.)
                    alert('An error occurred while saving settings.');
                }
            });
        });
    });
</script>
@endsection