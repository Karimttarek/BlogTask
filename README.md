<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Installation
```bash
git clone https://github.com/Karimttarek/BlogTask.git
```
```bash
cd BlogTask
```
```bash
composer install
```
## Quick startk
rename .env.example to .env

```bash
php artisan key:generate
```
create your database
update .env file
## Database Migration
```bash
php artisan module:migrate Auth
php artisan module:migrate Dashboard
## Contributing
php artisan db:seed
```
## Run The Server
```bash
php artisan serve
```
## At least
you can register and login and also can use the default admin user for the dashboard
[email:admin@test.com,
password:12345678]



