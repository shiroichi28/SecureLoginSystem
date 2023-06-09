<?php
require('../configuration/db_conf.php');
require('../configuration/function.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
}

if (isset($_POST['email'])) {
    $email = sanitizeInput($_POST['email']);
    $exists = checkIfExists($pdo, 'SELECT COUNT(*) FROM users WHERE email = ?', [$email]);

    echo $exists ? 'Email exists in the database.' : '';
    exit;
}

if (isset($_POST['mobile'])) {
    $mobile = sanitizeInput($_POST['mobile']);
    $exists = checkIfExists($pdo, 'SELECT COUNT(*) FROM users WHERE mobile = ?', [$mobile]);

    echo $exists ? 'Mobile Number exists in the database.' : '';
    exit;
}
if (isset($_POST['emailMobile'])) {
    $emailMobile = sanitizeInput($_POST['emailMobile']);
    $exists = checkIfExists($pdo, 'SELECT COUNT(*) FROM users WHERE mobile = ? OR email = ?', [$emailMobile, $emailMobile]);

    echo $exists ? '' : 'User is not registered';
    exit;
}

