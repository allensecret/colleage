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
    .js('resources/js/d3_pie_chart.js','public/js/frontplatform')
    .js('resources/js/d3_bar_graph.js','public/js/frontplatform')
    .js('resources/js/calendar.js','public/js/frontplatform')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/my_css.scss','public/css/frontplatform')
    .sass('resources/sass/calendar.scss','public/css/frontplatform');
