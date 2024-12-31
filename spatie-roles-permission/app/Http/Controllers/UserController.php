<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:View user', only: ['index']),
            new Middleware('permission:Create user', only: ['create']),
            new Middleware('permission:Edit user', only: ['edit']),
            // new Middleware('permission:Delete user', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::latest()->paginate(10);
        return view('user.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = Role::orderBy('name', 'ASC')->get();
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|unique:users,email|min:5|max:255',
            'password' => 'required|min:6|max:20|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = !empty($request->name) ? $request->name : null;
        $user->email = !empty($request->email) ? $request->email : null;
        $user->password = !empty($request->password) ? Hash::make($request->password) : null;
        // dd($request->role);
        $user->save();

        if (!empty($request->role)) {
            $user->assignRole($request->role); // Use assignRole method
        }

        return redirect()->route('user')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = User::find($id);
        $data['roles'] = Role::orderBy('name', 'ASC')->get();
        $data['hasroles'] = $data['user']->roles->pluck('id');
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->name = !empty($request->name) ? $request->name : null;
        $user->email = !empty($request->email) ? $request->email : null;
        $user->save();

        if (!empty($request->role)) {
            $user->syncRoles($request->role);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('user')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('user')->with('success', 'User deleted successfully');
    }
}
