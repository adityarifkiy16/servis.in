<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arr['roles'] = Role::with('permissions')->orderBy('name')->paginate(10);
        return view('role.index', $arr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $arr['permissions'] = Permission::all()->groupBy(function ($item) {
            return explode('_', $item->name)[1];
        });

        // dd($arr);
        return view('role.create', $arr);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'permissions' => 'required|array|min:1',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions);
        return redirect()->back()->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $arr['role'] = $role;
        $arr['permissions'] = Permission::all()->groupBy(function ($item) {
            return explode('_', $item->name)[1];
        });
        return view('role.edit', $arr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array|min:1',
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $roleUser = $role->users;
        if ($roleUser->count() > 0) {
            return redirect()->back()->with('error', 'Role cannot be deleted because it has users.');
        }
        $role->permissions()->detach();
        $role->update([
            'name' => $role->name . ' (deleted ' . now()->format('Y-m-d H:i:s') . ')',
        ]);
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully.');
    }
}
