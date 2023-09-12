const mix = require('laravel-mix');

// Compile AdminLTE scripts into one file

mix.scripts([
    'public/plugins/jquery/jquery.min.js',
    'public/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'public/plugins/select2/js/select2.full.min.js',
    'public/plugins/sparklines/sparkline.js',
    'public/plugins/moment/moment.min.js',
    'public/plugins/daterangepicker/daterangepicker.js',
    'public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
    'public/plugins/summernote/summernote-bs4.min.js',
    'public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
    'public/dist/js/adminlte.js',
    'public/dist/js/app.js',
    'public/dist/js/demo.js',
    'public/dist/js/pages/dashboard.js',
], 'public/js/adminlte.js');


// Compile AdminLTE styles into one file
mix.styles([
    'public/plugins/fontawesome-free/css/all.min.css',
    'public/dist/css/ionicons.min.css',
    'public/plugins/select2/css/select2.min.css',
    'public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
    'public/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
    'public/dist/css/adminlte.min.css',
    'public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
    'public/plugins/daterangepicker/daterangepicker.css',
    'public/plugins/summernote/summernote-bs4.min.css',
], 'public/css/adminlte.css');