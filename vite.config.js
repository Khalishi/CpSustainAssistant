import { defineConfig } from 'vite';
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
    ],
    server: {
        cors: true, 
        https: false, 
        host: 'localhost', 
        port: 5174, // Ensure this matches your desired port
        hmr: {
            host: 'localhost', 
        },
    },
});

