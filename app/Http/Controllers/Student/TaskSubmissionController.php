<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskSubmissionController extends Controller
{
    // Student: submit a file for a task
    public function submit(Request $request, $taskId)
    {
        $request->validate([
            'file' => 'required|file|max:5120', // 5MB
            'remarks' => 'nullable|string|max:1000',
        ]);

        $task = Task::findOrFail($taskId);

        $path = $request->file('file')->store('submissions', 'public');

        // create or update submission (if you want multiple submissions remove updateOrCreate)
        TaskSubmission::updateOrCreate(
            ['task_id' => $task->id, 'student_id' => Auth::id()],
            ['file_path' => $path, 'remarks' => $request->remarks]
        );

        return redirect()->back()->with('success', 'Submission uploaded successfully!');
    }

    // Student: download their submission or teacher can download
    public function downloadSubmission($id)
    {
        $submission = TaskSubmission::findOrFail($id);

        if (! $submission->file_path || ! Storage::disk('public')->exists($submission->file_path)) {
            return back()->withErrors('Submission file not found.');
        }

        return Storage::disk('public')->download($submission->file_path);
    }
}