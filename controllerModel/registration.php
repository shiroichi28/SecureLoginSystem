<?php
require('../configuration/db_conf.php');
require('../configuration/function.php');

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

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
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

            header('Location: ../views/login');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error']=$errors;
        }
    } else {
        $_SESSION['error']=$errors;

    }
}

header('Location: ../views/registration');
exit();
