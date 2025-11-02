<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    // Teacher: show assign form + (optional) list of teacher's tasks
    public function create()
    {
        // show teacher assign page
        return view('teacher.task-assign');
    }

    // Teacher: store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'file' => 'nullable|file|max:5120', // 5MB max
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tasks', 'public'); // storage/app/public/tasks/...
        }

        $task = Task::create([
            'assigned_by' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Task assigned successfully!');
    }

    // Student: list tasks (you can also show teacher-side list here)
    public function indexForStudent()
    {
        // For now show all tasks. If you want filter by course/supervisor, add logic.
        $tasks = Task::latest()->get();
        return view('student.task-assign', compact('tasks'));
    }

    // Teacher: download task file (if needed)
    public function downloadTaskFile($id)
    {
        $task = Task::findOrFail($id);
        if (! $task->file_path || ! Storage::disk('public')->exists($task->file_path)) {
            return back()->withErrors('Task file not found.');
        }
        return Storage::disk('public')->download($task->file_path);
    }



    public function downloadTask($id)
{
    $task = Task::findOrFail($id);

    if (!$task->file_path || !\Storage::disk('public')->exists($task->file_path)) {
        return back()->with('error', 'File not found.');
    }

    return \Storage::disk('public')->download($task->file_path);
}

}