<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;  // এখানে মডেল ইম্পোর্ট করবে
use App\Models\SupervisorInfo;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.student-dashboard');
    }

//============================= Profile view
    public function profile()
{
    return view('student.profile'); // কোনো ডাটা পাঠানো হচ্ছে না
}

// Profile update method
public function updateProfile(Request $request)
{
    $request->validate([
        'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB max
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'department' => 'nullable|string|max:255',
        'short_bio' => 'nullable|string|max:1000',
    ]);

    $user = Auth::user();

    // ইউজার টেবিলে আপডেট (name & email)
    $user->name = $request->input('full_name');
    $user->email = $request->input('email');

    if ($request->hasFile('img')) {
        $filename = time() . '.' . $request->img->extension();
        $request->img->move(public_path('uploads/profile_images'), $filename);
        $avatarPath = 'uploads/profile_images/' . $filename;
        $user->avatar = $avatarPath;
    }

    $user->save();

    // নতুন Profile রেকর্ড তৈরি করবে প্রতিবার
    $profileData = [
        'user_id' => $user->id,
        'full_name' => $request->input('full_name'),
        'email' => $request->input('email'),
        'department' => $request->input('department'),
        'short_bio' => $request->input('short_bio'),
        'img' => $avatarPath ?? null,
    ];

    Profile::create($profileData); // এখানে updateOrCreate নয়, create ব্যবহার করো

    return back()->with('success', 'Profile updated successfully!');
}
//=========================================================end profile management


//============================= Supervisor Info


   public function supervisorInformation()
{
    $supervisor = SupervisorInfo::where('user_id', Auth::id())->latest()->first();
    return view('student.supervisor-information', compact('supervisor'));
}

public function supervisorUpdate(Request $request)
{
    $request->validate([
        'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'department' => 'nullable|string|max:255',
        'short_bio' => 'nullable|string|max:1000',
        'contact' => 'nullable|string|max:20',
    ]);

    $avatarPath = null;
    if ($request->hasFile('img')) {
        $filename = time() . '.' . $request->img->extension();
        $request->img->move(public_path('uploads/supervisor_images'), $filename);
        $avatarPath = 'uploads/supervisor_images/' . $filename;
    }

    SupervisorInfo::create([
        'user_id' => Auth::id(),
        'full_name' => $request->full_name,
        'email' => $request->email,
        'department' => $request->department,
        'short_bio' => $request->short_bio,
        'img' => $avatarPath,
        'contact' => $request->contact,
    ]);

    return back()->with('success', 'Supervisor info updated successfully!');
}















    //====================================================end supervisor info
    public function myQueries()
    {
        return view('student.my-queries');
    }
public function assignTasks()
{
    $tasks = \App\Models\Task::latest()->get(); // fetch all tasks
    return view('student.task-assign', compact('tasks'));
}



    public function notifications()
    {
        return view('student.notifications');
    }

    public function resourceSharing()
    {
        return view('student.resource-sharing');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}