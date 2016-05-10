# Keyman Insurance System
### Created with
- [**Laravel 5**](https://laravel.com/)
- [illuminate/html](https://github.com/illuminate/html)
- [laracasts/flash](https://github.com/laracasts/flash)

- [Bootstrap](http://getbootstrap.com/)
- [Select 2](https://select2.github.io/)
- [Font Awesome](https://fortawesome.github.io/Font-Awesome/)

### How to launch the web app
1. install [composer](https://getcomposer.org/)
2. install laravel: `composer global require "laravel/installer"`
3. create a laravel project: `laravel new PROJECT_NAME`
4. `composer require "illuminate/html":"5.0.*"`
5. `composer require laracasts/flash`
6. replace `bindShared()` with `singleton()`
7. copy the files from the zip to the project directory
8. create database in mysql
9. configure the `.env` file
10. `php artisan migrate`
11. `php artisan serve`
12. and there you go!

### Important folders and files
- app (model files)
- app\Http\Controllers (controller methods)
- app\Http\routes.php (routes)
- database\migrations (database tables)
- public\assets (styles, scripts, fonts)
- resources\views (pages)
