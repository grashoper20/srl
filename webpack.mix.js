let mix = require('laravel-mix');
let webpack = require('webpack');

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

mix.autoload({
    jquery: ['$', 'jQuery', 'window.jQuery'],
    tether: ['Tether', 'window.Tether'],
});

mix.webpackConfig({
    plugins: [
        new webpack.ProvidePlugin({
            Popper: ['popper.js', 'default']
        })
    ]
})
    .js('resources/assets/js/app.js', 'public/js')
        .extract(['vue', 'vuex', 'vue-js-modal', 'vue-localstorage', 'vue-router', 'lodash', 'jquery', 'popper.js', 'bootstrap', 'axios', 'moment', 'fuse.js'])
    .sass('resources/assets/sass/app.scss', 'public/css');
