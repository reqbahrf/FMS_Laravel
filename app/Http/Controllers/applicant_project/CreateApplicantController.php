<?php

namespace App\Http\Controllers\applicant_project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateApplicantController extends Controller
{
    public function index()
    {
        return view('components.add-applicant-or-project.applicant-info-form');
    }
}
