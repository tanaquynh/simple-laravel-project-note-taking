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
 mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/login.js', 'public/js/login.js')
   .js('resources/js/register.js', 'public/js')
   .js('resources/js/note.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css/app.css')
   .css('resources/css/header-sidebar.css', 'public/css')
   .css('resources/css/common.css', 'public/css')
   .sourceMaps();
