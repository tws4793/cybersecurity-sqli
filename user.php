<?php
$doc_root = __DIR__;
require_once($doc_root . '/includes/common.php');
$_SESSION['error'] = null;

if (isLoggedIn()) {

    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];

    if (!is_null($username) && !is_null($userid)) {
        if ($userid == 1) { // Admin
            $query = "SELECT * FROM accounts";

            $labels = [
                'id' => 'ID',
                'firstname' => 'First Name',
                'lastname' => 'Last Name',
                'username' => 'Username',
                'password' => 'Password',
            ];
        } else { // Normal User
            $query = "SELECT * FROM transaction WHERE id = " . $userid;
            $labels = [
                'date' => 'Date',
                'tid' => 'Transaction ID',
                'description' => 'Description',
                'amount' => 'Amount ($)',
                'balance' => 'Balance ($)',
            ];
        }

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $table = generateTables($labels, $result);
    } else {
        header('Location: logout.php');
    }
} else {
    header('Location: logout.php');
}

require_once($doc_root . '/includes/header.php');
?>

<main role="main" class="container">
    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">
            <div class="row">
                <div class="col">
                    <h1>Hello <?php echo $firstName ?>!</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php echo $table ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a class="btn btn-danger" href="logout.php" role="button">Logout</a>
                </div>
            </div>
        </div>
        <div class="col-1">

        </div>
    </div>
</main>

<?php require_once($doc_root . '/includes/footer.php'); ?>