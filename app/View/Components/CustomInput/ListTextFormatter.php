<?php

namespace App\View\Components\CustomInput;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListTextFormatter extends Component
{
    /**
     * Create a new component instance.
     */
    /**
     * The delimited text to format.
     *
     * @var string
     */
    public $text;

    /**
     * Whether the component is in editable mode.
     *
     * @var bool
     */
    public $isEditable;

    /**
     * The name attribute for the textarea.
     *
     * @var string
     */
    public $name;

    /**
     * Create a new component instance.
     *
     * @param string $text
     * @param bool $isEditable
     * @param string $name
     * @return void
     */
    public function __construct($text = '', $isEditable = false, $name = '')
    {
        $this->text = $text;
        $this->isEditable = $isEditable;
        $this->name = $name;
    }

    /**
     * Format the delimited text, converting lines starting with * to bullet points.
     *
     * @return string
     */
    public function formattedText()
    {
        if (empty($this->text)) {
            return '';
        }

        $lines = explode("\n", $this->text);
        $formattedLines = [];
        $inList = false;

        foreach ($lines as $line) {
            $trimmedLine = trim($line);

            if (strlen($trimmedLine) > 0 && $trimmedLine[0] === '*') {
                if (!$inList) {
                    $formattedLines[] = '<ul class="">';
                    $inList = true;
                }
                $formattedLines[] = '<li>' . e(trim(substr($trimmedLine, 1))) . '</li>';
            } else {
                if ($inList) {
                    $formattedLines[] = '</ul>';
                    $inList = false;
                }

                if (!empty($trimmedLine)) {
                    $formattedLines[] = '<p>' . e($trimmedLine) . '</p>';
                }
            }
        }

        if ($inList) {
            $formattedLines[] = '</ul>';
        }

        return implode('', $formattedLines);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-input.list-text-formatter');
    }
}
