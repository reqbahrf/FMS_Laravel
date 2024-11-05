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
            input: ['resources/css/app.scss',
                    'resources/js/app.js',
                    'resources/js/applicationPage.js',
                    'resources/js/coopPage.js',
                    'resources/js/staffPage.js',
                    'resources/js/adminPage.js',
                    ],
            refresh: true,
        }),
    ],
});
