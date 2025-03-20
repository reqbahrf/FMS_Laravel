<?php

namespace App\View\Components\ProjectStatusReportSheet;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;


class NewIndirectEmploymentFromTheProject extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $newIndirectEmploymentFromTheProject,
        public $isEditable
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $totals = $this->calculateTotals();

        return view('components.project-status-report-sheet.new-indirect-employment-from-the-project', [
            'totals' => $totals
        ]);
    }

    /**
     * Safe conversion of string to float
     *
     * @param string|null $value
     * @return float
     */
    private function safeFloatConversion($value): float
    {
        if (is_null($value) || $value === '') {
            return 0;
        }

        // Remove thousand separators if present
        $cleanValue = str_replace(',', '', $value);

        // Simply convert to float
        return floatval($cleanValue);
    }

    /**
     * Calculate totals for the indirect employment data
     *
     * @return array Returns an array containing row totals and grand totals
     */
    public function calculateTotals(): array
    {
        $data = $this->newIndirectEmploymentFromTheProject;

        if (!is_array($data) || empty($data)) {
            return [
                'rows' => [],
                'grand' => [
                    'forward' => [
                        'male' => 0,
                        'female' => 0,
                        'total' => 0
                    ],
                    'backward' => [
                        'male' => 0,
                        'female' => 0,
                        'total' => 0
                    ]
                ]
            ];
        }

        $rowTotals = [];
        $grandTotals = [
            'forward' => [
                'male' => 0,
                'female' => 0,
                'total' => 0
            ],
            'backward' => [
                'male' => 0,
                'female' => 0,
                'total' => 0
            ]
        ];


        foreach ($data as $index => $item) {
            // Map the quarter numbers to their display format
            $quarterDisplay = $this->getQuarterDisplay($item['indirectEmploymentQuarter'] ?? '');

            // Initialize row totals
            $rowTotals[$index] = [
                'indirectEmploymentQuarter' => $quarterDisplay,
                'indirectEmploymentForward' => [
                    'male' => $this->safeFloatConversion($item['indirectEmploymentForward']['male']),
                    'female' => $this->safeFloatConversion($item['indirectEmploymentForward']['female']),
                    'total' => 0
                ],
                'indirectEmploymentBackward' => [
                    'male' => $this->safeFloatConversion($item['indirectEmploymentBackward']['male']),
                    'female' => $this->safeFloatConversion($item['indirectEmploymentBackward']['female']),
                    'total' => 0
                ]
            ];

            // Calculate row totals
            $rowTotals[$index]['indirectEmploymentForward']['total'] =
                $rowTotals[$index]['indirectEmploymentForward']['male'] +
                $rowTotals[$index]['indirectEmploymentForward']['female'];

            $rowTotals[$index]['indirectEmploymentBackward']['total'] =
                $rowTotals[$index]['indirectEmploymentBackward']['male'] +
                $rowTotals[$index]['indirectEmploymentBackward']['female'];

            // Add to grand totals
            $grandTotals['forward']['male'] += $rowTotals[$index]['indirectEmploymentForward']['male'];
            $grandTotals['forward']['female'] += $rowTotals[$index]['indirectEmploymentForward']['female'];
            $grandTotals['backward']['male'] += $rowTotals[$index]['indirectEmploymentBackward']['male'];
            $grandTotals['backward']['female'] += $rowTotals[$index]['indirectEmploymentBackward']['female'];
        }

        // Calculate grand totals
        $grandTotals['forward']['total'] = $grandTotals['forward']['male'] + $grandTotals['forward']['female'];
        $grandTotals['backward']['total'] = $grandTotals['backward']['male'] + $grandTotals['backward']['female'];

        Log::info($rowTotals);
        Log::info($grandTotals);

        return [
            'rows' => $rowTotals,
            'grand' => $grandTotals
        ];
    }

    /**
     * Convert quarter number to display format
     *
     * @param string $quarter
     * @return string
     */
    private function getQuarterDisplay($quarter): string
    {
        switch ($quarter) {
            case '1':
                return '1ˢᵗ Quarter';
            case '2':
                return '2ⁿᵈ Quarter';
            case '3':
                return '3ʳᵈ Quarter';
            case '4':
                return '4ᵗʰ Quarter';
            default:
                return $quarter; // Return as-is if already formatted or unknown
        }
    }
}
