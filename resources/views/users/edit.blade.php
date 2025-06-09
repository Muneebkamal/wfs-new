@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="row">
    <div class="col-md-12">
         <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Edit User</h4>
            <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="full_name">Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $user->full_name) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name">Username</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password">Password <small>(Leave blank if not changing)</small></label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="role_id">Role</label>
                        <select name="role_id" class="form-control">
                            @foreach($roles as $id => $roleName)
                                <option value="{{ $id }}" {{ $user->role_id == $id ? 'selected' : '' }}>
                                    {{ $roleName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12 mb-2">
                        <label>Permissions</label>
                    </div>

                    @foreach($permissions as $permission)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    id="perm_{{ $permission->id }}"
                                    {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}>
                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection