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

mix.js([
    'resources/js/app.js',
    'resources/js/home.js',
    'resources/js/admin/user/list.js',
    'resources/js/admin/user/create.js',
    'resources/js/admin/user/edit.js',
    'resources/js/admin/course/create.js',
    'resources/js/user_course.js',
    'resources/js/teacher/assistance.js',
    'resources/js/teacher/resource.js',
    'resources/js/teacher/note.js',
], 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
