<?php

namespace App\Http\Controllers\applicant_project;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ApplicantInfoRequest;

class CreateApplicantController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return view('components.add-applicant-or-project.applicant-info-form');
        }
        return view('staff-view.staff-index');
    }
    // public function storeApplicantDetail(ApplicantInfoRequest $request): JsonResponse | RedirectResponse
    // {
    //     $validated = $request->validated();
    //     $action = $validated['mode'];
    //     switch ($action) {
    //         // Fill the application form in applicant's stead
    //         case 1:
    //             break;
    //         // Let the applicant fill-up the form by sending the form to the applicant's email
    //         case 2:
    //             break;
    //         default:
    //             throw new Exception('Invalid mode of application');
    //     }
    // }
}
