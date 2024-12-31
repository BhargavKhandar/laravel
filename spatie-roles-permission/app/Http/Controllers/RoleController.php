<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:View role', only: ['index']),
            new Middleware('permission:Create role', only: ['create']),
            new Middleware('permission:Edit role', only: ['edit']),
            new Middleware('permission:Delete role', only: ['destroy']),
        ];
    }
    // This methos will show the roles page
    public function index()
    {
        $data['roles'] = Role::orderBy('name', 'ASC')->paginate(10);
        return view('role.list', $data);
    }
    // This method will show the create role page
    public function create()
    {
        $data['permissions'] = Permission::orderBy('name', 'ASC')->get();
        return view('role.create', $data);
    }
    // This method will handle the role submission
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role = new Role();
        $role->name = !empty($request->name) ? $request->name : null;
        $role->save();

        if (!empty($request->permissions)) {
            foreach ($request->permissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('admin.role')->with('success', 'Role created successfully');
    }
    // This method will show the edit role page
    public function edit($id)
    {
        $data['role'] = Role::where('id', $id)->first();
        $data['has_permissions'] = $data['role']->permissions->pluck('name');
        $data['permissions'] = Permission::orderBy('name', 'ASC')->get();
        // dd($data);
        return view('role.edit', $data);
    }
    // This method will handle the role update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . ',id|min:3|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role = Role::where('id', $id)->first();
        $role->name = !empty($request->name) ? $request->name : null;
        $role->save();

        if (!empty($request->permissions)) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('admin.role')->with('success', 'Role updated successfully');
    }
    // This method will delete the role
    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('admin.role')->with('error', 'Role not found');
        }
        $role->delete();

        return redirect()->route('admin.role')->with('success', 'Role deleted successfully');
    }
}
