<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware(['permission:role-create|role-edit|role-delete'], ["only" => "index", "show"]);
        $this->middleware(['permission:role-create'], ["only" => "create", "store"]);
        $this->middleware(['permission:role-edit'], ["only" => "edit", "update"]);
        $this->middleware(['permission:role-delete'], ["only" => "destory"]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'permission' => 'array',
        ]);
        $role = Role::create(['name' => $request->name]);
        if ($request->permission) {
            $role->syncPermissions($request->permission);
        }
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('roles.index')->with('error', 'Role not found.');
        }
        $permissions = $role->permissions;
        return view('role.show', compact('role', 'permissions'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        //
        $request->validate([
            // |unique:roles,name,
            'name' => 'required|string|max:255' . $id,
            'permission' => 'array',
        ]);
        $role = Role::find($id);
        $role->name = $request->name;
        if ($request->permission) {
            $role->syncPermissions($request->permission);
        }
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        }
        return redirect()->route('roles.index')->with('error', 'Role not found.');
    }
}
