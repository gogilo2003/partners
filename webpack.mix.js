const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
const { exec } = require('child_process');
mix.js('resources/js/partners.js', 'public/js')
    .vue()
    .sass('resources/scss/partners.scss', 'public/css')
    .after(() => {
        exec('php ../../../artisan vendor:publish --force --tag=partners-assets', (res, stdout, stderr) => { console.log(stdout); });
    })
