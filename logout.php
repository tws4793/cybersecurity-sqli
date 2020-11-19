<?php
$doc_root = __DIR__;
require_once($doc_root . '/includes/common.php');

session_destroy();
header('Location: .');
