<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ApplicationInfo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\ApplicationRejectionMail;

class RejectionEmailController extends Controller
{
    public function sendRejectionEmail(Request $request)
    {
         $request->validate([
            'applicant_id' => 'required',
            'application_id' => 'required',
            'rejection_reasons' => 'required|array',
            'other_specify' => 'nullable|string',
            'additional_comments' => 'nullable|string'
        ]);

        try {
            // Get applicant email from your database
            $applicant = User::findOrFail($request->applicant_id);

            $ApplicationStatus = ApplicationInfo::findOrFail($request->application_id);
            $ApplicationStatus->application_status = 'rejected';
            $ApplicationStatus->save();


            // Prepare rejection reasons
            $reasons = $request->rejection_reasons;
            if (in_array('other', $reasons) && $request->other_specify) {
                $reasons = array_diff($reasons, ['other']);
                $reasons[] = $request->other_specify;
            }

            Cache::forget('applicants');

            // Send email
            Mail::to($applicant->email)
                ->send(new ApplicationRejectionMail(
                    $applicant->email,
                    $reasons,
                    $request->additional_comments
                ));

            return response()->json(['success' => true, 'message' => 'Rejection email sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
