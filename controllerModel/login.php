<?php
require('../configuration/db_conf.php');
require('../configuration/function.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die("<h2>Access Denied!</h2> This file is protected and not available to public.");
}
session_start();
$errors = [];
if (isset($_POST['submit'])) {
    $emailMobile = sanitizeInput($_POST['emailMobile']);
    $password = sanitizeInput($_POST['password']);
    if (!validateCSRFToken($_POST['csrf_token'])) {
        $errors['cnf'] = 'Login Error ,Try again';
    }
    if (empty($emailMobile) || empty($password)) {
        $errors['cnf'] = 'All fields required';
    }
    if (!validateInput($password, 'password')) {
        $errors['mobile'] = 'Password does\'nt meet requirement';
    }
    if (!($exists = checkIfExists($pdo, 'SELECT COUNT(*) FROM users WHERE email = ? OR mobile=?', [$emailMobile, $emailMobile]))) {
        $errors['emailAlert'] = 'User is not registered';
    }
    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? OR mobile = ?');
        $stmt->execute([$emailMobile, $emailMobile]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            session_regenerate_id();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            $_SESSION["login_time_stamp"] = time();
            header('Location:../views/home.php');
            exit();
        } else {
            $errors['login'] = 'Wrong Credentials';
        }
    } else {
        $_SESSION['error'] = $errors;
    }
}
$_SESSION['error'] = $errors;
header('Location:../views/login.php');
exit();
