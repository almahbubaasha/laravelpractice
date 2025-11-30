<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherProfile;
use Illuminate\Support\Facades\Auth;

class TeacherProfileController extends Controller
{
    // Show Profile Page
    public function showProfile()
    {
        $teacherId = Auth::id();
        $profile = TeacherProfile::where('user_id', $teacherId)->first();

        return view('teacher.profile', compact('profile'));
    }

    // Save / Update Profile
    public function saveProfile(Request $request)
    {
        $teacherId = Auth::id();

        $request->validate([
            'full_name'   => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'contact'     => 'nullable|string|max:20',  // <-- Added contact validation
            'department'  => 'nullable|string|max:255',
            'short_bio'   => 'nullable|string|max:1000',
            'img'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Default = old image
        $imagePath = $request->old_img;

        // If new image uploaded
        if ($request->hasFile('img')) {

            // Save new image
            $file = $request->file('img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teacher_profile'), $filename);

            $imagePath = 'uploads/teacher_profile/' . $filename;
        }

        TeacherProfile::updateOrCreate(
            ['user_id' => $teacherId],  // find this teacher
            [
                'full_name' => $request->full_name,
                'email' => $request->email,
                'contact' => $request->contact,  // <-- Added contact field
                'department' => $request->department,
                'short_bio' => $request->short_bio,
                'img' => $imagePath,
            ]
        );

        return back()->with('success', 'Profile saved successfully!');
    }
}