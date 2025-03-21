<?php

namespace App\View\Components\ProjectStatusReportSheet;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewEmploymentGenerated extends Component
{
    /**
     * The processed quarters data.
     *
     * @var array
     */
    public $quarters = [];

    /**
     * The maximum quarter number in the data.
     *
     * @var int
     */
    public $maxQuarter = 0;

    /**
     * Create a new component instance.
     *
     * @param array|object $newEmploymentGenerated The employment data structured by quarters
     * @param bool $isEditable Whether the form is editable
     */
    public function __construct(
        public $newEmploymentGenerated = [],
        public $isEditable = false
    ) {
        // Process and prepare the employment data for the view
        $this->processEmploymentData();
    }

    /**
     * Process the employment data structure into a more usable format for the blade.
     *
     * @return void
     */
    private function processEmploymentData(): void
    {
        $data = is_object($this->newEmploymentGenerated)
            ? json_decode(json_encode($this->newEmploymentGenerated), true)
            : (array) $this->newEmploymentGenerated;

        if (empty($data)) {
            $this->quarters = [
                1 => [
                    'noOfMale' => '',
                    'noOfFemale' => '',
                    'noOfEmployees' => '',
                    'noOfPersonWithDisability' => ''
                ]
            ];
            $this->maxQuarter = 1;
            return;
        }

        foreach ($data as $key => $values) {
            if (preg_match('/quarter(\d+)/', $key, $matches)) {
                $quarterNumber = (int) $matches[1];

                $this->maxQuarter = max($this->maxQuarter, $quarterNumber);

                $this->quarters[$quarterNumber] = [
                    'noOfMale' => $values['noOfMale'] ?? '',
                    'noOfFemale' => $values['noOfFemale'] ?? '',
                    'noOfEmployees' => $values['noOfEmployees'] ?? '',
                    'noOfPersonWithDisability' => $values['noOfPersonWithDisability'] ?? ''
                ];
            }
        }
        if (empty($this->quarters)) {
            $this->quarters = [
                1 => [
                    'noOfMale' => '',
                    'noOfFemale' => '',
                    'noOfEmployees' => '',
                    'noOfPersonWithDisability' => ''
                ]
            ];
            $this->maxQuarter = 1;
        }
    }

    /**
     * Get the ordinal suffix for a number (1st, 2nd, 3rd, 4th)
     * Only processes numbers 1-4 as needed for quarters
     *
     * @param int $number The number to get the ordinal suffix for (1-4)
     * @return string The number with its ordinal suffix
     */
    public function getOrdinalSuffix(int $number): string
    {
        if ($number < 1 || $number > 4) {
            return $number . 'th';
        }

        $suffixes = [
            1 => 'st',
            2 => 'nd',
            3 => 'rd',
            4 => 'th'
        ];

        return $number . $suffixes[$number];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.project-status-report-sheet.new-employment-generated');
    }
}
