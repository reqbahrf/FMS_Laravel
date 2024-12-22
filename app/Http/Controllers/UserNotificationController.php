<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserNotificationController extends Controller
{
       public function getUserNotifications(Request $request)
       {
           $notifications = Auth::user()->notifications;

           $timeUnits = [
               ['seconds' => 60, 'text' => 'Just now'],
               ['seconds' => 3600, 'method' => 'diffInMinutes', 'suffix' => ' min ago'],
               ['seconds' => 86400, 'method' => 'diffInHours', 'suffix' => ' hour ago'],
               ['seconds' => 604800, 'method' => 'diffInDays', 'suffix' => ' day ago'],
               ['seconds' => 2592000, 'method' => 'diffInWeeks', 'suffix' => ' week ago'],
               ['method' => 'diffInMonths', 'suffix' => ' month ago']
           ];

           $notifications->transform(function ($notification) use ($timeUnits) {
               $createdAt = Carbon::parse($notification->created_at);
               $now = Carbon::now();
               $diffInSeconds = $createdAt->diffInSeconds($now);

               $timeAgo = 'Just now';
               foreach ($timeUnits as $unit) {
                   if (isset($unit['seconds']) && $diffInSeconds >= $unit['seconds']) {
                       continue;
                   }

                   if (isset($unit['text'])) {
                       $timeAgo = $unit['text'];
                       break;
                   }

                   $method = $unit['method'];
                   $value = round($createdAt->$method($now));
                   $timeAgo = $value . $unit['suffix'];
                   break;
               }
   
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
