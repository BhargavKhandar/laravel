<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

// class PermissionController extends Controller implements HasMiddleware
class PermissionController extends BaseController
{
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('permission:View permission', only: ['index']),
    //         new Middleware('permission:Create permission', only: ['create']),
    //         new Middleware('permission:Edit permission', only: ['edit']),
    //         new Middleware('permission:Delete permission', only: ['destroy']),
    //     ];
    // }
    public function __construct()
    {
        // Apply middleware to specific methods
        $this->middleware('permission:View permission', ['only' => ['index']]);
        $this->middleware('permission:Create permission', ['only' => ['create']]);
        $this->middleware('permission:Edit permission', ['only' => ['edit']]);
        $this->middleware('permission:Delete permission', ['only' => ['destroy']]);
    }
    // This methos will show the permissions page
    public function index()
    {
        $data['permissions'] = Permission::orderBy('created_at', 'DESC')->paginate(10);
        return view('permission.list', $data);
    }
    // This method will show the create permission page
    public function create()
    {
        return view('permission.create');
    }
    // This method will handle the permission submission
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $permission = new Permission();
        $permission->name = !empty($request->name) ? $request->name : null;
        $permission->save();

        return redirect()->route('admin.permission')->with('success', 'Permission created successfully');
    }
    // This method will show the edit permission page
    public function edit($id)
    {
        $data['permission'] = Permission::find($id);
        if (!$data['permission']) {
            return redirect()->route('admin.permission')->with('error', 'Permission not found');
        }
        return view('permission.edit', $data);
    }
    // This method will handle the permission update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255|unique:permissions,name,' . $request->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $permission = Permission::where('id', $id)->first();
        $permission->name = !empty($request->name) ? $request->name : null;
        $permission->save();

        return redirect()->route('admin.permission')->with('success', 'Permission updated successfully');
    }
    // This method will delete the permission
    public function destroy($id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            return redirect()->route('admin.permission')->with('error', 'Permission not found');
        }
        $permission->delete();

        return redirect()->route('admin.permission')->with('success', 'Permission deleted successfully');
    }
}
