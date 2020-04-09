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

mix.js('resources/js/bootstrap.js', 'public/js');

mix.js([
    'resources/js/app.js',
    //'resources/assets/js/vue/mixins/*',
    ], 'public/js');


mix.sass('resources/sass/app.scss', 'public/css');

//mix.copy('resources/assets/fonts', 'public/assets/fonts');

if (mix.inProduction()) {
    mix.version();
}
