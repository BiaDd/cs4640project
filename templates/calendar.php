<!DOCTYPE html>
<!--
*  REFERENCES
*  Title: Footer
*  Author: Bootstrap Team
*  Code version: Bootstrapv5.1
*  URL: https://getbootstrap.com/docs/5.1/examples/footers/
*  Software License: MIT License
*
*  Calendar built with inspiration from this tutorial: https://www.youtube.com/watch?v=o1yMqPyYeAo&ab_channel=CodeAndCreate
*  Used Bootstrap for calendar styling:
*  URL: https://getbootstrap.com/docs/5.0/getting-started/introduction/ 
*  VERSION: 5.1.1
*  LICENSE: MIT
-->
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Matthew Morelli" />
    <meta name="description" content="PetPals - Pet Organization System" />
    <meta name="keywords" content="organizer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet/less" type="text/css" href="styles/main.less">
    <link rel="stylesheet/less" type="text/css" href="styles/calendar.less">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>PetPals - Calendar</title>


</head>


<body>

    <header id="calendar-index">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-primary">
            <div class="container-fluid">
                <a class="navbar-brand pb-3 pt-2" href="?command=home">
                    <!-- this svg image is under public domain -->
                    <img id="navbar-logo" src="images/paw.svg" alt="paw icon" width="24" height="24"
                        class="d-inline-block align-text-top">
                    &nbsp; PetPals
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarItems"
                    aria-controls="navbarItems" aria-expanded="false" aria-label="Navigation Toggler">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarItems">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="?command=home">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#calendar-index">
                                Calendar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?command=userpage">Profile</a>
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

    <div id="outer-wrapper" class="p-5 m-5 rounded bg-white rounded">
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-2 text-center p-4 rounded border" style="background-color: rgb(250, 235, 215);">
                        <?= $user["username"] ?>'s Calendar</h1>
                </div>
            </div>
            <div class="row mt-3">

                <div class="col-12 col-md-12 col-lg-4 align-items-center">
                    <!-- This button will later link to a calendar event form -->
                    <?php if (!$petError) { ?>
                    <a href="#" class="btn btn-outline-primary my-2" role="button" data-bs-toggle="modal" data-bs-target="#eventModal">Add New</a>
                    <?php } else { ?>
                    <a href="#" class="btn btn-outline-primary my-2 disabled">Add New</a>
                    <div class='alert alert-secondary text-center'>Add some pets to begin adding events!</div>
                    <?php } ?>
                    <div class="card mt-3" style="width: 18rem;">
                        <ul id="upcoming" class="list-group list-group-flush">
                            <!-- These events will be loaded based on the user when we set up DB -->
                            <li class="upcoming-header list-group-item text-center py-2"><strong>Upcoming</strong></li>
                        </ul>
                    </div>
                </div>


                <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title fw-bold" id="eventModalLabel">
                                    Add New Calendar Event
                                </p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="?command=addevent" method="post">
                                    <?php
                                    if (!empty($error_msg)) {
                                        echo "<div class='alert alert-danger'>$error_msg</div>";
                                    }
                                    ?>
                                    <fieldset class="my-3">
                                        <label for="title" class="form-label">Title:</label><br>
                                        <input class="form-control" type="text" id="title" name="title" maxlength="255"
                                            required><br><br>
                                        <label for="pet" class="form-label">Associated Pet:</label><br>
                                        <select class="form-select" name="pet" id="pet" required>
                                        <?php
                                        if (!$petError) {
                                            foreach($pets as $p) {
                                                echo "<option value='$p[name]'>$p[name]</option>";
                                            }
                                        }
                                        ?>
                                        </select><br><br>
                                        <label for="location" class="form-label">Location:</label><br>
                                        <input class="form-control" type="text" id="location" name="location" maxlength="255"
                                            required><br><br>
                                        <label for="desc" class="form-label">Description:</label><br>
                                        <input class="form-control" type="text" id="desc" name="desc" maxlength="255"
                                            required><br><br>
                                        <label for="when" class="form-label">Date/Time:</label><br>
                                        <input class="form-control" type="datetime-local" max="2099-12-31T00:00"
                                            class="form-control" id="when" name="when" required />
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


                <!-- Begin calendar app -->
                <div class="col-12 col-md-12 col-lg-8">
                    <!-- Responsive bootstrap columns -->
                    <div id="cal-app-wrapper" class="rounded p-5 mt-3 border">
                        <!-- wrapper for inner calendar -->
                        <div id="outer-calendar" class="bg-white p-3 col-12 border border-primary rounded">
                            <!-- to provide white background to create beige border -->
                            <div id="month" class="border">
                                <i class="bi bi-arrow-left-circle back fs-2 px-4"></i>
                                <!-- Bootstrap icons for back and next -->
                                <div id="date">
                                    <h1 class="fs-3 text-center"></h1> <!-- calendar.js loads the month here -->
                                    <p class="fs-4 text-center"></p>
                                    <!-- calendar.js loads the full date here (until below 600px) -->
                                    <p id="only-year" class="text-center"></p>
                                    <!-- calendar.js loads year here (until greater than 600px) -->
                                </div>
                                <i class="bi bi-arrow-right-circle next fs-2 px-4"></i>
                            </div>
                            <div id="days" class="fs-3 text-center mt-3">
                                <p>Sun</p>
                                <p>Mon</p>
                                <p>Tue</p>
                                <p>Wed</p>
                                <p>Thu</p>
                                <p>Fri</p>
                                <p>Sat</p>
                            </div>
                            <div class="monthdaynums fs-4 mb-3"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="row" style="margin: 0px;">
        <div class="col-12 bg-light mt-4">
            <footer
                class="d-flex flex-wrap justify-content-between align-items-center p-3 my-4 mx-4 border-top border-bottom">
                <p class="col-md-4 mb-0 text-muted">&copy; 2022 PetPals, Inc</p>

                <a id="bottom-logo" href="#calendar-index"
                    class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <img src="images/paw.svg" alt="paw icon" width="30" height="24">
                </a>

                <ul class="nav col-md-4 justify-content-end" id="fadeshow">
                    <li class="nav-item"><a href="?command=home" class="nav-link px-2 text-muted">Home</a></li>
                    <li class="nav-item"><a href="#calendar-index" class="nav-link px-2 active">Calendar</a></li>
                    <li class="nav-item"><a href="?command=userpage" class="nav-link px-2 text-muted">Profile</a></li>
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


    <!-- /* To make calendar work */ -->
    <script src="scripts/less.js"></script>
    <script src="scripts/calendar.js"></script>
    <script src="scripts/upcoming.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"
        async></script>





</body>

</html>