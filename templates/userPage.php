<!DOCTYPE html>

<!--

*  REFERENCES
*  Title: Modal
*  Author: Bootstrap Team
*  Date: 11/23/2021
*  Code version: Bootstrapv5.0
*  URL: https://getbootstrap.com/docs/5.0/components/modal/
*  Software License: MIT license
*
*
* 
* 

-->

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Dan Do & Matthew Morelli" />
    <meta name="description" content="PetPals - Pet Organization System" />
    <meta name="keywords" content="organizer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link rel="stylesheet/less" type="text/css" href="styles/main.less" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <title>PetPals - Profile</title>
</head>

<body>
    <header id="profile">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-primary">
            <div class="container-fluid">
                <a class="navbar-brand pb-3 pt-2" href="?command=home">
                    <!-- this svg image is under public domain -->
                    <img id="navbar-logo" src="images/paw.svg" alt="paw icon" width="24" height="24"
                        class="d-inline-block align-text-top" />
                    &nbsp; PetPals
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarItems"
                    aria-controls="navbarItems" aria-expanded="false" aria-label="Navigation Toggler">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarItems">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="?command=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?command=calendar">Calendar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#profile">Profile</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item ml-auto">
                            <a href="#" class="nav-link navbar-right btn btn-outline-dark m-1" role="button"
                                data-bs-toggle="modal" data-bs-target="#logoutModal">
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

        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title fw-bold" id="logoutModalLabel">
                            Are you sure you want to log out?
                        </p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Confirm by clicking "Yes"</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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
      <div class="row justify-content-center">
        <div class="col-8 my-3">
          <h1 class="fs-2 text-center p-4 rounded border" style="background-color: white;">
            <?= $user["username"] ?>'s Pets</h1>
          </div>
      </div>
      <div class="row justify-content-center">
        <div class="btn-group col-4 mb-3">
            <a href="#" class="btn btn-dark" role="button" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Pet
            </a>
            <?php if (empty($load_msg)) { ?> <!-- If there is no error message (the user has pets and they loaded successfully) -->
            <a href="?command=exportpets" class="btn btn-success" role="button">
                Export Pets (JSON)
            </a>
            <?php } else { ?>
            <a href="#" class="btn btn-success disabled" role="button">
                Export Pets (JSON)
            </a>
            <?php } ?>
        </div>
      </div>

      <!--
        The following section loads either an error message if the user has no pets (or some error occurs)
        or it uses a list generated in userPage() that contains the names of pets.
        I expect that we will figure out a way to reformat this to include more pet data, or even
        use modals and a new function in PetPalsController to show more info onclick.
      -->
      <?php
      if (!empty($load_msg)) {
        echo "<div class='row justify-content-center'>";
        echo "<div class='col-8 text-center alert alert-danger w-50'>$load_msg</div>";
        echo "</div>";
      } else {
        echo "
        <div class='row justify-content-center'>
        <div class='accordion w-50 col-6' id='petAccordion'>";
        foreach ($pets as $p) { // might want to change this name later

          echo "
          <div class='accordion-item'>
            <h2 class='accordion-header' id='$p[id]'>
              <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#$p[animal]$p[id]' aria-expanded='false' aria-controls='$p[animal]$p[id]'>
                $p[name]
              </button>
            </h2>
            <div id='$p[animal]$p[id]' class='accordion-collapse collapse' aria-labelledby='$p[id]' data-bs-parent='#petAccordion'>
              <div class='accordion-body'>
              <form action='?command=editpet' method='post'>
                      <input type='hidden' name='petid' value='$p[id]'>
                      <label for='ename' class='form-label'>Name:</label><br>
                      <input class='form-control' type='text' id='ename' name='ename' value='$p[name]' maxlength='255' required><br><br>
                      <label for='eanimal' class='form-label'>Animal Type:</label><br>
                      <select class='form-select' name='eanimal' id='eanimal' required>
                          <option selected value='$p[animal]'>$p[animal]</option>
                          <option value='Dog'>Dog</option>
                          <option value='Cat'>Cat</option>
                          <option value='Bird'>Bird</option>
                          <option value='Fish'>Fish</option>
                          <option value='Reptile'>Reptile</option>
                          <option value='Rabbit'>Rabbit</option>
                          <option value='Other'>Other</option>
                      </select><br><br>
                      <label for='ebreed' class='form-label'>Breed/Type:</label><br>
                      <input class='form-control' type='text' id='ebreed' name='ebreed' maxlength='255' value='$p[breed]'
                          required><br><br>
                      <label for='eactivities' class='form-label'>Favorite Activities:</label><br>
                      <input class='form-control' type='text' id='eactivities' name='eactivities' maxlength='255' value='$p[activities]'
                          required><br><br>
                      <label for='eallergies' class='form-label'>Allergies:</label><br>
                      <input class='form-control' type='text' id='eallergies' name='eallergies' maxlength='255' value='$p[allergies]'
                          required><br><br>
                      <label for='efood' class='form-label'>Preferred Food(s):</label><br>
                      <input class='form-control' type='text' id='efood' name='efood' maxlength='255' value='$p[food]'
                          required><br><br>
                      <label for='ebday' class='form-label'>Birthday:</label><br>
                      <input class='form-control' type='date' min='1950-01-01' max='2099-12-31' value='$p[bday]'
                          class='form-control' id='ebday' name='ebday' required /> <br />

                  <button type='submit' class='btn btn-primary text-white'>Save</button>
                  <a href='#' class='btn btn-danger text-white' role='button' data-bs-toggle='modal' data-bs-target='#delModal$p[id]'>Delete</a>
              </form>
              </div>
            </div>
          </div>

          <div class='modal fade' id='delModal$p[id]' tabindex='-1' aria-labelledby='delModalLabel$p[id]' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <p class='modal-title fw-bold' id='delModalLabel$p[id]'>
                            Are you sure you want to delete this pet?
                        </p>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p class='mb-2'>Confirm by clicking 'Yes'</p>
                        <form class='mt-2' action='?command=deletepet' method='post'>
                            <input type='hidden' name='petid' value='$p[id]'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>
                                Cancel
                            </button>
                            <button type='submit' class='btn btn-danger text-white'>Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
          ";
        }
        echo "
        </div>
        </div>";
      }
      ?>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title fw-bold" id="addModalLabel">
                        Add New Pet - Information Entry
                    </p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="?command=addpet" method="post">
                        <?php
                        if (!empty($error_msg)) {
                          echo "<div class='alert alert-danger'>$error_msg</div>";
                        }
                        ?>
                        <fieldset class="my-3">
                            <label for="name" class="form-label">Name:</label><br>
                            <input class="form-control" type="text" id="name" name="name" maxlength="255"
                                required><br><br>
                            <label for="animal" class="form-label">Animal Type:</label><br>
                            <select class="form-select" name="animal" id="animal" required>
                                <option selected value="Dog">Dog</option>
                                <option value="Cat">Cat</option>
                                <option value="Bird">Bird</option>
                                <option value="Fish">Fish</option>
                                <option value="Reptile">Reptile</option>
                                <option value="Rabbit">Rabbit</option>
                                <option value="Other">Other</option>
                            </select><br><br>
                            <label for="breed" class="form-label">Breed/Type:</label><br>
                            <input class="form-control" type="text" id="breed" name="breed" maxlength="255"
                                required><br><br>
                            <label for="activities" class="form-label">Favorite Activities:</label><br>
                            <input class="form-control" type="text" id="activities" name="activities" maxlength="255"
                                required><br><br>
                            <label for="allergies" class="form-label">Allergies:</label><br>
                            <input class="form-control" type="text" id="allergies" name="allergies" maxlength="255"
                                required><br><br>
                            <label for="food" class="form-label">Preferred Food(s):</label><br>
                            <input class="form-control" type="text" id="food" name="food" maxlength="255"
                                required><br><br>
                            <label for="bday" class="form-label">Birthday:</label><br>
                            <input class="form-control" type="date" min="1950-01-01" max="2099-12-31"
                                class="form-control" id="bday" name="bday" required />
                        </fieldset>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary text-white">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- FOOTER -->
    <div class="row" style="margin: 0px;">
        <div class="col-12 bg-white mt-4">
            <footer
                class="d-flex flex-wrap justify-content-between align-items-center p-3 my-4 mx-4 border-top border-bottom">
                <p class="col-md-4 mb-0 text-muted">&copy; 2022 PetPals, Inc</p>

                <a id="bottom-logo" href="#home"
                    class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <img src="images/paw.svg" alt="paw icon" width="30" height="24" />
                </a>

                <ul class="nav col-md-4 justify-content-end" id="fadeshow">
                    <li class="nav-item">
                        <a href="?command=home" class="nav-link px-2 text-muted">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="?command=calendar" class="nav-link px-2 text-muted">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile" class="nav-link px-2 active">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link px-2 text-muted" role="button" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                            Logout
                        </a>
                    </li>
                </ul>
            </footer>
        </div>
    </div>

    <script src="scripts/less.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"
        async>
    </script>
</body>

</html>
