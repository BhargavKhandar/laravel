<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Validator;

class Permissioncontroller extends Controller
{
    public function list()
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
        dd($result);
        return view('panel.permission.list', compact('permissions'));
    }

    public function getPermissionGroup($groupby)
    {
        $permission = Permission::where('groupby', $groupby)->get();
        return $permission;
    }

    public function create()
    {
        return view('panel.permission.create');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $permission = new Permission();
        $permission->name = !empty($request->name) ? $request->name : 'permission';
        $permission->save();
        return redirect()->route('permission')->with('success', 'permission created successfully.');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('panel.permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $permission = Permission::where('id', $id)->first();
        $permission->name = !empty($request->name) ? $request->name : 'permission';
        $permission->save();
        return redirect()->route('permission')->with('success', 'permission updated successfully.');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission')->with('success', 'permission deleted successfully.');
    }

    static public function getpermission($slug, $role_id)
    {
        return PermissionRole::select('permission_role.id')
            ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('permission_role.role_id', $role_id)
            ->where('permissions.slug', $slug)
            ->count();
    }
}
