import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true
        }
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
                    'resources/js/coopPage.js',
                    'resources/js/staffPage.js',
                    'resources/js/adminPage.js',],
            refresh: true,
        }),
    ],
});
