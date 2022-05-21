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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('autoprefixer'),
]).browserSync('127.0.0.1:8000').sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig({
    stats: {
        children: true,
    },
});

if (mix.inProduction()) {
    mix.version();
}