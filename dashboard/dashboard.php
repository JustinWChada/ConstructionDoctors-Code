<?php
//accessing data
// Access user data from the session
session_start();

$userId = $_SESSION['user_id'];
$firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'User'; // Optional
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ''; // Optional

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConstructionDoctors - <?php echo $firstName ?></title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style></style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="bi bi-person-circle"></i>
                                <?php echo $firstName ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-question-circle-fill"></i>
                                Enquiries
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-cash-coin"></i>
                                Quotes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-calendar-check-fill"></i>
                                Visits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-envelope-fill"></i>
                                Contact Us
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-gear-fill"></i>
                                Settings
                            </a>
                        </li>
                        <li class="nav-item" aria-disabled="true">
                            <a class="nav-link" href="#">
                                <i class="bi bi-time"></i>
                                <span id="dashboardTime"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 p-0">
                <?php include "statistics.php"; ?>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>
</body>

</html>