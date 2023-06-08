<?php
require('../configuration/db_conf.php');
require('../configuration/function.php');
session_start();

$errors = [];
if (isset($_POST['submit'])) {
    $emailMobile = sanitizeInput($_POST['emailMobile']);
    $password = sanitizeInput($_POST['password']);

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
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            session_regenerate_id();

            header('Location: ../views/home');
            exit();
        } else {
            $errors['login'] = 'Wrong Credentials';
        }
    } else {
        $_SESSION['error'] = $errors;
    }
}
$_SESSION['error'] = $errors;
header('Location: ../views/login');
exit();
