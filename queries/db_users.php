<?php
$servername = "localhost";
$username = "root";
$password = ""; // It is best practice to keep passwords out of your code.
$database = "cd_users";

// Create connection
$UsersConn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($UsersConn->connect_error) {
    die("Connection failed: " . $UsersConn->connect_error);
}

// Perform database operations here (e.g., SELECT, INSERT, UPDATE, DELETE)

// Close the connection when you're done.  Very important!