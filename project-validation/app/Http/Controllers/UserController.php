<?php

namespace App\Http\Controllers;

// use App\Http\Requests\User;

// get this file to use closure (custom validation from Add_user method) in this file
use Illuminate\Support\Facades\Validator;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Supp;

// get custom validation file
use App\Rules\UserRules;

class UserController extends Controller
{
    public function Add_user(Request $request)
    {
        $validation = $request->validate([
            // this method use custom validation wirh custom validation file
            // 'name' => ['required', new UserRules],
            'name' => ['required',
                function (string $attribute, mixed $value, Closure $fail)
                {
                    if (strtoupper($value) !== $value)
                    {
                        $fail('The :attribute must be uppercase.');
                    }
                } 
            ],
            'email' => 'required|email',
        ]);

        return $request->all();

        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|alpha_num|min:6',
        //     'age' => 'required|numeric|min:18',
        //     'city' => 'required',
        //     'phone' => 'required|size:10'
        // ],
        // [
        //     // make custom message for this form wih attributes
        //     'name.required' => 'User Name is required!',
        //     'email.required' => 'User Email Address is required!',
        //     'email.email' => 'Enter correct Email Address!',
        //     'password.required' => 'User Password is required!',
        //     'password.min' => 'Password is minimum 6 characters!',
        //     'age.required' => 'User Age is required!',
        //     'age.numeric' => 'User Age is must be numeric!',
        //     'age.min' => 'User Minimum Age is 18!',
        //     'city.required' => 'User City is required!',
        //     'phone.required' => 'User Phone No. is required!',
        //     'phone.size' => 'Phone No. must be 10 digit!',
        // ]);

        // return $request->all();

        // $user = DB::table('users')
        //                 ->insert([
        //                     'name' => $request->name,
        //                     'email' => $request->email,
        //                     'age' => $request->age,
        //                     'city' => $request->city
        //                 ]);
        
        // if ($user)
        // {
        //     // return redirect()->route('home');
        //     echo "<h2>Data Successfully added.</h2>";
        // }
        // else
        // {
        //     echo "<h2>Data not addde!</h2>";
        // }
    }
}
