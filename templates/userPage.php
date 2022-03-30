<!DOCTYPE html>

<!--

*  REFERENCES
*  Title: <Modal>
*  Author: <Bootstrap Team>
*  Date: <11/23/2021>
*  Code version: <Bootstrapv5.0>
*  URL: <https://getbootstrap.com/docs/5.0/components/modal/>
*  Software License: <MIT license>
*

-->

<html lang="en">
  <head>
    <!--
      CS4640 Server URL: https://cs4640.cs.virginia.edu/mjm7ngb/cs4640project/
      Google Cloud URL: https://storage.googleapis.com/pet-pals/cs4640project/index.html
    -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Dan Do" />
    <meta name="description" content="PetPals - Pet Organization System" />
    <meta name="keywords" content="organizer" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous"
    />
    <link rel="stylesheet/less" type="text/css" href="styles/main.less" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    />

    <title>PetPals - Home</title>
  </head>

  <body>
    <header id="home">
      <nav
        class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-primary"
      >
        <div class="container-fluid">
          <a class="navbar-brand pb-3 pt-2" href="#home">
            <!-- this svg image is under public domain -->
            <img
              id="navbar-logo"
              src="images/paw.svg"
              alt="paw icon"
              width="24"
              height="24"
              class="d-inline-block align-text-top"
            />
            &nbsp; PetPals
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarItems"
            aria-controls="navbarItems"
            aria-expanded="false"
            aria-label="Navigation Toggler"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarItems">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?command=calendar">Calendar</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link btn btn-dark text-white m-1" role="button" href="?command=login">
                  Login
                </a>
              </li>
              <li class="nav-item ml-auto">
                <a
                  href="#"
                  class="nav-link navbar-right btn btn-outline-dark m-1"
                  role="button"
                  data-bs-toggle="modal"
                  data-bs-target="#logoutModal"
                >
                  Logout
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Modal
        I referenced the Bootstrap modal tutorial for this Modal
        -->

      <div
        class="modal fade"
        id="logoutModal"
        tabindex="-1"
        aria-labelledby="logoutModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <p class="modal-title fw-bold" id="logoutModalLabel">
                Are you sure you want to log out?
              </p>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">Confirm by clicking "Yes"</div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <a href="?command=logout" role="button" class="btn btn-primary">
                Yes
              </a>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div>
      <a
        href="#"
        class="btn btn-dark m-4"
        role="button"
        data-bs-toggle="modal"
        data-bs-target="#addModal"
      >
        Add Pet
      </a>
    </div>

    <div
      class="modal fade"
      id="addModal"
      tabindex="-1"
      aria-labelledby="addModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <p class="modal-title fw-bold" id="addModalLabel">
              Add in information about your pet!
            </p>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form action="?command=addPet" method="post">
             <fieldset>
              <legend>Pet information:</legend>


              <label for="name">Name:</label>
              <input type="text" id="name" name="name" required><br><br>
              <label for="type">Type of pet</label>
              <select class="form-select" aria-label="Default select example" name="type" id="type">
                <option selected value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="bird">Bird</option>
                <option value="fish">Fish</option>
                <option value="reptile">Reptile</option>
                <option value="other">Other</option>
              </select><br />
              <label for="breed">Breed:</label>
              <input type="text" id="breed" name="breed" required><br><br>
              <label for="age">Age</label>
              <input type="number" value="0" min="0" step="1" class="form-control currency" id="age" name="age" required/><br />
             </fieldset>
             <button
               type="button"
               class="btn btn-secondary"
               data-bs-dismiss="modal"
             >
               Cancel
             </button>
             <button type="submit" class="btn btn-primary text-white">Add</button>
            </form>
          </div>

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
            href="#home"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none"
          >
            <img src="images/paw.svg" alt="paw icon" width="30" height="24" />
          </a>

          <ul class="nav col-md-4 justify-content-end" id="fadeshow">
            <li class="nav-item">
              <a href="#home" class="nav-link px-2 active">Home</a>
            </li>
            <li class="nav-item">
              <a href="?command=calendar" class="nav-link px-2 text-muted">
                Calendar
              </a>
            </li>
            <li class="nav-item">
              <a href="?command=login" class="nav-link px-2 text-muted">Login</a>
            </li>
            <li class="nav-item">
              <a
                href="#"
                class="nav-link px-2 text-muted"
                role="button"
                data-bs-toggle="modal"
                data-bs-target="#logoutModal"
              >
              Logout
              </a>
            </li>
          </ul>
        </footer>
      </div>
    </div>

    <script src="scripts/less.js"></script>

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
