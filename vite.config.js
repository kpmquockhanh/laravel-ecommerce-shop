import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/scss/all.scss', 'resources/css/font-awesome-4.7.0/css/font-awesome.css'],
            refresh: true,
        }),
    ],
});
