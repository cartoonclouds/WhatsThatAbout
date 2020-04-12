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
// mix.options({
//   extractVueStyles: true, // Extract .vue component styling to file, rather than inline.
//   // globalVueStyles: file, // Variables file to be imported in every component.
//   // terser: {}, // Terser-specific options. https://github.com/webpack-contrib/terser-webpack-plugin#options
//   // postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });

mix.js('resources/js/bootstrap.js', 'public/js')
    .js('resources/js/app.js', 'public/js');

mix.sass('resources/sass/app.scss', 'public/css')
    .styles([
        'public/css/app.css',
        'resources/css/app.css',
    ], 'public/css/app.css');

mix.copyDirectory('resources/fonts', 'public/assets/fonts')
    .copyDirectory('resources/images', 'public/assets/images');

if (mix.inProduction()) {
    mix.version();
    mix.sourceMaps(true, 'nosources-source-map');
} else {
    mix.sourceMaps();
}
