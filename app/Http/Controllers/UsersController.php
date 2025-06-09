<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

use function Ramsey\Uuid\v1;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }
     public function getUsers(Request $request)
    {
        $users = User::where('role_id','!=',1)->with('role'); // eager load roles
        $status = $request->status;
        if ($status !== null && $status !== '') {
            if ($status === 'deleted') {
                $users->onlyTrashed(); // if using soft deletes
            } else {
                $users->where('status', $status);
            }
        }
        return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('full_name', function ($user) {
            // if single role relation
            return $user->full_name ? $user->full_name : 'No Full Name';
        })
        ->addColumn('name', function ($user) {
            // if single role relation
            return $user->name ? $user->name : 'No Name';
        })
        ->addColumn('email', function ($user) {
            // if single role relation
            return $user->email ? $user->email : 'No Email';
        })
        ->addColumn('role', function ($user) {
            // if single role relation
            return $user->role ? $user->role->name : 'No Role';
        })
        ->editColumn('status', function ($user) {
            return $user->status
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>';
        })
        ->addColumn('action', function ($user) {
            $editBtn = '<a href="' . route('users.edit', $user->id) . '" class="btn btn-xs btn-primary me-1">Edit</a>';

            $toggleStatusBtn = $user->status
                ? '<button data-id="' . $user->id . '" class="btn btn-xs btn-danger toggle-status">Make Inactive</button>'
                : '<button data-id="' . $user->id . '" class="btn btn-xs btn-success toggle-status">Make Active</button>';

            return '<div class="d-inline-flex">' . $editBtn . $toggleStatusBtn . '</div>';
        })

        ->rawColumns(['status', 'action'])
        ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('id','!=',1)->get(); // Spatie roles
        $permissions = Permission::all(); // Spatie permissions
        return view('users.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => 1,
        ]);

         if ($request->permissions) {
            // Convert permission IDs to names
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $user->syncPermissions($permissionNames);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all();

        // Get assigned permissions as array of IDs
        $userPermissions = $user->permissions->pluck('id')->toArray();

        return view('users.edit', compact('user', 'roles', 'permissions', 'userPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        // Optional password update
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        if ($request->has('permissions')) {
            $permissionIds = $request->input('permissions'); // IDs

            if (!empty($permissionIds)) {
                // Convert IDs to names
                $permissionNames = \Spatie\Permission\Models\Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

                $user->syncPermissions($permissionNames);
            } else {
                $user->syncPermissions([]); // Clear if empty
            }
        } else {
            $user->syncPermissions([]); // Clear if no permissions submitted
        }

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function toggleStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status; // Toggle status
        $user->save();

        return response()->json(['success' => true, 'status' => $user->status]);
    }
}
