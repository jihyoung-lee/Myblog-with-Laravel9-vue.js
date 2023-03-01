import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
export default defineConfig({
    build: {
        assetsInlineLimit: 0,
    },
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    // The Vue plugin will parse absolute URLs and treat them
                    // as absolute paths to files on disk. Setting this to
                    // `false` will leave absolute URLs un-touched so they can
                    // reference assets in the public directory as expected.
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
});
