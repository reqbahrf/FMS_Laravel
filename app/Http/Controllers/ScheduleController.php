<?php

namespace App\Http\Controllers;

use App\Models\applicationInfo;
use App\Models\businessInfo;
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

        $schedule = applicationInfo::updateOrCreate(
            ['business_id' => $validated['business_id']],
            ['Evaluation_date' => $validated['evaluation_date']]
        );

        $applicant->notify(new EvaluationScheduleNotification($schedule));

        return response()
        ->json([
            'success' => true,
            'message' => 'Evaluation schedule set successfully',]);

    }
}
