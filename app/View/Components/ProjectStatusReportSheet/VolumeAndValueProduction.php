<?php

namespace App\View\Components\ProjectStatusReportSheet;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Services\NumberFormatterService as NF;

class VolumeAndValueProduction extends Component
{
    /**
     * Project status report data
     */
    public $volumeAndValueProduction;

    /**
     * Is the component editable
     */
    public $isEditable;

    /**
     * Processed data for the view
     */
    public $groupedData;

    /**
     * Total gross sales
     */
    public $totalGrossSales;

    /**
     * Create a new component instance.
     */
    public function __construct($volumeAndValueProduction = [], $isEditable = false)
    {

        $this->volumeAndValueProduction = $volumeAndValueProduction;
        $this->isEditable = $isEditable;

        $this->processData();
    }

    /**
     * Process the volume and value production data
     * Group by year and quarter for subtotals
     */
    private function processData(): void
    {
        $this->groupedData = [];
        $this->totalGrossSales = 0;

        $items = $this->volumeAndValueProduction ?? [];

        // Debug: Log the extracted items
        Log::debug('VolumeAndValueProduction processData - extracted items:', [
            'itemsCount' => count($items),
            'hasVolumeAndValueKey' => isset($this->volumeAndValueProduction),
            'volumeAndValueProductionKeys' => is_array($this->volumeAndValueProduction) ? array_keys($this->volumeAndValueProduction) : 'not an array'
        ]);

        // Group data by year and quarter
        foreach ($items as $item) {
            $year = $item['salesQuarter']['year'] ?? 'N/A';
            $quarter = $item['salesQuarter']['quarter'] ?? 'N/A';

            if (!isset($this->groupedData[$year])) {
                $this->groupedData[$year] = [];
            }

            if (!isset($this->groupedData[$year][$quarter])) {
                $this->groupedData[$year][$quarter] = [];
            }

            $this->groupedData[$year][$quarter][] = $item;
        }

        // Sort years and quarters
        ksort($this->groupedData);
        foreach ($this->groupedData as $year => $quarters) {
            ksort($this->groupedData[$year]);
        }

        // Calculate totals
        foreach ($this->groupedData as $year => $quarters) {
            foreach ($quarters as $quarter => $items) {
                foreach ($items as $item) {
                    $itemGrossSales = NF::parseFormattedNumber($item['grossSales'] ?? 0);
                    $this->totalGrossSales += $itemGrossSales;
                }
            }
        }
    }

    /**
     * Calculate quarter total
     */
    public function calculateQuarterTotal($items): float
    {
        $total = 0;
        foreach ($items as $item) {
            $total += NF::parseFormattedNumber($item['grossSales'] ?? 0);
        }
        return $total;
    }

    /**
     * Calculate year total
     */
    // public function calculateYearTotal($quarters): float
    // {
    //     $total = 0;
    //     foreach ($quarters as $quarterItems) {
    //         foreach ($quarterItems as $item) {
    //             $total += NF::parseFormattedNumber($item['grossSales'] ?? 0);
    //         }
    //     }
    //     return $total;
    // }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.project-status-report-sheet.volume-and-value-production');
    }
}
