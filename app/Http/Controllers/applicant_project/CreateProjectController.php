<?php

namespace App\Http\Controllers\applicant_project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RegistrationService;

class CreateProjectController extends Controller
{
    public function __construct(
        private RegistrationService $registrationService,
    ) {}
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return view('components.add-applicant-or-project.project-info-form');
        }
        return view('staff-view.staff-index');
    }
}
