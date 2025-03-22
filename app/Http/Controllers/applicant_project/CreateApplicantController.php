<?php

namespace App\Http\Controllers\applicant_project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateApplicantController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return view('components.add-applicant-or-project.applicant-info-form');
        }
        return view('staff-view.staff-index');
    }
}
