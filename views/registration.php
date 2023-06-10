<?php
header("X-XSS-Protection: 1; mode=block"); 
session_start([
  'use_only_cookies' => 1,
  'cookie_lifetime' => 0,
  'cookie_secure' => 1,
  'cookie_httponly' => 1,
  'cookie_samesite' =>'strict'
]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center align-items-center vh-100">
      <div class="col-md-4">
        <?php include '../controllerModel/message.php'; ?>
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center p-3">Register</h4>
            <form action="../controllerModel/registration.php" method="post" autocomplete="off">
              <div class="mb-3 ">
                <input id="username" class="form-control" type="text" name="username" placeholder="Username" required>
              </div>
              <div class="mb-3">
                <input id="email" class="form-control mb-3" type="email" name="email" placeholder="Email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
              </div>
              <div class="mb-3">
                <input id="mobile" class="form-control mb-3" type="tel" name="mobile" placeholder="Mobile" maxlength="10" required pattern="^[6-9]\d{9}$">
              </div>
              <div class="mb-3 input-group">
                <input id="password" class="form-control" type="password" name="password" placeholder="Password" required autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" title="At least 8 characters, with at least one uppercase letter, one lowercase letter, and one digit">
                <span class="input-group-text toggle-password"><i class="fa-regular fa fa-eye"></i></span>
              </div>
              <div class="mb-3 input-group">
                <input id="confirmPassword" class="form-control" type="password" name="confirmPassword" placeholder="Confirm Password" required>
                <span class="input-group-text ctoggle-password"><i class="fa-regular fa fa-eye"></i></span>
              </div>
              <div id="passwordAlert" class="text-center mb-3"></div>

              <div class="d-flex justify-content-center mb-3">
                <button id="submitButton" type="submit" name="submit" class="btn btn-primary w-40">Submit</button>
              </div>
              <div class="mb-3">
                <p class="text-center mt-3">Already have an account? <a href="./login.php">Login</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
  <script src="../assets/js/script.js" defer></script>
</body>

</html>