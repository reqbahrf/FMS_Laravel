<?php

namespace App\View\Components\CustomInput;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $type,
        public string $id,
        public string $class,
        public string $style,
        public bool $readonly = false,
        public string $value = '',
        public bool $isEditable,
    ) {

        // Ensure isEditable is false when readonly is true
        $this->isEditable = $this->isEditable && !$this->readonly;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-input.input');
    }
}
