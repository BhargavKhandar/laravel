<?php

namespace App\Http\Controllers;

use App\Models\EmailVerification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // open home page
    public function index()
    {
        return view('home');
    }

    // open register page
    public function register()
    {
        return view('register');
    }

    // user data store in database
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'string|required|min:2',
            'email' => 'string|email|required|max:100',
            'password' => 'string|required|confirmed|min:6',
        ],
        [], // Custom error messages would go here if you had any.
        [
            // This method use in the laravel inbuilt msg is same but the attributes are changed
            'name' => 'User Name',
            'email' => 'User Email Address',
            'password' => 'User Password',
        ]);

        $user_exist = User::where('email', $request->email)->get();
        if ($user_exist == true)
        {
            return back()->with('error', 'User with this email already exists!');
        }

        // if (User::where('email', $request->email)->exists())
        // {
        //     // return redirect()->route('registers')->with('error', 'User with this email already exists!');
        //     return back()->with('error', 'User with this email already exists!');
        // }

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $insert_user = $user->save();

        if ($insert_user)
        {
            // return redirect()->route('verification/'.$user->id)->with('success', 'New user added successfully.');
            return redirect('verification/' . $user->id)->with('success', 'New user added successfully and OTP sent your email.');
        }
        else
        {
            // return redirect()->route('registers')->with('error', 'User not added!');
            return back()->with('error', 'User not added!');
        }

    }

    // store otp in databse and send otp to email
    public function sendOtp($user)
    {
        $otp = rand(100000, 999999);
        $time = now();

        EmailVerification::updateOrCreate(
            [
                'email' => $user[0]->email,
            ],
            [
                'email' => $user[0]->email,
                'otp' => $otp,
                'created_at' => $time,
            ]
        );

        $data['email'] = $user[0]->email;
        $data['title'] = 'Mail Verification';
        $data['otp'] = $otp;
        $data['body'] = 'Your One Time Password';
        $data['secure'] = 'Please do not share your otp.';

        Mail::send('mailverification', ['data' => $data], function ($message) use ($data)
        {
            $message->to($data['email'])->subject($data['title']);
        });
    }

    // verify email address
    public function verification($id)
    {
        $user = User::where('id', $id)->limit(1)->get();
        // return $user;
        
        if (!$user || $user[0]->is_verified == 1)
        {
            return redirect()->route('login')->with('success', 'User already verified please login.');
        }
        else
        {
            $email = $user[0]->email;
            $this->sendOtp($user);
            return view('verification', compact('email'))->with('success', 'OTP sent succssefully please check your email ' . $user[0]->email . ' .');
        }
    }

    // verify otp
    public function verifiedOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|min:6'
        ]);

        $user = User::where('email', $request->email)->limit(1)->get();
        $otpData = EmailVerification::where('otp', $request->otp)->limit(1)->get();

        if (!$otpData)
        {
            // return redirect()->route('verification')->with('error', 'Your OTP has been wrong.');
            return back()->with('error', 'Your OTP has been wrong.');
        }
        else
        {
            $currenttime = now();
            $time = Carbon::parse($otpData[0]->created_at);

            if ($time->diffInMinutes($currenttime) <= 1.5)
            {
                User::where('id', $user[0]->id)->update([
                    'is_verified' => 1,
                    'email_verified_at' => Carbon::now()
                ]);

                return redirect()->route('login')->with('success', 'User email is verified successfully.');
            }
            else
            {
                // return redirect()->route('verification')->with('error', 'Your OTP has been expire.');
                return back()->with('error', 'Your OTP has been expire.');
            }
        }
    }

    // resend otp
    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->limit(1)->get();
        $otpData = EmailVerification::where('email', $request->email)->limit(1)->get();

        $currenttime = now();
        $time = Carbon::parse($otpData->created_at);

        if ($time->diffInMinutes($currenttime) <= 1.5)
        {
            // return redirect()->route('verification')->with('error', 'Please try after some time.');
            return back()->with('error', 'Please try after some time.');
        }
        else
        {
            $this->sendOtp($user);
            // return redirect()->route('verification')->with('success', 'OTP has been sent your email is ' . $user->email . ' please check inbox.');
            return back()->with('success', 'OTP has been sent your email is ' . $user->email . ' please check inbox.');
        }
    }

    // open login page
    public function login()
    {
        if (Auth::user())
        {
            // Redirect to home page if user is already authenticated
            return redirect()->route('home');
        }
        else
        {            
            return view('login');
        }
    }

    // data check database to login user
    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $userCredential = $request->only('email', 'password');
        $userData = User::where('email', $request->email)->limit(1)->get();
        // $user = count($userData);
        // return Auth::attempt($userCredential);

        if ($userData && $userData[0]->is_verified == 0)
        {
            $this->sendOtp($userData);
            return redirect('verification/' . $userData->id)->with('success', 'OTP sent succesffully');
        }
        else if (Auth::attempt($userCredential))
        {
            // return $userCredential;
            return redirect()->route('home')->with('success', 'User loggedin successfully.');
        }
        else
        {
            return back()->with('error', 'Username or Password incorrect.');
        }
    }

    // logout user
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    // open forgetpassword page
    public function forgetpassword()
    {
        return view('forget');
    }

    // Sent mail to email
    public function sentMail(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)
                    ->limit(1)->get();

        //Check if the user exists
        if ($user == false)
        {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }

        $token = Str::random(60);

        //Get the token just created above
        $tokenData = DB::table('password_reset_tokens')
                        ->where('email', $request->email)->limit(1)->get();
                        // return $tokenData;

        if ($tokenData == true)
        {
            // Update the existing token
            $tokendata = DB::table('password_reset_tokens')->where('email', $request->email)->update([
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            // return $tokendata;
        }
        else
        {
            // Create a new token
            $tokendata = DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        if ($this->sendResetEmail($request->email, $token))
        {
            return redirect()->back()->with('success', trans('A reset link has been sent to your email address.'));
        }
        else
        {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    // Email Page Show
    private function sendResetEmail($email, $token)
    {

        $user = DB::table('users')->where('email', $email)->select('email')->limit(1)->get();
        // return $user;
    
        // Generate the password reset link. The token generated is embedded in the link
        // $link = config('base_url') . $token . '/email=' . urlencode($user[0]->email);
        
        $data['email'] = $user[0]->email;
        $data['title'] = 'Passwprd reset link';
        $data['body'] = 'Please click the button below to reset your password:';
        $data['token'] = $token;
        // return $data;

        if ($data['email'] == true)
        {
            Mail::send('resetlink', ['data' => $data], function ($message) use ($data)
            {
                $message->to($data['email'])->subject($data['title']);
            });

            return redirect()->back()->with('success', 'Reset link sent to your email please check your email '. $user[0]->email);
        }
        else
        {
            return redirect()->back()->with('error', 'link not sent.');
        }

        // // Retrieve the user from the database
        // $user = DB::table('users')->where('email', $email)->select('email')->first();
        // // return $user;
    
        // // Generate the password reset link. The token generated is embedded in the link
        // $link = config('base_url') . 'reset/' . $token . '?email=' . urlencode($user->email);
    
        // try
        // {
        //     $data['email'] = $user->email;
        //     $data['title'] = 'Mail Verification';
        //     $data['body'] = 'Please click the button below to reset your password:';
        //     $data['link'] = $link;

        //     Mail::send('resetlink', ['data' => $data], function ($message) use ($data)
        //     {
        //         $message->to($data['email'])->subject($data['title']);
        //     });
    
        //     return redirect()->back()->with('success', 'Reset link sent to your email please check email '. $user->email);
        //     // return true;
        // }
        // catch (\Exception $e)
        // {
        //     return redirect()->back()->with('error', 'Mail does not sent please try again.');
        //     // return false;
        // }
    }

    // Reset Password Page Open
    public function showResetForm($token, $email)
    {
        // Show the password reset form
        return view('reset', ['token' => $token, 'email' => $email]);
    }

    // Update Password
    public function reset(Request $request)
    {

        $request->validate([
            'email' => 'email|required',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::where('email', $request->email)->select('email', 'password')->limit(1)->get();
        $user->makeVisible(['password']);
        
        $tokenTime = DB::table('password_reset_tokens')->where('email', $request->email)->select('created_at')->limit(1)->get();
        // return $tokenTime[0]->created_at;

        $currenttime = now();
        $time = Carbon::parse($tokenTime[0]->created_at);

        if ($time->diffInMinutes($currenttime) <= 3) // 3 minute
        {
            if ($user == true)
            {
                // User::where('email', $request->email)
                //        ->update(['password' => Hash::make($request->password)]);
                $user->email = $request->email;
                $user->password = $request->password;
                $user->save();
                // return $user->password;

                return redirect()->route('login')->with('success', 'Your password has been reset successfully. Please log in.');
            }
            else
            {
                return back()->with('error', 'Password does not match.');
            }
        }
        else
        {
            return redirect()->route('forgetpassword')->with('error', 'Link is expire please resend foeget password link.');
        }
    }
        

    // this method call by api.php
    public function hello()
    {
        return "Hello";
    }

}
