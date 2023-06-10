<?php
require('../configuration/db_conf.php');
require('../configuration/function.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
}
session_start();

$errors = [];


if (isset($_POST['submit'])) {
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $mobile = sanitizeInput($_POST['mobile']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);

    if (!validateInput($confirmPassword, 'password')) {
        $errors['cnf'] = 'Invalid Confirm Password';
    } elseif ($password != $confirmPassword) {
        $errors['cnf'] = 'Passwords do not match';
    }

    if (!validateInput($mobile, 'mobile')) {
        $errors['mobile'] = 'Invalid Mobile Number';
    }

    if (!validateInput($email, 'email')) {
        $errors['email'] = 'Invalid Email';
    }

    if (!validateInput($username, 'username')) {
        $errors['username'] = 'Invalid username';
    }

    if (!validateInput($password, 'password')) {
        $errors['password'] = 'Invalid Password';
    }
    if ($exists = checkIfExists($pdo, 'SELECT COUNT(*) FROM users WHERE email = ?', [$email])) {
        $errors['emailAlert'] = 'Email already taken';
    }
    if ($exists = checkIfExists($pdo, 'SELECT COUNT(*) FROM users WHERE mobile = ?', [$mobile])) {
        $errors['mobileAlert'] = 'Mobile number already taken';
    }
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        // Prepare and execute the INSERT query
        $stmt = $pdo->prepare('INSERT INTO users (username, email, mobile, password, created_on) 
                VALUES (:username, :email, :mobile, :password, :created_on)');
        $stmt->execute([
            'username' => strtoupper($username),
            'email' => $email,
            'mobile' => $mobile,
            'password' => $hashedPassword,
            'created_on' => strtotime(date('Y-m-d H:i:s'))
        ]);

        header('Location: ../views/login.php');
        exit();
    } else {
        $_SESSION['error'] = $errors;
    }
}
session_regenerate_id();
header('Location: ../views/registration.php');
exit();
