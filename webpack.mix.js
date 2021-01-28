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

mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .js('resources/js/fancybox.js', 'public/js').sourceMaps()
    .js('resources/js/select2.js', 'public/js').sourceMaps();

// mix.scripts([
//     'resources/js/app.js',
//     'resources/js/fancybox.js',
//     'resources/js/select2.js',
// ], 'public/js/full.js');


mix.css('resources/sass/fancybox.css', 'public/css');
mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/admin.scss', 'public/css/admin');
mix.sass('resources/sass/admin-dashboard.scss', 'public/css/admin-dashboard');

