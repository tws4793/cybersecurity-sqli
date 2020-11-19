<?php
$doc_root = __DIR__;
require_once($doc_root . '/includes/common.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $row = (isset($_POST['is_secure']) && $_POST['is_secure'] == 'yes') 
        ? getUserSecure($user, $pass, $connection) 
        : getUser($user, $pass, $connection);
    
    if (!is_null($row)) {
        $_SESSION['userid'] = $row['id'];
        $_SESSION['username'] = $user;
        $_SESSION['password'] = $pass;
        $_SESSION['firstName'] = $row['firstname'];
        $_SESSION['lastName'] = $row['lastname'];
        $_SESSION['error'] = null;
        header('Location: user.php');
    } else {
        loginFail('Invalid user credentials!');
    }
} else {
    loginFail('Invalid user credentials!');
}
