<?php

namespace App\Http\Controllers\applicant_project;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ApplicantInfoRequest;

class CreateApplicantController extends Controller
{
    public function __construct(
        private RegistrationService $registrationService
    ) {}
    public function index(Request $request): Response|View
    {
        $staffId = $request->user()->orgUserInfo->id;
        $isToRetrivedForm = (bool) ($request->header('X-ADD-APPLICANT-FORM') ?? false);
        if ($request->ajax()) {
            if (!$isToRetrivedForm && $this->registrationService->isAddedApplicantExist()) {
                $applicants = $this->registrationService->getAddedApplicants();
                return response()
                    ->view('components.add-applicant-or-project.view-list-of-added-applicant', compact('applicants'))
                    ->withHeaders([
                        'X-ACTION-IN-PROJECT-TAB' => 'view-applicant-list'
                    ]);
            }
            return response()
                ->view('components.add-applicant-or-project.applicant-info-form', compact('staffId'))
                ->withHeaders([
                    'X-ACTION-IN-PROJECT-TAB' => 'add-applicant-form'
                ]);
        }
        return view('staff-view.staff-index');
    }

    public function show(Request $request, $ownerId): View
    {
        if ($request->ajax()) {
            $draft_type = $this->registrationService->getDraftType($ownerId);
            return view('components.detailed-applicant-info-form', compact('ownerId', 'draft_type'));
        }
        return view('staff-view.staff-index');
    }

    public function notify($id): JsonResponse
    {
        try {
            $validated = Validator::make(['id' => $id], [
                'id' => 'required|exists:users,id',
            ])->validate();

            $user = User::find($validated['id']);

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }

            $this->registrationService->sendApplicationFormThroughEmail($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Applicant notified successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $validated = Validator::make(['id' => $id], [
                'id' => 'required|exists:users,id',
            ])->validate();

            $user = User::find($validated['id']);

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }

            $this->registrationService->deleteApplicantDraft($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Applicant draft record deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    public function storeApplicantDetail(ApplicantInfoRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $result = $this->registrationService->staffRegisterApplicant($validated);

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
