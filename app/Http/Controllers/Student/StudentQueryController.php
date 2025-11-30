<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentQuery;
use App\Models\QueryReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentQueryController extends Controller
{
    public function index()
    {
        // Get student's identifier from users table (213-15-4346)
        $studentIdentifier = Auth::user()->identifier;

        // Find student's teacher using identifier
        $teacherStudent = DB::table('teacher_students')
            ->where('student_id', $studentIdentifier) // ✅ Match with identifier
            ->first();

        if (!$teacherStudent) {
            return redirect()->back()->with('error', 'No teacher assigned to you.');
        }

        $teacherIdentifier = $teacherStudent->teacher_id; // "555555"

        // Get all queries using identifiers
        $queries = StudentQuery::where('student_id', $studentIdentifier)
            ->where('teacher_id', $teacherIdentifier)
            ->orderBy('created_at', 'desc')
            ->get();

        // Attach replies
        foreach ($queries as $query) {
            $query->reply = QueryReply::where('query_id', $query->id)->first();
        }

        return view('student.QMP-Student', compact('queries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:1000',
        ]);

        // Get student's identifier (213-15-4346)
        $studentIdentifier = Auth::user()->identifier;

        // Get teacher identifier from teacher_students table
        $teacherStudent = DB::table('teacher_students')
            ->where('student_id', $studentIdentifier) // ✅ Match with identifier
            ->first();

        if (!$teacherStudent) {
            return redirect()->back()->with('error', 'No teacher assigned.');
        }

        // Create query with identifiers (not primary keys)
        StudentQuery::create([
            'student_id' => $studentIdentifier,              // "213-15-4346"
            'teacher_id' => $teacherStudent->teacher_id,     // "555555"
            'query' => $request->input('query'),
        ]);

        return redirect()->route('student.queries')->with('success', 'Query submitted successfully!');
    }

    public function destroy($id)
    {
        $studentIdentifier = Auth::user()->identifier;

        $query = StudentQuery::where('id', $id)
            ->where('student_id', $studentIdentifier) // ✅ Verify using identifier
            ->first();

        if (!$query) {
            return redirect()->back()->with('error', 'Query not found.');
        }

        // Delete replies first, then query
        QueryReply::where('query_id', $id)->delete();
        $query->delete();

        return redirect()->route('student.queries')->with('success', 'Query deleted successfully!');
    }

    public function deleteReply($id)
    {
        $studentIdentifier = Auth::user()->identifier;

        $reply = QueryReply::find($id);

        if (!$reply) {
            return redirect()->back()->with('error', 'Reply not found.');
        }

        // Verify the reply belongs to this student's query
        $query = StudentQuery::where('id', $reply->query_id)
            ->where('student_id', $studentIdentifier) // ✅ Verify using identifier
            ->first();

        if (!$query) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $reply->delete();

        return redirect()->route('student.queries')->with('success', 'Reply deleted successfully!');
    }
}