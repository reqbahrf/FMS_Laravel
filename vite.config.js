import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: false,
            ignored: [
                '**/node_modules/**',
                '**/resources/views/components/**',
                '**/resources/views/staff-view/outputs/**',
                '**/resources/views/application-process-forms/**',
                '**/*.log',
                '**/.git/**',
            ],
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/indexPage.css',
                'resources/css/app.scss',
                'resources/css/staffPage.css',
                'resources/css/adminPage.css',
                'resources/css/coopPage.css',
                'resources/js/app.ts',
                'resources/js/application-page.js',
                'resources/js/cooperator/coop-page.js',
                'resources/js/staff/staff-page.js',
                'resources/js/admin/admin-page.js',
                'resources/js/pending-applicant-page.js',
            ],
            refresh: true,
        }),
    ],
});
