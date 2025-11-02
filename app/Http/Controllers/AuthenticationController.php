<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        // Validate input fields
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $identifier = $request->input('identifier');
        $password = $request->input('password');

        // Find user by user_id (student or faculty id)
        $user = User::where('user_id', $identifier)->first();

        if (!$user) {
            // User not found — create new user
            $user = new User();
            $user->user_id = $identifier;
            $user->identifier = $identifier; // অবশ্যই দিতে হবে
            $user->password = Hash::make($password);
            $user->email = null; // Optional: since you don't use email

            // Determine role based on student or faculty ID format
            if (preg_match('/^\d{3}-\d{2}-\d{4,7}$/', $identifier)) {
                $user->role = 'student';
                $user->name = 'Student User'; // প্রয়োজনে পরিবর্তন করতে পারো
            } else {
                $user->role = 'faculty';
                $user->name = 'Faculty User';
            }

            $user->save();

            // Auto-login newly created user
            Auth::login($user);

            // Redirect based on role
            return redirect()->route($user->role === 'student' ? 'student.dashboard' : 'teacher.dashboard');
        }

        // Check password
        if (!Hash::check($password, $user->password)) {
            return back()->withErrors(['password' => 'Password is incorrect'])->withInput();
        }

        // Log in existing user
        Auth::login($user);

        // Redirect based on role
        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('teacher.dashboard');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}