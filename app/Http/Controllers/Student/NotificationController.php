<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Show notification page
     */
    public function index()
    {
        return view('student.notification');
    }

    /**
     * Get all notifications for logged-in student
     */
    public function list()
    {
        try {
            $student = Auth::user();
            $studentIdentifier = $student->identifier ?? $student->user_id;

            // Get notifications for this student, ordered by latest first
            $notifications = Notification::where('student_identifier', $studentIdentifier)
                                        ->orderBy('created_at', 'desc')
                                        ->get();

            return response()->json([
                'success' => true,
                'notifications' => $notifications
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error fetching notifications: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load notifications'
            ], 500);
        }
    }

    /**
     * Delete a notification
     */
    public function delete($id)
    {
        try {
            $student = Auth::user();
            $studentIdentifier = $student->identifier ?? $student->user_id;

            // Find and delete notification (only if it belongs to this student)
            $notification = Notification::where('id', $id)
                                       ->where('student_id', $studentIdentifier)
                                       ->first();

            if (!$notification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Notification not found'
                ], 404);
            }

            $notification->delete();

            return response()->json([
                'success' => true,
                'message' => 'Notification deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting notification: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete notification'
            ], 500);
        }
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($id)
    {
        try {
            $student = Auth::user();
            $studentIdentifier = $student->identifier ?? $student->user_id;

            $notification = Notification::where('id', $id)
                                       ->where('student_id', $studentIdentifier)
                                       ->first();

            if (!$notification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Notification not found'
                ], 404);
            }

            $notification->update(['is_read' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Notification marked as read'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error marking notification as read: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update notification'
            ], 500);
        }
    }
}