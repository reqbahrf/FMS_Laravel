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
     * Processed data for the view, grouped primarily by year
     */
    public $groupedData;

    /**
     * Year totals for quick access
     */
    public $yearTotals;

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
     * Group by year first, then by quarter for subtotals
     */
    private function processData(): void
    {
        $this->groupedData = [];
        $this->yearTotals = [];
        $this->totalGrossSales = 0;

        $items = $this->volumeAndValueProduction ?? [];

        // Debug: Log the extracted items
        Log::debug('VolumeAndValueProduction processData - extracted items:', [
            'itemsCount' => count($items),
            'hasVolumeAndValueKey' => isset($this->volumeAndValueProduction),
            'volumeAndValueProductionKeys' => is_array($this->volumeAndValueProduction) ? array_keys($this->volumeAndValueProduction) : 'not an array'
        ]);

        // Group data by year first, then by quarter
        foreach ($items as $item) {
            $year = $item['salesQuarter']['year'] ?? 'N/A';
            $quarter = $item['salesQuarter']['quarter'] ?? 'N/A';

            if (!isset($this->groupedData[$year])) {
                $this->groupedData[$year] = [];
                $this->yearTotals[$year] = 0;
            }

            if (!isset($this->groupedData[$year][$quarter])) {
                $this->groupedData[$year][$quarter] = [];
            }

            $this->groupedData[$year][$quarter][] = $item;

            // Add to the totals
            $itemGrossSales = NF::parseFormattedNumber($item['grossSales'] ?? 0);
            $this->yearTotals[$year] += $itemGrossSales;
            $this->totalGrossSales += $itemGrossSales;
        }

        // Sort years numerically
        ksort($this->groupedData);

        // Sort quarters within each year using a custom sort function
        foreach ($this->groupedData as $year => $quarters) {
            // Define the quarter order
            $quarterOrder = [
                '1ˢᵗ Quarter' => 1,
                '2ⁿᵈ Quarter' => 2,
                '3ʳᵈ Quarter' => 3,
                '4ᵗʰ Quarter' => 4,
                'N/A' => 5
            ];

            // Custom sort using the quarter order
            uksort($this->groupedData[$year], function ($a, $b) use ($quarterOrder) {
                $orderA = $quarterOrder[$a] ?? 999;
                $orderB = $quarterOrder[$b] ?? 999;
                return $orderA - $orderB;
            });
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
     * Calculate year total - now used in the template
     */
    public function calculateYearTotal($quarters): float
    {
        $total = 0;
        foreach ($quarters as $quarterItems) {
            foreach ($quarterItems as $item) {
                $total += NF::parseFormattedNumber($item['grossSales'] ?? 0);
            }
        }
        return $total;
    }

    /**
     * Define quarter labels for sorting and display
     */
    public function getQuarterOrder(): array
    {
        return [
            '1ˢᵗ Quarter' => 1,
            '2ⁿᵈ Quarter' => 2,
            '3ʳᵈ Quarter' => 3,
            '4ᵗʰ Quarter' => 4,
            'N/A' => 5
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.project-status-report-sheet.volume-and-value-production');
    }
}
