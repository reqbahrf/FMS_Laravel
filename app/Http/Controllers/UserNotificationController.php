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
           $notifications = Auth::user()->notifications;

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

           return response()->json($notifications);
       }
}
