const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/dropdown.js', 'public/js')
    .js('resources/js/sessionAlert.js', 'public/js/')
    .js('resources/js/checker.js', 'public/js/')
    .js('resources/js/statistics.js', 'public/js/')
    .js('resources/js/sponsorship.js', 'public/js/')
    .js('resources/js/modal.js', 'public/js/')
    .js('resources/js/avatar.js', 'public/js/')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/address-search.scss', 'public/css')
   .sass('resources/sass/address-tomtom.scss', 'public/css')
    .browserSync({
        proxy: 'localhost:8000', open: false,
        notify: false
    });
