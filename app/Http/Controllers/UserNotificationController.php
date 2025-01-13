<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Actions\CalculateTimeAgo;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
    public function getUserNotifications(Request $request)
    {
        $limit = $request->input('limit', 10); // Default limit of 10 notifications
        $page = $request->input('page', 1);
        
        $notifications = Auth::user()
            ->notifications
            ->sortByDesc('created_at')
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->values();

        $totalNotifications = Auth::user()->notifications->count();
        $unreadCount = Auth::user()->unreadNotifications->count();

        $notifications->transform(function ($notification) {
            $timeAgo = CalculateTimeAgo::execute($notification->created_at);
            return [
                'id' => $notification->id,
                'data' => $notification->data,
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at,
                'time_ago' => $timeAgo,
            ];
        });

        return response()->json([
            'notifications' => $notifications,
            'total' => $totalNotifications,
            'unread' => $unreadCount,
            'has_more' => ($page * $limit) < $totalNotifications
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications->find($id);
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true], 200);
        }
        return response()->json(['success' => false], 404);
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true], 200);
    }
}
