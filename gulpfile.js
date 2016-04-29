var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss', 'resources/assets/css');

    mix.styles( [
    	'vendor/bootstrap.css',
    	'vendor/select2.css',
    	'app.css'
    ]);

    mix.scripts( [
    	'vendor/jquery-3.0.0-beta1.js',
    	'vendor/bootstrap.js',
    	'vendor/select2.js'
    ]);

    mix.version(['public/css/all.css', 'public/js/all.js']);
});
