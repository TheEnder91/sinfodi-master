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

mix
    .styles([
        'resources/vendor/fontawesome-free-5.15.2-web/css/all.min.css',
        'resources/vendor/overlayScrollbars/css/OverlayScrollbars.min.css',
        'resources/css/adminlte.css',
        'resources/vendor/datatables-bs4/css/dataTables.bootstrap4.css',
        'resources/vendor/sweetAlert2/sweetalert2.css',
    ], 'public/css/app.css')

    .js('resources/js/app.js', 'public/js')

    .styles([
        'resources/vendor/jquery/jquery.min.js',
        'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'resources/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'resources/vendor/datatables/jquery.dataTables.js',
        'resources/vendor/datatables-bs4/js/dataTables.bootstrap4.js',
        'resources/vendor/sweetAlert2/sweetalert2.min.js',
    ], 'public/js/vendor.js')

    .copy('resources/vendor/fontawesome-free-5.15.2-web/webfonts', 'public/webfonts')
    .copy('resources/img', 'public/img');

    // .sass('resources/sass/app.scss', 'public/css')
