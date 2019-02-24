# CMS FlyFF - Open Source
CMS FlyFF is a FlyForFun CMS built with PHP 7.2 and Laravel 5.7.

This project has been created for challenge and purpose a CMS with latest conventions.

## Requirements
- Language: `PHP`
- Framework: `Laravel` 5.7
- Database: `MsSQL` (possible to change DB connection with laravel)
- PHP dependency manager:  `composer`
- ASSET dependency manager:  `npm (need NodeJS)`
- Server Requirments:
    - `PHP >= 7.1.3`
    - `OpenSSL PHP Extension`
    - `PDO PHP Extension`
    - `Mbstring PHP Extension`
    - `Tokenizer PHP Extension`
    - `XML PHP Extension`
    - `Ctype PHP Extension`
    - `JSON PHP Extension`
- Environment:
    - `ACCOUNT_TBL` Need new column `[user_id] [int] NOT NULL default 0`
    - `ACCOUNT_TBL_DETAIL` Need column modify `[regdate] [datetime] -> [datetime2(1)]`

## How to setup CMS FlyFF (from `develop` branch)
- Download or Clone the `develop` branch
- Copy `.env.exemple` to `.env` (.env information can be set in your system environment variables)
- Config your `.env` (only comments parts are needed)
- storage & bootstrap folder should be writable recursively by your web server or Laravel will not run
- Install PHP dependency with `composer install`
- Install ASSET dependency with `npm install & npm run development`
- Generate Application Key with `php artisan key:generate`
- Execute migrations for sql table generation with `php artisan migrate`
- Execute seeder for generate some fakes data with `php artisan db:seed`
- Start CMS with `php artisan serve`
- Login with `admin@email.fr` & `admin`

## Information
- Email configuration are needed for password recovery and email verification system.

## Bug & Security Vulnerabilities
If you discover a bug or security vulnerability, please open an issue. All security vulnerabilities will be promptly addressed.

## Helpful links
- [Laravel doc](https://laravel.com/)
- [Trello](https://trello.com/b/ImR9LrjH/cmsflyff)

## License
CMS-FlyFF is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).