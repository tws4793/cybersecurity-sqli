# SQL Injection Demonstration

IS613 Cybersecurity Technology & Applications<br />
Project<br />
AY2019-20 Term 1

## About

Our project will explore one of the many classical code-injection techniques of all time - SQL Injection. Knowledge of SQL Injection as a weakness in many legacy applications will help the audience to be aware of what they can do to protect these systems. Through the demo, we hope that the audience will gain a better understanding of how SQL Injection works with a hypothetical scenario of a bank.

## Requirements

- Apache 2.4+
- PHP 5.6+ or 7.0+
- MySQL 5.7+

You may also install:
- for Windows, [WampServer](https://www.wampserver.com/en/)
- for Mac, [MAMP](https://www.mamp.info/en/mac/)

You may alternatively use docker, as outlined in the steps below.

## Setup

### Using Local Machine (e.g. WAMP)

1. Copy the contents of this entire directory into the `www` directory, or in another directory (e.g. `app`) inside the `www` directory, which can be located inside your web server directory (e.g. **wamp**).
2. Edit the settings in `includes/common.php` and `bootstrap.php` to point the connection to your database. See below.
3. Either:
    1. Login to your phpMyAdmin or SQL client and import the file `sql/create.sql`.
    2. Use the bootstrap file directly by navigating to `localhost/<directory>/bootstrap.php`.

The settings to edit in `includes/common.php` and `bootstrap.php` are:
```php
// CHANGE YOUR DATABASE SETTING HERE
define('DB_HOST', 'localhost'); // You may leave this intact unless you're using a different host
define('DB_USER', 'root'); // Your username
define('DB_PASS', ''); // Your password
define('DB_NAME', 'sqli'); // Change if the name of the database is different
```

### Using Docker

1. Clone the repository [solodyagin/docker-compose-wamp](https://github.com/solodyagin/docker-compose-wamp): `git clone https://github.com/solodyagin/docker-compose-wamp`.
2. `cd docker-compose-wamp`.
3. Follow the steps in **Using Local Machine (e.g. WAMP)**.
4. `docker-compose up`.

## Usage

Navigate to your home directory `localhost/<directory>/` and login with any user listed in the SQL accounts table.

### Inducing an SQL Injection

To induce an SQL injection, type the following into the username field:

```
' OR 1=1 --
```

This causes the actual SQL query to become:

```
SELECT * FROM accounts WHERE username='' OR 1=1 -- AND password=''
```

The different components of the SQL Injection are explained below:
- `'` to close the username field
- `OR 1=1` causes the SQL query to always return true regardless of the search criteria
- `--` negates the rest of the command altogether (i.e. the rest of the command becomes a comment)

## Other Resources

Besides this demonstration, there are also other great resources for exploring SQL injection on your own, including from [Hacksplaining](https://www.hacksplaining.com/exercises/sql-injection).

## Disclaimer

This set of codes provided here are intended solely for demonstration purposes only and should ideally not be used on any live deployments.

We also strongly discourage attempting SQL injection on a real website since such attempts will fail (this security vulnerability should have been patched) and will be logged with your IP address.
