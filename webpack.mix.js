const mix = require('laravel-mix');
const fs = require('fs');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

if (!fs.existsSync('resources/semantic/dist/semantic.css') || !fs.existsSync('resources/semantic/dist/semantic.min.js')) {
    console.error('Semantic UI is not built, run `npx gulp build` in resources/semantic folder');
    process.exit(1);
}

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/err.js', 'public/js')
    .extract(['vue', 'jquery', 'axios', 'lang.js', 'clipboard', 'cookie-universal', 'dropzone'])
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/err.scss', 'public/css')
    .sourceMaps();
