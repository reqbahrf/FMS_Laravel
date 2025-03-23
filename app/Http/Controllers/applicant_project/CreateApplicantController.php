<?php

namespace App\Http\Controllers\applicant_project;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ApplicantInfoRequest;
use App\Services\RegistrationService;

class CreateApplicantController extends Controller
{
    public function __construct(
        private RegistrationService $registrationService
    ) {}
    public function index(Request $request)
    {
        $staffId = $request->user()->orgUserInfo->id;
        if ($request->ajax()) {
            return view('components.add-applicant-or-project.applicant-info-form', compact('staffId'));
        }
        return view('staff-view.staff-index');
    }
    public function storeApplicantDetail(ApplicantInfoRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $result = $this->registrationService->registerApplicant($validated);

            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
