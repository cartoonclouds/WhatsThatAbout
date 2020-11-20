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

if (mix.inProduction()) {
    mix.options({
        purifyCss: {
            purifyOptions: {
                minimize: true,
                info    : true,
                rejected: true,
            }
        },
    });
}

mix.js([
    'resources/js/app.js',
    'resources/js/mixins/layout.js',
    'resources/js/mixins/buttons.server-side.js',
], 'public/js');

mix.sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/css/app.css',
    'public/css/app.css',
], 'public/css/app.css');

mix.copyDirectory('resources/fonts', 'public/fonts')
    .copyDirectory('resources/images', 'public/images');

mix.sourceMaps()
    .extract();

if (mix.inProduction()) {
    mix.version();
}

