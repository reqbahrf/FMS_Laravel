<?php

namespace App\Http\Controllers\applicant_project;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RegistrationService;
use App\Http\Requests\StoreExistingProjectRequest;

class CreateProjectController extends Controller
{
    public function __construct(
        private RegistrationService $registrationService,
    ) {}
    public function index(Request $request)
    {
        $staffId = $request->user()->orgUserInfo->id;
        if ($request->ajax()) {
            return view('components.add-applicant-or-project.project-info-form', compact('staffId'));
        }
        return view('staff-view.staff-index');
    }

    public function storeProjectDetail(StoreExistingProjectRequest $request)
    {
        try {
            $validatedInput = $request->validated();
            $staffId = $request->user()->orgUserInfo->id;
            $this->registrationService->staffRegisterExistingProject($validatedInput, $staffId);
            return response()->json(['message' => 'Project registered successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error storing project detail' . $e->getMessage()], 500);
        }
    }
}
