<?php
$doc_root = __DIR__;
require_once($doc_root . '/includes/header.php');

// CHANGE YOUR DATABASE SETTING HERE
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('SQL_FILE', 'sql/create.sql');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
if (!$connection) {
    die('Database Connection Failed: ' . mysqli_error($connection));
}

$query = '';
$sqlScript = file(SQL_FILE);

$message = 'SQL file imported successfully';
$hasError = false;

foreach ($sqlScript as $line) {
    $startWith = substr(trim($line), 0, 2);
    $endWith = substr(trim($line), -1, 1);

    if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
        continue;
    }

    $query = $query . $line;

    if ($endWith == ';') {
        $result = mysqli_query($connection, $query);
        if (!$result) {
            $message = 'Problem in executing the SQL query: <br /><b>' . $query . '</b>';
            $hasError = true;
            break;
        }
        $query = '';
    }
}
?>

<main role="main" class="container">
    <div class="row">
        <div class="col">
            <div class="alert <?php echo $hasError ? 'alert-danger' : 'alert-success'; ?>" role="alert">
                <?php echo $message; ?>
            </div>
            <p <?php echo $hasError ? 'hidden' : ''; ?>>
                <a class="btn btn-primary" href="index.php" role="button">Go to Home</a>
            </p>
        </div>
    </div>
</main>

<?php require_once($doc_root . '/includes/footer.php'); ?>