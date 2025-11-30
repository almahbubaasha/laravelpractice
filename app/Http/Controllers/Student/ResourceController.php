<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SharedResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ResourceController extends Controller
{
    /**
     * Show resource sharing page
     */
    public function index()
    {
        return view('student.resource-sharing');
    }

    /**
     * Get resources shared with this student
     */
    public function list()
    {
        try {
            $student = Auth::user();
            $studentIdentifier = $student->identifier ?? $student->user_id;

            // Get resources shared with this student
            $resources = SharedResource::where('student_identifier', $studentIdentifier)
                                      ->orderBy('created_at', 'desc')
                                      ->get();

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
            $student = Auth::user();
            $studentIdentifier = $student->identifier ?? $student->user_id;

            $resource = SharedResource::where('id', $id)
                                     ->where('student_identifier', $studentIdentifier)
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
     * Delete resource from student's list
     */
    public function delete($id)
    {
        try {
            $student = Auth::user();
            $studentIdentifier = $student->identifier ?? $student->user_id;

            $resource = SharedResource::where('id', $id)
                                     ->where('student_identifier', $studentIdentifier)
                                     ->first();

            if (!$resource) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found'
                ], 404);
            }

            $resource->delete();

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