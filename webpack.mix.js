const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Index
 |--------------------------------------------------------------------------
 | ui -filename-> app
 | backend -filename-> backend
 |--------------------------------------------------------------------------
 */

mix.styles([
        'resources/css/frontend/bootstrap/bootstrap.min.css', 
        'resources/css/frontend/bootstrap/bootstrap-theme.min.css', 
        'resources/css/frontend/style.css', 
        'resources/css/frontend/font-awesome.min.css', 
        'resources/css/frontend/flexslider.css', 
        'resources/css/frontend/ionicons.min.css', 
        'resources/css/frontend/magnific-popup.css', 
        'resources/css/frontend/modaal.min.css', 
        'resources/css/frontend/owl.carousel.css', 
        'resources/css/frontend/thunder-bs3-pack.css',
    ], 'public/css/app.css')
    .styles([
        'resources/css/backend/clickable.css', 
        'resources/css/backend/bootstrap.min.css', 
        'resources/css/backend/nucleo-icons.css', 
        'resources/css/backend/black-dashboard.css', 
    ], 'public/css/backend.css')
    .copy('resources/js' , 'public/js')
    .copy('resources/img' , 'public/img')
    .browserSync('http://localhost:8000/dashboard')
;
