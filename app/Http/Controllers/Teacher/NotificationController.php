<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\TeacherStudent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Show notification page with student list
     */
    public function index()
    {
        try {
            $teacher = Auth::user();
            $teacherIdentifier = $teacher->identifier ?? $teacher->user_id;

            // Get all students assigned to this teacher
            $students = TeacherStudent::where('teacher_id', $teacherIdentifier)->get();
            
            // Attach student data
            foreach ($students as $ts) {
                $ts->studentData = User::where('identifier', $ts->student_id)
                                      ->orWhere('user_id', $ts->student_id)
                                      ->first();
            }

            return view('teacher.notification', compact('students'));

        } catch (\Exception $e) {
            Log::error('Error loading notification page: ' . $e->getMessage());
            return back()->with('error', 'Error loading page');
        }
    }

    /**
     * Send notification to selected students
     */
    public function send(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000',
                'students' => 'required|array|min:1',
                'students.*' => 'required|string',
            ]);

            $teacher = Auth::user();
            $message = $request->message;
            $studentIds = $request->students;

            $successCount = 0;

            foreach ($studentIds as $studentId) {
                // Create notification for each student
                Notification::create([
                    'teacher_id' => $teacher->id,
                    'student_identifier' => $studentId, // Changed from student_id
                    'message' => $message,
                    'is_read' => false,
                ]);
                
                $successCount++;
            }

            return response()->json([
                'success' => true,
                'message' => "Notification sent to {$successCount} student(s) successfully!"
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error sending notifications: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send notifications: ' . $e->getMessage()
            ], 500);
        }
    }
}