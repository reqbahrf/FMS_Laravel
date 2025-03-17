// Type declarations for FloatingWindow module
import * as $ from 'jquery';

interface FloatingWindowElements {
    f_window: JQuery<HTMLElement>;
    f_header: JQuery<HTMLElement>;
    f_closeButton: JQuery<HTMLElement>;
    f_content: JQuery<HTMLElement>;
    f_input: JQuery<HTMLInputElement>;
}

export function InitializeFloatingWindow(
    elements: FloatingWindowElements
): void;
