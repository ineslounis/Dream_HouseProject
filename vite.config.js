import { defineConfig } from 'vite';
import WindiCSS from 'vite-plugin-windicss';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        WindiCSS(),
    ],
});


