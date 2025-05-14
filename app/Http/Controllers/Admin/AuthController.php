<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function Login()
    {
        if (Auth::user()) {
            return redirect()->route('dashboard')->with('user', Auth::user());
        }
        return view('auth.login');
    }

    public function signin(Request $request)
    {
        // 1. Validation ----------------------------------------------------------
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 2. User exists? --------------------------------------------------------
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return back()->with('fail', 'Sorry! This email is not registered.');
        }

        // 3. Account locked? -----------------------------------------------------
        if ($user->lock_unlock == 1) {
            return back()->with('fail', 'Your account is locked. Please contact admin.');
        }

        // 4. Attempt login -------------------------------------------------------
        if (!Auth::attempt($credentials)) {
            return back()->with('fail', 'Sorry! This password is incorrect.');
        }

        // 5. We’re logged in; get the fresh user from session --------------------
      

        // 7. Otherwise go to dashboard ------------------------------------------
        return redirect()->route('dashboard');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetPasswordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        // Find the user by email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No account found with this email.']);
        }
        
        // Generate a random password
        $randomPassword = Str::random(10);
        
        // Update the user's password
        $user->password = Hash::make($randomPassword);
        $user->save();
        
        // Send an email with the new password
        Mail::to($user->email)->send(new PasswordResetMail($user, $randomPassword));

        return redirect()->route('login')->with('status', 'A new password has been sent to your email.');
    }
}
