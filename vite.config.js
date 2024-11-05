import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/kitchen.css',
                'resources/js/app.js',
                'resources/js/kitchen.js',
            ],
            refresh: true,
        }),
    ],
});
