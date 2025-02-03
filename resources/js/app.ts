// Import jQuery
import $ from 'jquery';
// Extend the Window interface to include jQuery
declare global {
    interface Window {
        $: typeof $;
        jQuery: typeof $;
        FilePond: typeof FilePond;
        ApexCharts: typeof ApexCharts;
    }
}
// Make jQuery globally available for Bootstrap and other libraries that might require it
window.$ = window.jQuery = $;

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import * as FilePond from 'filepond';
window.FilePond = FilePond;


import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

FilePond.registerPlugin(FilePondPluginFileValidateType);
FilePond.registerPlugin(FilePondPluginFileValidateSize);
FilePond.registerPlugin(FilePondPluginImagePreview);

import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;


$(document).on('DOMContentLoaded',function() {
    console.log('jQuery is working');
    // Initialize tooltips for Bootstrap 5
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
