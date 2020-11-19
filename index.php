<?php
$doc_root = __DIR__;
require_once($doc_root . '/includes/common.php');

try {
    if (isLoggedIn()) {
        header('Location: user.php');
    }

    $hasError = (isset($_SESSION['error']) && !is_null($_SESSION['error']));
    $showError = $hasError ? '' : 'hidden';
    $errorMessage = $hasError ? $_SESSION['error'] : '';
} catch (Exception $e) {
    $showError = '';
    $errorMessage = '';
}

require_once($doc_root . '/includes/header.php');
?>

<main role="main" class="container">
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            <form method="post" action="authenticate.php">
                <div class="form-group text-center">
                    <h1>Login</h1>
                </div>
                <div class="form-group">
                    <input type="text" id="username" class="form-control" name="username" placeholder="User" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group" <?php echo $showError; ?>>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" id="is_secure" class="form-check-input" name="is_secure" value="yes">
                    <label class="form-check-label" for="is_secure">Use Secure Login</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
            </form>
        </div>
        <div class="col-3">
        </div>
    </div>
</main>

<?php
require_once($doc_root . '/includes/footer.php');
?>