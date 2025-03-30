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
                    </ul>
                </div>
            </nav>



            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 p-0">
                <?php include "contact_messages/show_messages.php"; ?>
                <div class="dashboard-content" hidden>
                    <div class="dashboard-header">
                        <h1>Dashboard</h1>
                    </div>

                    <div class="row">
                        <!-- Enquiries Card -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-question-circle-fill"></i>
                                    Enquiries
                                </div>
                                <div class="card-body">
                                    <p class="card-text placeholder-data">Total Enquiries: <strong>50</strong></p>
                                    <p class="card-text placeholder-data">New Enquiries Today: <strong>5</strong></p>
                                    <a href="#" class="btn btn-primary">View All Enquiries</a>
                                </div>
                            </div>
                        </div>

                        <!-- Quotes Card -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-cash-coin"></i>
                                    Quotes
                                </div>
                                <div class="card-body">
                                    <p class="card-text placeholder-data">Total Quotes: <strong>120</strong></p>
                                    <p class="card-text placeholder-data">Pending Quotes: <strong>20</strong></p>
                                    <a href="#" class="btn btn-primary">View All Quotes</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Visits Card -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-calendar-check-fill"></i>
                                    Visits
                                </div>
                                <div class="card-body">
                                    <p class="card-text placeholder-data">Scheduled Visits: <strong>35</strong></p>
                                    <p class="card-text placeholder-data">Completed Visits Today: <strong>8</strong></p>
                                    <a href="#" class="btn btn-primary">View All Visits</a>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Us Card -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-envelope-fill"></i>
                                    Contact Us
                                </div>
                                <div class="card-body">
                                    <p class="card-text placeholder-data">New Messages: <strong>10</strong></p>
                                    <p class="card-text placeholder-data">Total Messages: <strong>200</strong></p>
                                    <a href="#" class="btn btn-primary">View All Messages</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Enquiries Table -->
                    <div class="card">
                        <div class="card-header">
                            Recent Enquiries
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>john.doe@example.com</td>
                                            <td>(123) 456-7890</td>
                                            <td>Need a quote for rewiring my house.</td>
                                            <td>2024-07-26</td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith</td>
                                            <td>jane.smith@example.com</td>
                                            <td>(987) 654-3210</td>
                                            <td>Looking for emergency electrical services.</td>
                                            <td>2024-07-25</td>
                                        </tr>
                                        <tr>
                                            <td>David Lee</td>
                                            <td>david.lee@example.com</td>
                                            <td>(555) 123-4567</td>
                                            <td>Interested in solar panel installation.</td>
                                            <td>2024-07-24</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>

</html>