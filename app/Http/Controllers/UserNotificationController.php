<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserNotificationController extends Controller
{
    public function getUserNotifications(Request $request)
    {
        $notifications = Auth::user()->notifications;

        $notifications->transform(function ($notification) {
            return [
                'id' => $notification->id,
                'data' => $notification->data,
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at
            ];
        });


        return response()->json($notifications);
    }

}
