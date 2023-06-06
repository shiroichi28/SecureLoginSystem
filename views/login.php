<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../assets/css/style.css" />
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4">
          <form action="../controllerModel/login.php" method="post">
            <div class="mb-3">
              <input
                class="form-control"
                type="text"
                name="emailMobile"
                placeholder="Email/Mobile Number"
                required
              />
            </div>

            <div class="mb-3 input-group">
              <input
                class="form-control"
                type="password"
                name="password"
                placeholder="Password"
                required
              />
              <span class="input-group-text">@</span>
            </div>

            <div class="d-flex justify-content-center">
              <button type="submit" name="submit" class="btn btn-primary w-40">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
    <script src="../assets/js/script.js"></script>
  </body>
</html>
