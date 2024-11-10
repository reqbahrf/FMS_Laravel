<?php

namespace App\View\Components;

use App\Models\Requirement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ApplicantRequirements extends Component
{
    public $businessId;
    public $Requirements;

    /**
     * Create a new component instance.
     */
    public function __construct($businessId)
    {
        $this->$businessId = $businessId;

        $this->Requirements = Requirement::where('business_id', $businessId)->select([
            'id',
            'file_name',
            'file_type',
            'remarks',
            'remark_comments',
            'created_at',
            'updated_at'
        ])->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $Requirements = $this->Requirements;
        return view('components.applicant-requirements', compact('Requirements'));
    }
}
