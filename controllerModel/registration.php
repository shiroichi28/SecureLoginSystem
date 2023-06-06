<?php
require_once('../configuration/db_conf.php');
require_once('../configuration/function.php');

session_start();

$error = array();

try {
    if (isset($_POST['submit'])) {
        $username = sanitizeInput($_POST['username']);
        $email = sanitizeInput($_POST['email']);
        $mobile = sanitizeInput($_POST['mobile']);
        $password = sanitizeInput($_POST['password']);
        $confirmPassword = sanitizeInput($_POST['confirmPassword']);

        if (!validateInput($confirmPassword, 'password')) {
            $error['cnf'] = 'Invalid Confirm Password';
        } elseif ($password != $confirmPassword) {
            $error['cnf'] = 'Passwords do not match';
        }

        if (!validateInput($mobile, 'mobile')) {
            $error['mobile'] = 'Invalid Mobile Number';
        }

        if (!validateInput($email, 'email')) {
            $error['email'] = 'Invalid Email';
        }

        if (!validateInput($username, 'username')) {
            $error['username'] = 'Invalid username';
        }

        if (!validateInput($password, 'password')) {
            $error['password'] = 'Invalid Password';
        }

        if (empty($error)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Prepare and execute the INSERT query
            $stmt = $pdo->prepare('INSERT INTO users (username, email, mobile, password, created_on) 
    VALUES (:username, :email, :mobile, :password, :created_on)');
            $stmt->execute([
                'username' => $username,
                'email' => $email,
                'mobile' => $mobile,
                'password' => $hashedPassword,
                'created_on' => strtotime(date('Y-m-d H:i:s'))
            ]);
            header('Location: ../views/login.html');
            exit(); // Add exit() after header to ensure proper redirection
        } else {
            $error['registrationError'] = 'Registration Unsuccessful, Check Inputs';
            $_SESSION['error']=$error;
        }
    }
} catch (PDOException $e) {
    $error['registrationError'] = 'Registration Unsuccessful, Check Inputs';
    $_SESSION['error']=$error;
    header('Location: ../views/registration.html');
    exit();
}
