<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $teacher = Auth::user();
        $teacherId = $teacher->id;
        $teacherIdentifier = $teacher->identifier ?? $teacher->id;
        
        // ============= Statistics Cards Data =============
        
        // 1. Total Students
        $totalStudents = DB::table('teacher_students')
                            ->where('teacher_id', $teacherIdentifier)
                            ->count();
        
        // 2. Pending Queries (queries without reply)
        $pendingQueries = DB::table('student_queries as sq')
                            ->leftJoin('query_replies as qr', 'sq.id', '=', 'qr.query_id')
                            ->whereNull('qr.id')
                            ->count();
        
        // 3. Active Tasks (USING REPLY COLUMN - tasks not replied by students)
        $activeTasks = DB::table('task_assignments as ta')
                        ->join('tasks as t', 'ta.task_id', '=', 't.id')
                        ->where('t.teacher_id', $teacherId)
                        ->whereNull('ta.reply')  // Check reply column instead of submission_file
                        ->count();
        
        // 4. Average Progress (USING REPLY COLUMN)
        $studentsData = DB::table('teacher_students')
                        ->where('teacher_id', $teacherIdentifier)
                        ->pluck('student_id');
        
        $totalProgress = 0;
        $studentCount = 0;
        
        foreach ($studentsData as $studentIdentifier) {
            $totalTasks = DB::table('task_assignments')
                            ->where('student_identifier', $studentIdentifier)
                            ->count();
            
            if ($totalTasks > 0) {
                // Completed = reply is NOT NULL
                $completedTasks = DB::table('task_assignments')
                                ->where('student_identifier', $studentIdentifier)
                                ->whereNotNull('reply')  // Check reply column
                                ->count();
                
                $progress = ($completedTasks / $totalTasks) * 100;
                $totalProgress += $progress;
                $studentCount++;
            }
        }
        
        $avgProgress = $studentCount > 0 ? round($totalProgress / $studentCount) : 0;
        
        
        // ============= Recent Activities (5 items) =============
        $recentActivities = collect();
        
        // Recent Queries (reduced to 2)
        $recentQueries = DB::table('student_queries as sq')
                        ->join('users as u', 'sq.student_id', '=', 'u.identifier')
                        ->select(
                            'sq.id',
                            'u.name as student_name',
                            'sq.created_at',
                            DB::raw("'query' as type")
                        )
                        ->latest('sq.created_at')
                        ->take(2)  // Changed from 5 to 2
                        ->get()
                        ->map(function($item) {
                            return [
                                'type' => 'query',
                                'icon' => 'fas fa-message',
                                'message' => '<strong>' . $item->student_name . '</strong> submitted a new query',
                                'time' => \Carbon\Carbon::parse($item->created_at)->diffForHumans(),
                                'created_at' => $item->created_at
                            ];
                        });
        
        // Recent Task Replies (reduced to 2)
        $recentSubmissions = DB::table('task_assignments as ta')
                            ->join('tasks as t', 'ta.task_id', '=', 't.id')
                            ->join('users as u', 'ta.student_identifier', '=', 'u.identifier')
                            ->where('t.teacher_id', $teacherId)
                            ->whereNotNull('ta.reply')
                            ->select(
                                'ta.id',
                                'u.name as student_name',
                                't.title as task_title',
                                'ta.updated_at',
                                DB::raw("'submission' as type")
                            )
                            ->latest('ta.updated_at')
                            ->take(2)  // Changed from 5 to 2
                            ->get()
                            ->map(function($item) {
                                return [
                                    'type' => 'submission',
                                    'icon' => 'fas fa-file-upload',
                                    'message' => '<strong>' . $item->student_name . '</strong> replied to ' . $item->task_title,
                                    'time' => \Carbon\Carbon::parse($item->updated_at)->diffForHumans(),
                                    'created_at' => $item->updated_at
                                ];
                            });
        
        // Recent Completions (reduced to 2)
        $recentCompletions = DB::table('task_assignments as ta')
                            ->join('tasks as t', 'ta.task_id', '=', 't.id')
                            ->join('users as u', 'ta.student_identifier', '=', 'u.identifier')
                            ->where('t.teacher_id', $teacherId)
                            ->whereNotNull('ta.reply')
                            ->select(
                                'ta.id',
                                'u.name as student_name',
                                't.title as task_title',
                                'ta.updated_at',
                                DB::raw("'completion' as type")
                            )
                            ->latest('ta.updated_at')
                            ->take(2)  // Changed from 3 to 2
                            ->get()
                            ->map(function($item) {
                                return [
                                    'type' => 'completion',
                                    'icon' => 'fas fa-check-circle',
                                    'message' => '<strong>' . $item->student_name . '</strong> completed ' . $item->task_title,
                                    'time' => \Carbon\Carbon::parse($item->updated_at)->diffForHumans(),
                                    'created_at' => $item->updated_at
                                ];
                            });
        
        // Merge all activities and take 5
        $recentActivities = $recentQueries
                            ->merge($recentSubmissions)
                            ->merge($recentCompletions)
                            ->sortByDesc('created_at')
                            ->take(5);  // Changed from 10 to 5
        
        
        // ============= Upcoming Deadlines (5 items) =============
        $upcomingDeadlines = DB::table('tasks as t')
                            ->leftJoin('task_assignments as ta', 't.id', '=', 'ta.task_id')
                            ->where('t.teacher_id', $teacherId)
                            ->whereNotNull('t.deadline')
                            ->where('t.deadline', '>=', now())
                            ->select(
                                't.id',
                                't.title',
                                't.deadline',
                                DB::raw('COUNT(CASE WHEN ta.reply IS NULL THEN 1 END) as pending_count'),  // Changed
                                DB::raw('COUNT(ta.id) as total_assigned')
                            )
                            ->groupBy('t.id', 't.title', 't.deadline')
                            ->orderBy('t.deadline', 'asc')
                            ->take(5)
                            ->get()
                            ->map(function($task) {
                                return [
                                    'id' => $task->id,
                                    'day' => \Carbon\Carbon::parse($task->deadline)->format('d'),
                                    'month' => \Carbon\Carbon::parse($task->deadline)->format('M'),
                                    'title' => $task->title,
                                    'info' => $task->pending_count . ' students pending',
                                    'deadline' => $task->deadline
                                ];
                            });
        
        
        return view('teacher.teacher-dashboard', compact(
            'totalStudents',
            'pendingQueries',
            'activeTasks',
            'avgProgress',
            'recentActivities',
            'upcomingDeadlines'
        ));
    }
}