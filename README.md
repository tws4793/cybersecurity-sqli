# SQL Injection Demonstration

IS613 Cybersecurity Technology & Applications<br />
Project<br />
AY2019-20 Term 1

## About

Our project will explore one of the many classical code-injection techniques of all time - SQL Injection. Knowledge of SQL Injection as a weakness in many legacy applications will help the audience to be aware of what they can do to protect these systems. Through the demo, we hope that the audience will gain a better understanding of how SQL Injection works with a hypothetical scenario of a bank.

## Setup

### Using WAMP / LAMP

1. Copy the contents of this entire directory into the `www` directory inside your WAMP directory. You may put them inside another directory, e.g. `app`, as long as it is within the `www` directory.
2. Login to your phpMyAdmin or SQL client and import the file `sql/create.sql`.
3. Edit the settings in `includes/common.php` to point the connection to your database. The settings to edit are:

```php
// CHANGE YOUR DATABASE SETTING HERE
define('DB_HOST', 'localhost'); // You may leave this intact unless you're using a different host
define('DB_USER', 'root'); // Your username
define('DB_PASS', ''); // Your password
define('DB_NAME', 'sqli'); // Change if the name of the database is different
```

### Using Docker (WAMP / LAMP Stack)

1. Clone the repository [solodyagin/docker-compose-wamp](https://github.com/solodyagin/docker-compose-wamp).
2. `cd docker-compose-wamp`.
3. Follow the steps in **Using WAMP / LAMP**.
4. `docker-compose up`.

## Usage

Navigate to your home directory - it could be `localhost` or `localhost/app` if you stored the contents of the directory in `app`.

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
- `OR 1=1` is the critical component that induces the SQL query to always return true regardless of the search criteria
- `--` negates the rest of the command altogether

## Disclaimer

This set of codes are intended solely for demonstration purposes only and should ideally not be used on a live deployment.
