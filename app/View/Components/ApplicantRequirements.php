<?php

namespace App\View\Components;

use Closure;
use App\Models\Requirement;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class ApplicantRequirements extends Component
{
    public $businessId;
    private $Requirements;
    public $filteredUploadedRequirements;
    public $filteredForSubmissionRequirements;

    /**
     * Create a new component instance.
     */
    public function __construct($businessId)
    {
        $this->businessId = $businessId;

        $this->Requirements = Requirement::where('business_id', $businessId)->select([
            'id',
            'file_name',
            'file_link',
            'file_type',
            'remarks',
            'remark_comments',
            'description',
            'created_at',
            'updated_at'
        ])->get();

        $this->filteredUploadedRequirements = $this->Requirements->filter(function ($file) {
            return !($file->file_link === null && $file->remarks === 'For Submission');
        })->map(function ($file) {
            $file->accessLink = URL::signedRoute('Requirements.show', ['id' => $file->id]);
            return $file;
        });

        $this->filteredForSubmissionRequirements = $this->Requirements->filter(function ($file) {
            return ($file->file_link === null && $file->remarks === 'For Submission');
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.applicant-requirements');
    }
}
