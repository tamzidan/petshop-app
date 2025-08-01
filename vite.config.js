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
    // Tambahkan atau modifikasi bagian build di bawah ini
    build: {
        // Ini adalah baris kuncinya.
        // Arahkan output build ke folder public_html/build
        outDir: '../public_html/build', 
    },
});
