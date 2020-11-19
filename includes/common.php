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

function loginFail($error)
{
    unset($_POST['username'], $_POST['password']);
    $_SESSION['error'] = $error;
    header('Location: .');
}

function getUser($username, $password, $connection)
{
    $query = "SELECT * FROM accounts WHERE username='$username' and password='$password'";

    $result = mysqli_query($connection, $query) or
        die('Database Query Failed for Query [' . $query . ']. ' . mysqli_error($connection));
    $row = mysqli_fetch_assoc($result);

    return $row;
}

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

function isLoggedIn()
{
    return isset($_SESSION['username'], $_SESSION['password']);
}
