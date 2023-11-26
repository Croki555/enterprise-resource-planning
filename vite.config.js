import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/js/other/addAttributes.js',
                'resources/js/product/add.js',
                'resources/js/product/show.js',
                'resources/js/product/ajax/show.js',
                'resources/js/product/delete.js',
                'resources/js/product/update.js',
            ],
            refresh: true,
        }),
    ],
});
