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

-->

<html lang="en">

<head>
    <!--
      CS4640 Server URL: https://cs4640.cs.virginia.edu/mjm7ngb/cs4640project/
    -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Dan Do" />
    <meta name="description" content="PetPals - Pet Organization System" />
    <meta name="keywords" content="organizer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link rel="stylesheet/less" type="text/css" href="styles/main.less" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>PetPals - Home</title>
</head>

<body>
    <header id="home">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-primary">
            <div class="container-fluid">
                <a class="navbar-brand pb-3 pt-2" href="#">
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
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        <!-- Decide whether to disable links based on whether user is authenticated -->
                        <li class="nav-item">
                            <?php if ($authenticated) { ?>
                            <a class="nav-link" href="?command=calendar">Calendar</a>
                            <?php } else { ?>
                            <a class="nav-link disabled" href="#">Calendar</a>
                            <?php } ?>
                        </li>
                        <li class="nav-item">
                            <?php if ($authenticated) { ?>
                            <a class="nav-link" href="?command=userpage">Profile</a>
                            <?php } else { ?>
                            <a class="nav-link disabled" href="#">Profile</a>
                            <?php } ?>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">   
                    <!-- Decide whether to show login or logout button based on whether user is authenticated -->
                        <?php if ($authenticated) { ?>
                        <li class="nav-item ml-auto">
                            <a href="#" class="nav-link navbar-right btn btn-outline-dark m-1" role="button"
                                data-bs-toggle="modal" data-bs-target="#logoutModal">
                                Logout
                            </a>
                        </li>
                        <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-dark text-white m-1" role="button" href="?command=login">
                                Login
                            </a>
                        </li>
                        <?php } ?>
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

    <!-- CARDS -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3" style="margin: 0px">
        <div class="col d-flex justify-content-center">
            <div class="card w-75 text-center">
                <a href="?command=userpage"><img src="images/rabbit1.jpg" class="card-img-top"
                        alt="Go to profile feature, rabbit picture" /></a>
                <div class="card-body">
                    <p class="card-title fw-bold">Organize</p>
                    <p class="card-text">
                        Use our organizing feature to simplify how you take care of your
                        pets.
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"></small>
                </div>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <div class="card w-75 text-center">
                <a href="?command=calendar"><img src="images/dog1.jpg" class="card-img-top"
                        alt="Go to calendar feature, cute dog" /></a>
                <div class="card-body">
                    <p class="card-title fw-bold">Plan</p>
                    <p class="card-text">
                        We have an easy to use calendar you can use to organize important
                        pet-related dates.
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"></small>
                </div>
            </div>
        </div>
        <div class="col d-flex justify-content-center">
            <div class="card w-75 text-center">
                <a href="#"><img src="images/cat1.jpg" class="card-img-top"
                        alt="Go to blog feature, cat with hairnet image" /></a>
                <div class="card-body">
                    <p class="card-title fw-bold">Share</p>
                    <p class="card-text">
                        Share your pet-taking tips with other users by making pages about
                        your pet.
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"></small>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4 fs-2 text-center py-3 rounded border bg-white">
        <h1 class="text-center fs-2">Take care of your pets the right way.</h1>
        <!-- Decide whether to show login button based on whether user is authenticated -->
        <?php if ($authenticated === false) { ?>
        <br />
        <a href="?command=login" role="button" class="btn btn-dark" style="border-radius: 25px">
            Login
        </a>
        <?php } ?>
    </div>

    <!--MASONRY-->
    <div class="container py-2">
        <div class="row" data-masonry='{"percentPosition": true }'>
            <div class="col-sm-4 col-md-3 py-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <img src="images/dog1.jpg" alt="Cute dog image" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 py-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <img src="images/bird1.jpg" alt="Green bird image" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 py-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <img src="images/hamster1.jpg" alt="Hamster eating treat image" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 py-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <img src="images/dog2.jpg" alt="chihuahua image" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 py-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <img src="images/cat1.jpg" alt="Cat with hairnet image" />
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 py-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <img src="images/rabbit1.jpg" alt="White rabbit image" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->

    <div class="row" style="margin: 0px">
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
                        <a href="#home" class="nav-link px-2 active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="?command=calendar" class="nav-link px-2 text-muted">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a href="?command=userpage" class="nav-link px-2 text-muted">Profile</a>
                    </li>
                    <!-- Decide whether to show login or logout button based on whether user is authenticated -->
                    <?php if ($authenticated === false) { ?>
                    <li class="nav-item">
                        <a href="?command=login" class="nav-link px-2 text-muted">Login</a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link px-2 text-muted" role="button" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                            Logout
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </footer>
        </div>
    </div>

    <script src="scripts/less.js"></script>
    <script src="scripts/navlinks.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"
        async></script>
</body>

</html>