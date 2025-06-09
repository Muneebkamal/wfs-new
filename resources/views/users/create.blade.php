@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Create User</h4>
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="card-body row g-3">

                <div class="col-md-6">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="role_id" class="form-label">Type</label>
                    <select name="role_id" class="form-select" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->name == 'Employee'?'selected':'' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Active Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

            </div>

            <div class="card-body border-top pt-4">
                <h5>Permissions</h5>
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm-{{ $permission->id }}">
                                <label class="form-check-label" for="perm-{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Create User</button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection