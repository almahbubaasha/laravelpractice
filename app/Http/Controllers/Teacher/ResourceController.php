<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SharedResource;
use App\Models\TeacherStudent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Show resource sharing page with student list
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

            return view('teacher.resource-sharing', compact('students'));

        } catch (\Exception $e) {
            Log::error('Error loading resource page: ' . $e->getMessage());
            return back()->with('error', 'Error loading page');
        }
    }

    /**
     * Share resource with selected students
     */
    public function share(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'link' => 'nullable|url|max:500',
                'file' => 'nullable|file',
                'students' => 'required|array|min:1',
                'students.*' => 'required|string',
            ]);

            $teacher = Auth::user();
            $resourceName = $request->title;
            $resourceLink = $request->link;
            $studentIds = $request->students;

            $filePath = null;
            $originalName = null;

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                $file->move(public_path('uploads/shared_resources'), $filename);
                $filePath = 'uploads/shared_resources/' . $filename;
            }

            $successCount = 0;

            // Create resource entry for each student
            foreach ($studentIds as $studentId) {
                SharedResource::create([
                    'teacher_id' => $teacher->id,
                    'student_identifier' => $studentId,
                    'resource_name' => $resourceName,
                    'resource_link' => $resourceLink,
                    'file_path' => $filePath,
                    'file_original_name' => $originalName,
                ]);
                
                $successCount++;
            }

            return response()->json([
                'success' => true,
                'message' => "Resource shared with {$successCount} student(s) successfully!"
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error sharing resource: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to share resource: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get teacher's shared resources
     */
    public function list()
    {
        try {
            $teacher = Auth::user();

            $resources = SharedResource::where('teacher_id', $teacher->id)
                                      ->orderBy('created_at', 'desc')
                                      ->get()
                                      ->unique('id');

            return response()->json([
                'success' => true,
                'resources' => $resources
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching resources: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load resources'
            ], 500);
        }
    }

    /**
     * Download resource file
     */
    public function download($id)
    {
        try {
            $teacher = Auth::user();

            $resource = SharedResource::where('id', $id)
                                     ->where('teacher_id', $teacher->id)
                                     ->first();

            if (!$resource || !$resource->file_path) {
                return back()->with('error', 'Resource not found');
            }

            $filePath = public_path($resource->file_path);

            if (!file_exists($filePath)) {
                return back()->with('error', 'File not found');
            }

            return response()->download($filePath, $resource->file_original_name);

        } catch (\Exception $e) {
            Log::error('Error downloading resource: ' . $e->getMessage());
            return back()->with('error', 'Failed to download resource');
        }
    }

    /**
     * Delete resource
     */
    public function delete($id)
    {
        try {
            $teacher = Auth::user();

            // Find all resources with this ID (shared with multiple students)
            $resources = SharedResource::where('teacher_id', $teacher->id)
                                      ->where('id', $id)
                                      ->get();

            if ($resources->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found'
                ], 404);
            }

            // Delete file if exists
            $filePath = $resources->first()->file_path;
            if ($filePath && file_exists(public_path($filePath))) {
                unlink(public_path($filePath));
            }

            // Delete all related resource entries
            SharedResource::where('teacher_id', $teacher->id)
                         ->where('id', $id)
                         ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Resource deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting resource: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete resource'
            ], 500);
        }
    }
}