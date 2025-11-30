<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskAssignment;
use App\Models\User;
use App\Models\TeacherStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    // Show task assignment form WITH task list
    public function create()
    {
        $teacher = Auth::user();
        $teacherIdentifier = $teacher->identifier ?? $teacher->user_id;

        // Get students for assignment
        $studentIdentifiers = TeacherStudent::where('teacher_id', $teacherIdentifier)
            ->pluck('student_id')
            ->toArray();

        $students = User::where(function($query) use ($studentIdentifiers) {
                $query->whereIn('identifier', $studentIdentifiers)
                      ->orWhereIn('user_id', $studentIdentifiers);
            })
            ->where('role', 'student')
            ->get();

        $students->each(function($student) {
            $student->student_identifier = $student->identifier ?? $student->user_id;
        });

        // Get all tasks with assignments and submissions
        $tasks = Task::with(['assignments'])
            ->where('teacher_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Manually load students for each assignment
        foreach ($tasks as $task) {
            foreach ($task->assignments as $assignment) {
                $assignment->student = User::where('identifier', $assignment->student_identifier)
                    ->orWhere('user_id', $assignment->student_identifier)
                    ->first();
            }
        }

        return view('teacher.task-assign', compact('students', 'tasks'));
    }

    // Store task and assign to students
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'student_identifiers' => 'required|array|min:1',
            'student_identifiers.*' => 'string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip,png,jpg,jpeg|max:10240'
        ], [
            'student_identifiers.required' => 'Please select at least one student',
            'student_identifiers.min' => 'Please select at least one student'
        ]);

        try {
            $filePath = null;
            $originalFileName = null;

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $originalFileName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalFileName;
                $filePath = $file->storeAs('task_files', $filename, 'public');
            }

            $task = Task::create([
                'teacher_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'file_path' => $filePath,
                'file_original_name' => $originalFileName
            ]);

            $students = User::where(function($query) use ($request) {
                    $query->whereIn('identifier', $request->student_identifiers)
                          ->orWhereIn('user_id', $request->student_identifiers);
                })
                ->where('role', 'student')
                ->get();

            if ($students->isEmpty()) {
                throw new \Exception('No students found');
            }

            // ✅ Only use student_identifier (no student_id column)
            foreach ($students as $student) {
                TaskAssignment::create([
                    'task_id' => $task->id,
                    'student_identifier' => $student->identifier ?? $student->user_id,
                ]);
            }

            return redirect()->back()->with('success', 'Task assigned successfully to ' . $students->count() . ' student(s)!');

        } catch (\Exception $e) {
            Log::error('Task Assignment Error:', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to assign task: ' . $e->getMessage())->withInput();
        }
    }

    // View all tasks (for separate page if needed)
    public function index()
    {
        $tasks = Task::where('teacher_id', Auth::id())->latest()->get();

        // Manually load students for each assignment
        foreach ($tasks as $task) {
            $task->load('assignments');
            foreach ($task->assignments as $assignment) {
                $assignment->student = User::where('identifier', $assignment->student_identifier)
                    ->orWhere('user_id', $assignment->student_identifier)
                    ->first();
            }
        }

        return view('teacher.tasks-list', compact('tasks'));
    }

    // Delete entire task
    public function destroy(Task $task)
    {
        if ($task->teacher_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        if ($task->file_path) {
            Storage::disk('public')->delete($task->file_path);
        }

        // Delete all submission files
        foreach ($task->assignments as $assignment) {
            if ($assignment->submission_file) {
                Storage::disk('public')->delete($assignment->submission_file);
            }
        }

        $task->assignments()->delete();
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully!');
    }

    // Download student submission
    public function downloadSubmission($assignmentId)
    {
        $assignment = TaskAssignment::with('task')->findOrFail($assignmentId);

        if ($assignment->task->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (!$assignment->submission_file) {
            return redirect()->back()->with('error', 'No submission file found');
        }

        $filePath = storage_path('app/public/' . $assignment->submission_file);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found');
        }

        return response()->download($filePath, $assignment->reply_file_original_name ?? 'submission_file');
    }

    // Delete student submission
    public function deleteSubmission($assignmentId)
    {
        try {
            $assignment = TaskAssignment::with('task')->findOrFail($assignmentId);

            if ($assignment->task->teacher_id !== Auth::id()) {
                return redirect()->back()->with('error', 'Unauthorized');
            }

            if ($assignment->submission_file) {
                Storage::disk('public')->delete($assignment->submission_file);
            }

            $assignment->update([
                'reply' => null,
                'submission_file' => null,
                'reply_file_original_name' => null,
                'submitted_at' => null,
            ]);

            return redirect()->back()->with('success', 'Submission deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Error deleting submission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete submission');
        }
    }

    // Download task attachment
    public function downloadTaskFile($taskId)
    {
        $task = Task::findOrFail($taskId);

        if ($task->teacher_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (!$task->file_path) {
            return redirect()->back()->with('error', 'No file attached');
        }

        $filePath = storage_path('app/public/' . $task->file_path);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found');
        }

        return response()->download($filePath, $task->file_original_name ?? 'task_file');
    }
}