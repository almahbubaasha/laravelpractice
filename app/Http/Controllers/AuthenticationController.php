<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthenticationController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login'); // login.blade.php
    }

    // Login function
    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required', // Email or custom ID
            'password' => 'required'
        ]);

        // Fetch user by identifier
        $user = User::where('identifier', $request->identifier)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // Set user session
            $request->session()->regenerate();

            // Role-based redirect
            if ($user->role === 'teacher') {
                return redirect()->route('teacher.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        }

        // Invalid credentials
        return back()->withErrors(['identifier' => 'Invalid credentials.'])->withInput();
    }

   public function logout(Request $request)
{
    Auth::logout(); // session destroy (teacher/student এক guard)

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login'); // common login page
}



}