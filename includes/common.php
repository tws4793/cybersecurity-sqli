<?php
session_start();

// CHANGE YOUR DATABASE SETTING HERE
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sqli');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$connection) {
    die('Database Connection Failed: ' . mysqli_error($connection));
}

/**
 * Unset the username and password, sets an error message and return to login page.
 * 
 * @param string $error error message to be displayed
 */
function loginFail($error)
{
    unset($_POST['username'], $_POST['password']);
    $_SESSION['error'] = $error;
    header('Location: .');
}

/**
 * Get a specific user from the database.
 * This function uses the insecure way of querying the database, and is subject to SQL Injection attacks.
 * 
 * Whereas a common query to the database will be in the form of:
 *  SELECT * FROM accounts WHERE username='admin' AND password='password'
 * An attacker can attempt to insert the string "' OR 1=1 --" such that the query will become:
 *  SELECT * FROM accounts WHERE username='' OR 1=1-- AND password=''
 * 
 * @param string $username username of the user
 * @param string $password password of the user
 * @param mixed $connection an object which represents the connection to a MySQL Server
 * @return array|null
 */
function getUser($username, $password, $connection)
{
    $query = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";

    $result = mysqli_query($connection, $query) or
        die('Database Query Failed for Query [' . $query . ']. ' . mysqli_error($connection));
    $row = mysqli_fetch_assoc($result);

    return $row;
}

/**
 * Get a specific user from the database.
 * This function uses the secure way of querying the database with prepared statements.
 * 
 * Any attempts by an attacker to insert the string "' OR 1=1 --" will result in failure,
 * as the queries are parameterised.
 * 
 * @param string $username username of the user
 * @param string $password password of the user
 * @param mixed $connection an object which represents the connection to a MySQL Server
 * @return array|null
 */
function getUserSecure($username, $password, $connection)
{
    $query = "SELECT * FROM accounts WHERE username = ? AND password = ?";

    $statement = mysqli_prepare($connection, $query) or
        die('Database Query Failed for Query [' . $query . ']. ' . mysqli_error($connection));
    mysqli_stmt_bind_param($statement, 'ss', $username, $password);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $id, $firstname, $lastname, $username, $password);

    $result = null;

    while (mysqli_stmt_fetch($statement)) {
        $result = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'password' => $password,
        ];
    }

    return $result;
}

/**
 * Generate tables for presentation following an output from the SQL query.
 * 
 * @param array $labels key-value pair of row key and header
 * @param mixed $sql_result an object from mysqli_query
 * @return string
 */
function generateTables($labels, $sql_result)
{
    $table_html = '<table class="table table-bordered text-white">';

    // Set the table head
    $table_html = $table_html . '<thead><tr>';
    foreach ($labels as $id => $name) {
        $table_html = $table_html . '<th scope="col">' . $name . '</th>';
    }
    $table_html = $table_html . '</tr></thead>';

    // Set the rows
    $table_html = $table_html . '<tbody>';
    while ($row = mysqli_fetch_assoc($sql_result)) {
        $table_html = $table_html . '<tr>';
        foreach ($labels as $id => $name) {
            $table_html = $table_html . '<td>' . $row[$id] . '</td>';
        }
        $table_html = $table_html . '</tr>';
    }
    $table_html = $table_html . '</tbody></table>';

    return $table_html;
}

/**
 * Check whether user is logged in.
 * 
 * @return bool
 */
function isLoggedIn()
{
    return isset($_SESSION['username'], $_SESSION['password']);
}
