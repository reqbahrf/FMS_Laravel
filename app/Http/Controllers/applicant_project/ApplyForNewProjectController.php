<?php

namespace App\Http\Controllers\applicant_project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GetPersonalRecordService;

class ApplyForNewProjectController extends Controller
{

    public function __construct(
        private GetPersonalRecordService $getPersonalRecordService
    ) {}

    public const DRAFT_TYPE = 'Application_';
    public function index(Request $request)
    {
        $ownerId = $request->user()->id;
        $draft_type = self::DRAFT_TYPE . $ownerId;
        $personalInfo = $this->getPersonalRecordService->getCooperatorPersonalInfo($ownerId);
        return view('registerpage.application', compact('ownerId', 'draft_type', 'personalInfo'));
    }
}
