<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{
    // Student submit query
    public function storeStudentQuery(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:1000',
        ]);

        Query::create([
            'student_id' => Auth::id(),
            'query' => $request->input('query'),
        ]);

        return redirect()->back()->with('success', 'Query submitted successfully!');
    }

    // Teacher submit feedback
    public function storeTeacherFeedback(Request $request, $id)
    {
        $query = Query::findOrFail($id);

        $request->validate([
            'feedback' => 'required|string|max:1000',
        ]);

        $query->update([
            'feedback' => $request->input('feedback'),
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }

    // Student sees their own queries
    public function studentQueries()
    {
        $queries = Query::where('student_id', Auth::id())->latest()->get();
        return view('student.QMP-Student', compact('queries'));
    }

    // Teacher sees all queries
    public function teacherQueries()
    {
        $queries = Query::latest()->with('student')->get();
        return view('teacher.QMP-Teacher', compact('queries'));
    }
}