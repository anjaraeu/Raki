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

if (!fs.existsSync('resources/fomantic/dist/semantic.css') || !fs.existsSync('resources/fomantic/dist/semantic.min.js')) {
    console.error('Fomantic UI is not built, run `npx gulp build` in resources/semantic folder');
    process.exit(1);
}

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/err.js', 'public/js')
    .extract(['vue', 'jquery', 'axios', 'lang.js', 'clipboard', 'cookie-universal', '@uppy/core', '@uppy/dashboard', '@uppy/golden-retriever'])
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/err.scss', 'public/css')
    .copy('resources/js/sw.js', 'public/js/sw.js')
    .sourceMaps();
