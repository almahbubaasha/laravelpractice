<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $student = Auth::user();
            $studentIdentifier = $student->identifier ?? $student->user_id;
            
            $tasks = Task::whereHas('assignments', function($query) use ($studentIdentifier) {
                $query->where('student_identifier', $studentIdentifier);
            })
            ->with(['teacher', 'assignments' => function($query) use ($studentIdentifier) {
                $query->where('student_identifier', $studentIdentifier);
            }])
            ->orderBy('deadline', 'asc')
            ->get();

            $tasks = $tasks->map(function($task) {
                $task->pivot = $task->assignments->first();
                return $task;
            });

            return view('student.assigned-tasks', compact('tasks'));

        } catch (\Exception $e) {
            Log::error('Error loading tasks: ' . $e->getMessage());
            return view('student.assigned-tasks', ['tasks' => collect([])]);
        }
    }

    public function submit(Request $request, $taskId)
    {
        $request->validate([
            'reply' => 'required|string',
            'submission_file' => 'nullable|file|mimes:pdf,doc,docx,zip,png,jpg,jpeg|max:10240',
        ]);

        try {
            $student = Auth::user();
            $studentIdentifier = $student->identifier ?? $student->user_id;

            $assignment = TaskAssignment::where('task_id', $taskId)
                ->where('student_identifier', $studentIdentifier)
                ->first();

            if (!$assignment) {
                return redirect()->back()->with('error', 'Task assignment not found.');
            }

            if ($assignment->submitted_at) {
                return redirect()->back()->with('error', 'You have already submitted this task.');
            }

            $filePath = null;
            $originalName = null;
            if ($request->hasFile('submission_file')) {
                $file = $request->file('submission_file');
                $originalName = $file->getClientOriginalName();
                $filePath = $file->store('submissions', 'public');
            }

            $assignment->update([
                'reply' => $request->reply,
                'submission_file' => $filePath,
                'reply_file_original_name' => $originalName,
                'submitted_at' => Carbon::now(),
            ]);

            return redirect()->back()->with('success', 'Task submitted successfully!');
        } catch (\Exception $e) {
            Log::error('Error submitting task: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to submit task: ' . $e->getMessage());
        }
    }

    public function delete($taskId)
    {
        try {
            $student = Auth::user();
            $studentIdentifier = $student->identifier ?? $student->user_id;

            $assignment = TaskAssignment::where('task_id', $taskId)
                ->where('student_identifier', $studentIdentifier)
                ->first();

            if (!$assignment) {
                return redirect()->back()->with('error', 'Task assignment not found.');
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
            return redirect()->back()->with('error', 'Failed to delete submission: ' . $e->getMessage());
        }
    }
}