<?php
require('../configuration/db_conf.php');
require('../configuration/function.php');

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
