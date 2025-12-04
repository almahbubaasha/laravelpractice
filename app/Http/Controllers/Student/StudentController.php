<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\Task;
use App\Models\SupervisorInfo;
use App\Models\StudentQuery;
use App\Models\TaskAssignment;
use App\Models\Notification;
use App\Models\SharedResource;

class StudentController extends Controller
{
    // ================= Dashboard (UPDATED WITH DYNAMIC DATA)
    public function dashboard()
    {
        $student = Auth::user();
        $studentId = $student->id;
        $studentIdentifier = $student->identifier ?? $student->id;
        
        // ============= Statistics Cards Data =============
        
        // My Queries Count (student_id column holds identifier value like "213-15-4305")
        $myQueriesCount = StudentQuery::where('student_id', $studentIdentifier)->count();
        
        // Active Tasks Count (not submitted yet)
        $activeTasksCount = TaskAssignment::where('student_identifier', $studentIdentifier)
                            ->whereNull('submission_file')
                            ->count();
        
        // Progress Calculation (Completed/Total × 100)
        $totalTasks = TaskAssignment::where('student_identifier', $studentIdentifier)->count();
        $completedTasks = TaskAssignment::where('student_identifier', $studentIdentifier)
                          ->whereNotNull('submission_file')
                          ->count();
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
        
        
        // ============= Recent Updates =============
        $recentUpdates = collect();
        
        // Recent Notifications
        $recentNotifications = Notification::where('student_identifier', $studentIdentifier)
                              ->latest('created_at')
                              ->take(2)
                              ->get()
                              ->map(function($notification) {
                                  return [
                                      'type' => 'notice',
                                      'icon' => 'fas fa-bullhorn',
                                      'message' => '<strong>Supervisor</strong> sent a new notice',
                                      'time' => $notification->created_at->diffForHumans(),
                                      'created_at' => $notification->created_at
                                  ];
                              });
        
        // Recent Completed Tasks
        $recentCompletedTasks = TaskAssignment::where('student_identifier', $studentIdentifier)
                               ->whereNotNull('submission_file')
                               ->whereNotNull('submitted_at')
                               ->latest('submitted_at')
                               ->take(2)
                               ->get()
                               ->map(function($taskAssignment) {
                                   $taskTitle = 'a task';
                                   
                                   if ($taskAssignment->task) {
                                       $taskTitle = $taskAssignment->task->title ?? 'a task';
                                   }
                                   
                                   return [
                                       'type' => 'task_completed',
                                       'icon' => 'fas fa-check-circle',
                                       'message' => '<strong>You</strong> completed ' . $taskTitle,
                                       'time' => $taskAssignment->submitted_at->diffForHumans(),
                                       'created_at' => $taskAssignment->submitted_at
                                   ];
                               });
        
        // Recent Shared Resources
        $recentResources = SharedResource::where('student_identifier', $studentIdentifier)
                          ->latest('created_at')
                          ->take(2)
                          ->get()
                          ->map(function($resource) {
                              return [
                                  'type' => 'resource',
                                  'icon' => 'fas fa-file-download',
                                  'message' => '<strong>New Resource:</strong> ' . ($resource->resource_name ?? 'Untitled'),
                                  'time' => $resource->created_at->diffForHumans(),
                                  'created_at' => $resource->created_at
                              ];
                          });
        
        // Merge all activities and sort by time
        $recentUpdates = $recentNotifications
                        ->merge($recentCompletedTasks)
                        ->merge($recentResources)
                        ->sortByDesc('created_at')
                        ->take(5);
        
        
        // ============= Upcoming Deadlines =============
        $upcomingDeadlines = TaskAssignment::where('student_identifier', $studentIdentifier)
                            ->whereNull('submission_file')
                            ->with('task.teacher')
                            ->latest('created_at')
                            ->take(3)
                            ->get()
                            ->map(function($assignment) {
                                $taskTitle = 'Pending Task';
                                $supervisorName = 'Supervisor';
                                
                                if ($assignment->task) {
                                    $taskTitle = $assignment->task->title ?? 'Pending Task';
                                    
                                    if ($assignment->task->teacher) {
                                        $supervisorName = $assignment->task->teacher->name ?? 'Supervisor';
                                    }
                                }
                                
                                return [
                                    'day' => $assignment->created_at->format('d'),
                                    'month' => $assignment->created_at->format('M'),
                                    'title' => $taskTitle,
                                    'supervisor' => $supervisorName,
                                    'deadline' => $assignment->created_at
                                ];
                            });
        
        
        return view('student.student-dashboard', compact(
            'myQueriesCount',
            'activeTasksCount',
            'progress',
            'recentUpdates',
            'upcomingDeadlines'
        ));
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

   // ================= Supervisor Information (FINAL FIX)
// ================= Supervisor Information (Using teacher_students table)
public function supervisorInformation()
{
    // Get logged in student
    $student = Auth::user();
    $studentIdentifier = $student->identifier ?? $student->id;

    // Find teacher assigned to this student from teacher_students table
    $teacherStudent = \DB::table('teacher_students')
                      ->where('student_id', $studentIdentifier)
                      ->first();
    
    $supervisor = null;
    if ($teacherStudent) {
        // Get teacher's user record using teacher_id (which is identifier)
        $teacherUser = \App\Models\User::where('identifier', $teacherStudent->teacher_id)
                       ->where('role', 'teacher')
                       ->first();
        
        if ($teacherUser) {
            // Get teacher's profile from teacher_profiles table
            $supervisor = \App\Models\TeacherProfile::where('user_id', $teacherUser->id)
                          ->first();
            
            // If teacher profile exists, attach the user relationship
            if ($supervisor) {
                $supervisor->setRelation('user', $teacherUser);
            }
        }
    }

    return view('student.supervisor-information', compact('supervisor'));
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
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}