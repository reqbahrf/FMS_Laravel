<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewRegistrationRequest;
use App\Services\RegistrationService;
use Illuminate\Http\JsonResponse;

class ApplicationController extends Controller
{
    public function __construct(
        private RegistrationService $registrationService,
    ) {}

    public function show($ownerId)
    {
        $draft_type = $this->registrationService->isApplicantHasAssistDraft($ownerId)
            ? $this->registrationService->getDraftType($ownerId)
            : 'Applicant_' . $ownerId;

        return view('registerpage.application', compact('ownerId', 'draft_type'));
    }
    /**
     * Store a new application with all related data
     *
     * @param NewRegistrationRequest $request
     * @return JsonResponse
     */
    public function store(NewRegistrationRequest $request): JsonResponse
    {
        $validatedInputs = $request->validated();

        $result = $this->registrationService->registerApplication($validatedInputs);

        if ($result['status'] === 'success') {
            return response()->json([
                'success' => $result['message'],
                'redirect' => $result['redirect']
            ], 200);
        } else {
            return response()->json(['error' => $result['message']], 500);
        }
    }
}
