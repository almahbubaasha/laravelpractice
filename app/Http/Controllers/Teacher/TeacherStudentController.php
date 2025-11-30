<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherStudent;
use App\Models\TeacherProfile;
use App\Models\User;
use App\Models\SupervisorInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TeacherStudentController extends Controller
{
    /**
     * Show the Add Student form
     */
    public function index()
    {
        try {
            $teacher = Auth::user();
            $teacherIdentifier = $teacher->identifier ?? $teacher->user_id;

            // Fetch students assigned to this teacher
            $students = TeacherStudent::where('teacher_id', $teacherIdentifier)->get();

            foreach ($students as $ts) {
                $ts->studentData = User::where('identifier', $ts->student_id)
                                      ->orWhere('user_id', $ts->student_id)
                                      ->first();
            }

            return view('teacher.add-student', compact('students'));

        } catch (\Exception $e) {
            Log::error('Error in index: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store student under teacher + Update SupervisorInfo table
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'student_id' => 'required|string',
            ]);

            $teacher = Auth::user();
            $teacherIdentifier = $teacher->identifier ?? $teacher->user_id;

            $inputStudentId = trim($request->student_id);

            // Find student by user_id or identifier
            $student = User::where(function($query) use ($inputStudentId) {
                            $query->where('user_id', $inputStudentId)
                                  ->orWhere('identifier', $inputStudentId);
                        })
                        ->where('role', 'student')
                        ->first();

            if (!$student) {
                return back()->with('error', "Student ID not found!");
            }

            $studentIdentifier = $student->identifier ?? $student->user_id;

            // Check if student already assigned
            $alreadyAssigned = TeacherStudent::where('student_id', $studentIdentifier)->first();

            if ($alreadyAssigned) {
                $teacherAssigned = User::where('identifier', $alreadyAssigned->teacher_id)
                                      ->orWhere('user_id', $alreadyAssigned->teacher_id)
                                      ->first();

                return back()->with('error', 'Already assigned to ' . ($teacherAssigned->name ?? 'another teacher'));
            }

            // Save teacher-student relation
            TeacherStudent::create([
                'teacher_id' => $teacherIdentifier,
                'student_id' => $studentIdentifier,
            ]);

            // Fetch teacher profile
            $teacherProfile = TeacherProfile::where('user_id', $teacher->id)->first();

            
 // --- SUPERVISOR INFO UPDATE HERE ---
SupervisorInfo::updateOrCreate(
    [
        'student_identifier' => $studentIdentifier // use student actual identifier or user_id
    ],
    [
        'user_id'    => $student->id, // still integer for foreign key
        'full_name'  => $teacherProfile->full_name ?? $teacher->name,
        'email'      => $teacherProfile->email ?? $teacher->email,
        'department' => $teacherProfile->department ?? null,
        'img'        => $teacherProfile->img ?? null,
        'contact'    => $teacherProfile->contact ?? null,
        'short_bio'  => $teacherProfile->bio ?? null,
    ]
);

            return back()->with('success', 'Student added & Supervisor info updated.');

        } catch (\Exception $e) {
            Log::error('Error in store: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove student + remove supervisor info
     */
    public function destroy($studentIdentifier)
    {
        try {
            $teacher = Auth::user();
            $teacherIdentifier = $teacher->identifier ?? $teacher->user_id;

            $deleted = TeacherStudent::where('teacher_id', $teacherIdentifier)
                                     ->where('student_id', $studentIdentifier)
                                     ->delete();

            if ($deleted) {
                // Remove supervisor info
                $student = User::where('identifier', $studentIdentifier)
                              ->orWhere('user_id', $studentIdentifier)
                              ->first();

                if ($student) {
                    SupervisorInfo::where('user_id', $student->user_id)->delete();
                }

                return back()->with('success', 'Student removed & Supervisor info cleared.');
            }

            return back()->with('error', 'Student not found.');

        } catch (\Exception $e) {
            Log::error('Error in destroy: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }




  // Add this method to your TeacherStudentController.php

/**
 * Get Student Profile (for AJAX request)
 */
public function getStudentProfile($studentIdentifier)
{
    try {
        // Find student by identifier or user_id
        $student = User::where('identifier', $studentIdentifier)
                      ->orWhere('user_id', $studentIdentifier)
                      ->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        // Get student profile from student_profiles table
        $profile = \App\Models\StudentProfile::where('user_id', $student->id)->first();

        return response()->json([
            'success' => true,
            'student' => [
                'identifier' => $student->identifier ?? $student->user_id,
                'name' => $profile->full_name ?? $student->name ?? 'N/A',
                'email' => $profile->email ?? $student->email ?? 'N/A',
                'contact' => $profile->contact ?? 'N/A',
                'department' => $profile->department ?? 'N/A',
                'avatar' => $profile->img ?? $student->avatar ?? 'default-avatar.png',
            ]
        ], 200);

    } catch (\Exception $e) {
        Log::error('Error fetching student profile: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}
}