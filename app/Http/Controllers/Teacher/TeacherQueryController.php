<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\StudentQuery;
use App\Models\QueryReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherQueryController extends Controller
{
    public function index()
    {
        // Get teacher's identifier from users table (555555)
        $teacherIdentifier = Auth::user()->identifier;

        // Get all queries sent to this teacher
        $queries = StudentQuery::where('teacher_id', $teacherIdentifier)
            ->orderBy('created_at', 'desc')
            ->get();

        // Attach replies
        foreach ($queries as $query) {
            $query->reply = QueryReply::where('query_id', $query->id)->first();
            // student_id already contains "213-15-4346"
            $query->student_identifier = $query->student_id;
        }

        return view('teacher.QMP-Teacher', compact('queries'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $teacherIdentifier = Auth::user()->identifier;

        // Verify this query belongs to this teacher
        $query = StudentQuery::where('id', $id)
            ->where('teacher_id', $teacherIdentifier)
            ->first();

        if (!$query) {
            return redirect()->back()->with('error', 'Query not found or unauthorized.');
        }

        // Delete old reply if exists, then create new one
        QueryReply::where('query_id', $id)->delete();

        QueryReply::create([
            'query_id' => $id,
            'teacher_id' => $teacherIdentifier, // "555555"
            'reply' => $request->input('reply'),
        ]);

        return redirect()->route('teacher.student.queries')->with('success', 'Reply sent successfully!');
    }

    public function deleteQuery($id)
    {
        $teacherIdentifier = Auth::user()->identifier;

        // Verify this query belongs to this teacher
        $query = StudentQuery::where('id', $id)
            ->where('teacher_id', $teacherIdentifier)
            ->first();

        if (!$query) {
            return redirect()->back()->with('error', 'Query not found or unauthorized.');
        }

        // Delete replies first, then query
        QueryReply::where('query_id', $id)->delete();
        $query->delete();

        return redirect()->route('teacher.student.queries')->with('success', 'Query deleted successfully!');
    }

    public function deleteReply($id)
    {
        $teacherIdentifier = Auth::user()->identifier;

        // Verify this reply belongs to this teacher
        $reply = QueryReply::where('id', $id)
            ->where('teacher_id', $teacherIdentifier)
            ->first();

        if (!$reply) {
            return redirect()->back()->with('error', 'Reply not found or unauthorized.');
        }

        $reply->delete();

        return redirect()->route('teacher.student.queries')->with('success', 'Reply deleted successfully!');
    }
}