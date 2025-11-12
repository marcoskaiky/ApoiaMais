import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/item-management.js',
                'resources/js/campanhas-categorias.js',
                'resources/js/receber-doacao.js',
                'resources/js/enviar-doacao.js',
                'resources/js/sweet-delete.js'
            ],
            refresh: true,
        }),
    ],
});
