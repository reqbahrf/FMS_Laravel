// Type declarations for FloatingWindow module
import * as jQuery from 'jquery';

interface FloatingWindowElements {
    $content?: jQuery.JQuery;
    $input?: jQuery.JQuery;
    $window: jQuery.JQuery;
    $header: jQuery.JQuery;
    $closeButton: jQuery.JQuery;
}

export function InitializeFloatingWindow(elements: FloatingWindowElements): void;
