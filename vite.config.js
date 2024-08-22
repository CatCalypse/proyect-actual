import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['public/css/header.css', 'resources/js/app.js', 'resources/sass/app.scss', 'resources/css/app.css'],
            refresh: true,
        }),
    ],
});
