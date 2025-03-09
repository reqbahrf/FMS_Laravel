<?php

namespace App\View\Components\ProjectStatusReportSheet;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EquipmentAndFacilitiesPurchased extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components..project-status-report-sheet.equipment-and-facilities-purchased');
    }
}
