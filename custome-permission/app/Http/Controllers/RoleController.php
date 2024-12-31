<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Permissioncontroller;

class Rolecontroller extends Controller
{
    public function list()
    {
        $PermissionRole = Permissioncontroller::getpermission('roles', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return redirect()->route('panel.dashboard')->with('error', "You don't have a permission");
        }
        $data['PermissionAddRole'] = Permissioncontroller::getpermission('create-roles', Auth::user()->role_id);
        $data['PermissionEditRole'] = Permissioncontroller::getpermission('edit-roles', Auth::user()->role_id);
        $data['PermissionDeleteRole'] = Permissioncontroller::getpermission('delete-roles', Auth::user()->role_id);

        $data['roles'] = Role::get();
        return view('panel.role.list', $data);
    }

    public function create()
    {
        $PermissionAddRole = Permissioncontroller::getpermission('create-roles', Auth::user()->role_id);
        if (empty($PermissionAddRole)) {
            return redirect()->route('panel.dashboard')->with('error', "You don't have a permission");
        }
        $permission = $this->getPermission();
        $data['permissions'] = $permission;
        return view('panel.role.create', $data);
    }

    public function getPermission()
    {
        $permissions = Permission::get()->groupBy('groupby');
        $result = [];
        foreach ($permissions as $group => $permission) {
            $getPrmissionGroup = $this->getPermissionGroup($group);
            $data = [];
            $data['id'] = $permission->first()->id;
            $data['name'] = $permission->first()->name;
            $group = [];
            foreach ($getPrmissionGroup as $groupvalue) {
                $groupData = [];
                $groupData['id'] = $groupvalue->id;
                $groupData['name'] = $groupvalue->name;
                $group[] = $groupData;
            }
            $data['groups'] = $group;
            $result[] = $data;
        }
        return $result;
    }

    static public function getPermissionGroup($groupby)
    {
        $permission = Permission::where('groupby', $groupby)->get();
        return $permission;
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $role = new Role();
        $role->name = !empty($request->name) ? $request->name : 'user';
        $role->save();

        $this->createPermissionRole($request->permission_id, $role->id);

        return redirect()->route('role')->with('success', 'Role created successfully.');
    }

    static public function createPermissionRole($permission_ids, $role_id)
    {
        PermissionRole::where('role_id', $role_id)->delete();

        foreach ($permission_ids as $permission_id) {
            $permission_role = new PermissionRole();
            $permission_role->permission_id = $permission_id;
            $permission_role->role_id = $role_id;
            $permission_role->save();
        }
    }

    public function edit($id)
    {
        $PermissionEditRole = Permissioncontroller::getpermission('edit-roles', Auth::user()->role_id);
        if (empty($PermissionEditRole)) {
            return redirect()->route('panel.dashboard')->with('error', "You don't have a permission");
        }
        $role = Role::where('id', $id)->first();
        $permissions = $this->getPermission();
        $permission_roles = PermissionRole::where('role_id', $id)->get();
        $data['role'] = $role;
        $data['permissions'] = $permissions;
        $data['permission_roles'] = $permission_roles;
        return view('panel.role.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $role = Role::where('id', $id)->first();
        $role->name = !empty($request->name) ? $request->name : 'user';
        $role->save();

        $this->createPermissionRole($request->permission_id, $role->id);

        return redirect()->route('role')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $PermissionDeleteRole = Permissioncontroller::getpermission('delete-roles', Auth::user()->role_id);
        if (empty($PermissionDeleteRole)) {
            return redirect()->route('panel.dashboard')->with('error', "You don't have a permission");
        }
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('role')->with('success', 'Role deleted successfully.');
    }
}
