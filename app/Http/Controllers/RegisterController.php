<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show register page
    public function show()
    {
        return view('register');
    }

    // Handle register form submission
    public function store(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'identifier' => 'required|string|max:50|unique:users,user_id',
            'password' => 'required|string|min:6',
            'role' => 'required|in:student,teacher',
        ]);

        // 2️⃣ Create new user
        $user = new User();
        $user->name = $request->name;
        $user->user_id = $request->identifier;
        $user->identifier = $request->identifier;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        // 3️⃣ Auto-login after registration
        Auth::login($user);

        // 4️⃣ Redirect based on role
        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        } else {
            return redirect()->route('teacher.dashboard');
        }
    }
}