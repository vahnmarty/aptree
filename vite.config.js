import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/views/themes/tailwind/assets/sass/app.css',
                'resources/views/themes/tailwind/assets/js/app.js',
            ],
            refresh: true,
        }),
    ],
});