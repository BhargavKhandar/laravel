<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Usercontroller extends Controller
{
    public function list()
    {
        $data['users'] = User::select('users.*', 'roles.name as role_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->orderBy('users.id', 'desc')
            ->get();
        return view('panel.user.list', $data);
    }

    public function create()
    {
        $data['roles'] = Role::get();
        return view('panel.user.create', $data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->name = !empty($request->name) ? $request->name : null;
        $user->email = !empty($request->email) ? $request->email : null;
        $user->password = !empty($request->password) ? Hash::make($request->password) : null;
        $user->role_id = !empty($request->role_id) ? $request->role_id : null;
        // dd($user);
        $user->save();
        return redirect()->route('user')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['roles'] = Role::get();
        return view('panel.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::where('id', $id)->first();
        $user->name = !empty($request->name) ? $request->name : null;
        $user->email = !empty($request->email) ? $request->email : null;
        $user->role_id = !empty($request->role_id) ? $request->role_id : null;
        // dd($user);
        $user->save();
        return redirect()->route('user')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user')->with('success', 'User deleted successfully.');
    }
}
