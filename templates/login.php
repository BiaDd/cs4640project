<!DOCTYPE html>
<!--

*  REFERENCES
*  Title: Bootstrap 5 Forms
*  Author: MDBootstrap Team
*  Code version: Bootstrap 5.1.1
*  URL: https://mdbootstrap.com/docs/standard/forms/overview/
*  Software License: MIT license
*

-->

<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Matthew Morelli & Dan Do" />
    <meta name="description" content="PetPals - Pet Organization System" />
    <meta name="keywords" content="organizer" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous"
    />
    <link rel="stylesheet/less" type="text/css" href="styles/main.less" />
    <link rel="stylesheet/less" type="text/css" href="styles/login.less" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    />

    <title>PetPals - Login</title>
  </head>

  <body>
    <header>
      <nav
        class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-primary"
      >
        <a
          id="login-top-logo"
          href="?command=home"
          class="col-4 align-items-center justify-content-center link-dark text-decoration-none"
        >
          <img src="images/paw.svg" alt="paw icon" width="30" height="24" />
        </a>
      </nav>
    </header>

    <div class="container py-5 mt-5">
      <div class="row py-5 d-flex align-items-center justify-content-center">
        <h1 class="text-center fs-2">Welcome Back!</h1>
        <div class="col-xl-6 mb-2">
          <img
            src="images/womananddog.png"
            class="img-fluid"
            alt="login page pet image"
          />
        </div>
        <div class="col-xl-5 offset-xl-1">
          <?php
            if (!empty($error_msg)) {
              echo "<div class='alert alert-danger'>$error_msg</div>";
            }
          ?>
          <form action="?command=login" method="post">

            <!-- Username input -->
            <!-- This regex pattern makes a username have to contrain only letters and numbers, 6-20 chars.
                   https://stackoverflow.com/q/52884164
              -->
            <div class="form-outline mb-4">
              <label class="form-label" for="username">Username</label>
              <input
                type="username"
                name="username"
                id="username"
                pattern="[A-Za-z0-9]{6,20}"
                class="form-control form-control-lg"
                required
              />
            </div>
            
            <!-- Email input -->
            <!-- Removed email from login, would like to use username.
            <div class="form-outline mb-4">
              <label class="form-label" for="email">Email Address</label>
              <input
                type="email"
                name="email"
                id="email"
                class="form-control form-control-lg"
                required
              />
            </div>
            -->

            <!-- Password input -->
            <div class="form-outline mb-4">
              <!-- This regex pattern makes a password have to contain one number one letter one special and 8 chars
                   https://stackoverflow.com/a/21456918
              -->
              <label class="form-label" for="password">Password</label>
              <input
                type="password"
                name="password"
                id="password"
                pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                class="form-control form-control-lg"
                required
              />
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id="rememberMe"
                />
                <label class="form-check-label" for="rememberMe">
                  Remember me
                </label>
                <a class="link-primary" href="#">Forgot password?</a>
              </div>
            </div>

            <!-- Submit button -->
            <div class="col text-center">
              <button type="submit" class="btn btn-primary btn-block btn-lg">
                <span>Sign in</span>
              </button>
            </div>

            <p class="text-center text-muted mt-5 mb-3">
              First visit?
              <a href="?command=signup" class="fw-bold text-body"><u>Register here</u></a>
            </p>
          </form>
        </div>
      </div>
    </div>
    <!-- FOOTER -->

    <div class="row" style="margin: 0px">
      <div class="col-12 bg-white mt-4">
        <footer
          class="d-flex flex-wrap justify-content-between align-items-center p-3 my-4 mx-4 border-top border-bottom"
        >
          <p class="col-md-4 mb-0 text-muted">&copy; 2022 PetPals, Inc</p>

          <a
            id="bottom-logo"
            href="#"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none"
          >
            <img src="images/paw.svg" alt="paw icon" width="30" height="24" />
          </a>
        </footer>
      </div>
    </div>

    <script src="scripts/less.js"></script>
    <script src="scripts/login.js"></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
      integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D"
      crossorigin="anonymous"
      async
    ></script>
  </body>
</html>
