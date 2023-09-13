import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import svgr from "vite-plugin-svgr";

export default defineConfig({
    plugins: [
        svgr(),
        react(),
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/js/app.js',
                'resources/frontend/app.jsx'
            ],
            refresh: true,
        }),
    ],
});
