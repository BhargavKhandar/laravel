<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adduser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'age' => 'required|numeric|min:18',
                'city' => 'required',
            ],
            [], // Custom error messages would go here if you had any.
            [
                // This method use in the laravel inbuilt msg is same but the attributes are changed
                'name' => 'User Name',
                'email' => 'User Email Address',
                'age' => 'User Age',
                'city' => 'User city'
            ]
        );

        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return redirect()->route('user.create')->with('error', 'User with this email already exists!');
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->city = $request->city;

        $insert_user = $user->save();

        if ($insert_user) {
            return redirect()->route('user.index')->with('success', 'New user added successfully.');
        } else {
            return redirect()->route('user.create')->with('error', 'User not added!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::find($id);
        return view('viewuser', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        return view('updateuser', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $email)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'age' => 'required|numeric|min:18',
                'city' => 'required',
            ],
            [], // Custom error messages would go here if you had any.
            [
                // This method use in the laravel inbuilt msg is same but the attributes are changed
                'name' => 'User Name',
                'email' => 'User Email Address',
                'age' => 'User Age',
                'city' => 'User city'
            ]
        );

        // First method to update data with Eloquent
        // $update_users = User::where('email', '=', $email)->limit(1)->get();
        $update_users = User::where('email', '=', $email)->first();
        // return $update_users;

        // This first Eloqunt method are two update data method
        // First method
        $update_users->name = $request->name;
        $update_users->email = $request->email;
        $update_users->age = $request->age;
        $update_users->city = $request->city;

        // $update_users[0]->save();
        $updated = $update_users->save();

        // Second method
        // foreach ($update_users as $update_user)
        // {
        //     $update_users->name = $request->name;
        //     $update_users->email = $request->email;
        //     $update_users->age = $request->age;
        //     $update_users->city = $request->city;

        //     $update_users->save();
        // }

        // return $update_users;

        // Second method to update data Eloquent
        // $update_user = User::where('id', $id)
        //                     ->update([
        //                         'name' => $request->name,
        //                         'email' => $request->email,
        //                         'age' => $request->age,
        //                         'city' => $request->city
        //                     ]);

        if ($updated) {
            return redirect()->route('user.index')->with('success', 'User update successfully.');
        } else {
            return redirect()->route('user.edit')->with('error', 'User not updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        // Check if the user actually exists
        if ($user == true) {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('user.index')->with('error', 'User not found.');
        }
    }

}
