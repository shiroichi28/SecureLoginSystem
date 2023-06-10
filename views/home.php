<?php
session_start([
    'use_only_cookies' => 1,
    'cookie_lifetime' => 0,
    'cookie_secure' => 1,
    'cookie_httponly' => 1,
    'cookie_samesite' =>'strict'
  ]);
if (isset($_SESSION["user_id"])) {
    if (time() - $_SESSION["login_time_stamp"] > 60) {
        session_unset();
        session_destroy();
        header("Location:./login.php?i=1");
    }
} else {
    header("Location:./login.php");
}
session_regenerate_id();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <h1>Username: <?= htmlspecialchars($_SESSION['user_name']) ?></h1>
    <a href="../controllerModel/logout.php">Logout</a>
    <pre>
    <?php
    echo session_id().'<br>';
    print_r($_SESSION)
    ?>
    </pre>

</body>

</html>