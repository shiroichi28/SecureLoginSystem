<?php 
$timeout = 900;
session_start();
// Update the timeout of session cookie
$sessionName = session_name();

if( isset( $_COOKIE[ $sessionName ] ) ) {

    setcookie($sessionName, $_COOKIE[ $sessionName ], [
        'expires' => time() + $timeout,
        'path' => '/',
        'domain' => '127.0.0.0',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    

}

?>