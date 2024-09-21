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
        // Match the host and port for Vite dev server
        host: '67.207.82.128',  // Replace with your server's IP or domain
        port: 5174,  // Ensure the port matches the one you're accessing
        https: false,  // Disable HTTPS if your main app uses HTTP
        cors: {
            origin: ['http://67.207.82.128', 'https://cp-sustain-assistant.test'],
        }
    }
});
