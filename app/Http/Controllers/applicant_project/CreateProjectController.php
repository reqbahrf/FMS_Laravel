<?php

namespace App\Http\Controllers\applicant_project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return view('components.add-applicant-or-project.project-info-form');
        }
        return view('staff-view.staff-index');
    }
}
