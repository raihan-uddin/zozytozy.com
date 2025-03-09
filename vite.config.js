import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/frontend.css',
                'resources/js/app.js',
                'resources/js/frontend.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', // Force assets to go into public/build
        emptyOutDir: true, // Clean outDir before building
        manifest: true, // Ensure manifest.json generated
    },
    server: {
        strictPort: true,
    },
});
