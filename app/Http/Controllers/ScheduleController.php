<?php

namespace App\Http\Controllers;

use App\Models\ApplicationInfo;
use App\Models\BusinessInfo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\EvaluationScheduleNotification;

class ScheduleController extends Controller
{
    public function setEvaluationSchedule(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'business_id' => 'required|integer',
            'evaluation_date' => 'required|date',
        ]);

        $applicant = User::findOrFail($validated['user_id']);

        $schedule = ApplicationInfo::updateOrCreate(
            ['business_id' => $validated['business_id']],
            ['Evaluation_date' => $validated['evaluation_date']]
        );

        // Instantiate the notification
        $notification = new EvaluationScheduleNotification($schedule);

        // Find existing notification
        $existingNotification = $notification->findExisting($applicant);

        // Prepare the notification data
        $notificationData = $notification->toArray($applicant);

        if ($existingNotification) {
            // Update the existing notification
            $existingNotification->update(['data' => $notificationData]);

            $applicant->notify(new EvaluationScheduleNotification($existingNotification));
        } else {
            // Send a new notification
            $applicant->notify($notification);
        }

        return response()
            ->json([
                'success' => true,
                'message' => 'Evaluation schedule set successfully',
            ]);
    }
}
