import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import {
    resolve
} from "path";

const aliases = {
    '@assets': '/resources',
    '@core': '/resources/js',
    '@images': '/resources/images',
    '@composables': '/resources/js/composables',
};
const resolvedAliases = Object.fromEntries(
    Object.entries(aliases).map(([key, value]) => [key, resolve(__dirname, value)]),
);
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/scss/all.scss', 'resources/v2/css/sass/style.scss', 'resources/v2/css/bootstrap.min.css'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            ...resolvedAliases,
        },
    },
    build: {
        target: 'esnext'
    }
});
