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

mix.version()

mix.js('resources/js/app.js', 'public/js').extract(['popper.js', 'jquery', 'bootstrap'])

mix.sass('resources/sass/app.scss', 'public/css/vendor.css')
mix.sass('resources/sass/blog.scss', 'public/css/blog.css')
// mix.sass('resources/sass/style.scss', 'public/css/style.css')
mix.sass('resources/sass/dashboard.scss', 'public/css/dashboard.css')
