<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;
use Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::get();
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',  // Removed 'nullable'
            'profile_img' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',  // Optional image field
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->hasFile('profile_img')) {
            // Get the file from the request
            // $file = $request->file('profile_img');

            // // Define the folder where the file will be stored (public/document)
            // $destinationPath = 'document'; // This is the 'public/document' folder

            // // Create a unique file name using the current timestamp and the original file extension
            // $fileName = time() . '.' . $file->getClientOriginalExtension();

            // // Move the uploaded file to the 'public/document' directory
            // $file->move(public_path($destinationPath), $fileName);

            // // Save the file path to the user profile_img field
            // $user->profile_img = $destinationPath . '/' . $fileName;

            // Store image in Amazone Aws s3 storage
            $file = request('profile_img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Log::info('profile_img');
            $filePath = 'images/' . $filename;
            $path = Storage::disk('s3')->put($filePath, file_get_contents($file));
            $path = Storage::disk('s3')->url($filePath);

            $file_url = $path;
            // return $file_url;
            $user->profile_img = $filePath;
        }
        // dd($user);
        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = User::find($id);
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'profile_img' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',  // Optional
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_img')) {
            Log::info('profile_img');

            // Get the file from the request
            $file = $request->file('profile_img');

            // Define the storage folder (images or documents depending on file type)
            $destinationPath = 'document'; // This will be 'public/uploads'

            // Create a unique file name using the current timestamp and the original file extension
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            // Move the uploaded file to the 'public/uploads' directory
            $file->move(public_path($destinationPath), $fileName);

            // Delete the old profile image or PDF if it exists
            if ($user->profile_img && file_exists(public_path($user->profile_img))) {
                unlink(public_path($user->profile_img));
            }

            // Save the file path to the user profile_img field
            $user->profile_img = $destinationPath . '/' . $fileName;
        }

        $user->save();
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user->profile_img && file_exists(public_path($user->profile_img))) {
            unlink(public_path($user->profile_img));
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
