<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Corrected namespace for Notification model

class NotificationController extends Controller
{
    public function markAsRead(Request $request)
    {
        $notification = Notification::find($request->id);
        if ($notification) {
            $notification->read_at = now();
            $notification->save();
            return response()->json(['message' => 'Notification marked as read']);
        }
        return response()->json(['error' => 'Notification not found'], 404);
    }
}

