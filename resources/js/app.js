
// Import jQuery
import $ from 'jquery';
// Make jQuery globally available for Bootstrap and other libraries that might require it
window.$ = window.jQuery = $;


import * as bootstrap from 'bootstrap';

import * as FilePond from 'filepond';
window.FilePond = FilePond;

import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

FilePond.registerPlugin(FilePondPluginImagePreview);


$(document).ready(function() {
    console.log('jQuery is working');
    // Initialize tooltips for Bootstrap 5
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

