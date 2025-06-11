<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard')->with('success', "Already logged in!");
        }
        
        return view('auth.login');
    }

    public function loginAttempt(Request $request)
    {
        // Validate the form
        $rules = [
            'email_username' => 'required|max:50',
            'password' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return Redirect::back()->withErrors($validate)->withInput($request->all())->with('error', 'Validation Error!');
        }

        try {
            // Determine whether the input is an email or username
            $user = null;
            if (filter_var($request->email_username, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $request->email_username)->first();
            } else {
                $user = User::where('username', $request->email_username)->first();
            }

            if (!$user) {
                return redirect()->back()->withInput($request->all())->with('error', "Invalid credentials");
            }

            // Check if the password is correct
            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()->withInput($request->all())->with('error', 'Password is incorrect');
            }

            // For now, allow any authenticated user (role check will be handled by middleware)
            // You can uncomment the line below once Spatie Permission is properly configured
            // if (!$user->hasRole('admin')) {
            //     return redirect()->back()->withInput($request->all())->with('error', 'Access denied. Admin access required.');
            // }

            // Login the user
            $remember_me = $request->has('remember');
            Auth::attempt(['email' => $user->email, 'password' => $request->password], $remember_me);

            if (Auth::check()) {
                return redirect()->route('admin.dashboard')->with('success', "Login successful!");
            } else {
                return redirect()->back()->withInput($request->all())->with('error', 'Authentication Error');
            }

        } catch (\Throwable $th) {
            Log::error("Failed to Login:" . $th->getMessage());
            return redirect()->back()->withInput($request->all())->with('error', "Something went wrong! Please try again later");
        }
    }
}
