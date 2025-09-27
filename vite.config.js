import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/admin/admin.css',
                'resources/js/admin/admin.js',
                'resources/css/facebook.css',
                'resources/js/facebook.js',
                'resources/css/instagram.css',
                'resources/js/instagram.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
