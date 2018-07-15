# CMS FlyFF - Open Source
CMS FlyFF is a FlyForFun CMS built with PHP 7.2 and Laravel 5.6.

This project has been created for challenge and purpose a CMS with latest conventions.

## Requirements
- Language: `PHP`
- Framework: `Laravel` 5.6
- Database: `MsSQL` (possible to change DB connection with laravel)
- Dependency Manager:  `Composer`
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
1. Download or Clone the `develop` branch
2. Copy `.env.exemple` to `.env` (.env information can be set in your system environment variables)
3. Config your `.env` (only comments parts are needed)
4. Storage & bootstrap folder should be writable by your web server or Laravel will not run
5. Install dependency with `composer install`
6. Generate Application Key with `php artisan key:generate`

## Information
- Email configuration are needed for password recovery system.

## Bug & Security Vulnerabilities
If you discover a bug or security vulnerability, please open an issue. All security vulnerabilities will be promptly addressed.

## Helpful links
Trello : https://trello.com/b/ImR9LrjH/cmsflyff

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).