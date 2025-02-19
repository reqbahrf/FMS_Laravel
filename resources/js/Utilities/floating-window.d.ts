// Type declarations for FloatingWindow module
import * as $ from 'jquery';

interface FloatingWindowElements {
    $content: JQuery<HTMLElement>;
    $input: JQuery<HTMLInputElement>;
    $window: JQuery<HTMLElement>;
    $header: JQuery<HTMLElement>;
    $closeButton: JQuery<HTMLElement>;
}

export function InitializeFloatingWindow(
    elements: FloatingWindowElements
): void;
