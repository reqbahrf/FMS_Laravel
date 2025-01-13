<?php

namespace App\Http\Controllers;

use App\Models\ApplicationInfo;
use App\Models\BusinessInfo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\EvaluationScheduleNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;



class ScheduleController extends Controller
{
    public function setEvaluationSchedule(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'application_id' => 'required|integer',
            'business_id' => 'required|integer',
            'evaluation_date' => 'required|date',
        ]);

        try {
            $applicant = User::findOrFail($validated['user_id']);
            $schedule = ApplicationInfo::updateOrCreate(
                ['id' => $validated['application_id']],
                [
                 'business_id' => $validated['business_id'],
                 'Evaluation_date' =>  $validated['evaluation_date'],
                 'application_status' => 'evaluation'
                ]
            );

            // Instantiate the notification
            $notification = new EvaluationScheduleNotification($schedule);

            // Find existing notification
            $existingNotification = $notification->findExisting($applicant);


            if ($existingNotification) {
                // Update the existing notification
                $existingNotification->delete();

                $notification->setIsRescheduled(true);
                $applicant->notify($notification);
            } else {
                // Send a new notification
                $notification->setIsRescheduled(false);
                $applicant->notify($notification);
            }

            $status = $notification->isRescheduled ? 'rescheduled' : 'scheduled';

            return response()
                ->json([
                    'success' => true,
                    'message' => 'Evaluation ' . $status . ' set successfully',
                ]);
        } catch (Exception $e) {
           return response()->json([
               'message' => $e->getMessage()
           ],500);
        }
    }

    public function getScheduledDate(Request $request)
    {

        $validated = $request->validate([
            'application_id' => 'required|integer',
            'business_id' => 'required|integer',
        ]);

        try {

            $scheduled_date = ApplicationInfo::
                where('id', $validated['application_id'])
                ->where('business_id', $validated['business_id'])
                ->select('Evaluation_date')
                ->first();

            if ($scheduled_date->Evaluation_date !== null) {

                $evaluation_date = Carbon::parse($scheduled_date->Evaluation_date)->format('Y-m-d h:i A');

                return response()->json([
                    'Scheduled_date' => $evaluation_date
                ], 200);
            } else {

                return response()->json(['message' => 'Not Scheduled yet']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
