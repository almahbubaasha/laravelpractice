<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\Task;
use App\Models\SupervisorInfo;

class StudentController extends Controller
{
    // ================= Dashboard
    public function dashboard()
    {
        $userId = session('user_id');
        $userName = session('name');

        return view('student.student-dashboard', compact('userId', 'userName'));
    }

    // ================= Profile view
    public function profile()
    {
        $student = Auth::user();
        $profile = StudentProfile::where('user_id', $student->id)->first();

        return view('student.profile', compact('student', 'profile'));
    }

    // ================= Profile update
    public function updateProfile(Request $request)
    {
        $student = Auth::user();

        $request->validate([
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        $imagePath = null;
        $existingProfile = StudentProfile::where('user_id', $student->id)->first();
        
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/student_profile'), $filename);
            $imagePath = 'uploads/student_profile/' . $filename;
        } else {
            $imagePath = $existingProfile->img ?? null;
        }

        // Save to student_profiles table
        StudentProfile::updateOrCreate(
            ['user_id' => $student->id],
            [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'contact' => $request->contact,
                'department' => $request->department,
                'img' => $imagePath,
            ]
        );

        // Also update users table (for basic info)
        $student->update([
            'name' => $request->full_name,
            'email' => $request->email,
            'avatar' => $imagePath,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }

    // ================= Supervisor Information
    public function supervisorInformation()
    {
        // Get logged in student
        $student = Auth::user();
        $studentIdentifier = $student->identifier ?? $student->user_id;

        // Find supervisor info by student identifier
        $supervisor = SupervisorInfo::where('student_identifier', $studentIdentifier)->first();

        return view('student.supervisor-information', compact('supervisor'));
    }

    // ================= My Queries
    public function myQueries()
    {
        return view('student.my-queries');
    }

    // ================= Assigned Tasks
    public function assignTasks()
    {
        $studentId = session('user_id');

        $tasks = Task::where('student_id', $studentId)
                     ->with(['teacher', 'submissions' => function($query) use ($studentId) {
                         $query->where('student_id', $studentId);
                     }])
                     ->latest()
                     ->get();

        return view('student.assign-tasks', compact('tasks'));
    }

    // ================= Notifications
    public function notifications()
    {
        return view('student.notification');
    }

    // ================= Resource Sharing
    public function resourceSharing()
    {
        return view('student.resource-sharing');
    }

    // ================= Logout
    public function logout(Request $request)
{
    Auth::guard('web')->logout(); // যদি তুমি default guard use করো
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('student.login'); // student login page route
}

}