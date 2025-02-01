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
                '**/resources/views/StaffView/outputs/**',
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
                'resources/js/app.js',
                'resources/js/applicationPage.js',
                'resources/js/cooperator/coopPage.js',
                'resources/js/staff/staffPage.js',
                'resources/js/admin/adminPage.js',
            ],
            refresh: true,
        }),
    ],
});
