<?php

require "../db_users.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $user_id = (int) $_POST['user_id'];
    $user_password = $_POST['user_password'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $is_active = isset($_POST['is_active']) ? true : false;

    // Update user data
    $sql = "UPDATE users SET user_password = ?, email = ?, first_name = ?, is_active = ? WHERE user_id = ?";
    $stmt = $MgtConn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssii", $user_password, $email, $first_name, $is_active, $user_id);

        if ($stmt->execute()) {
            $success = "User updated successfully!";

            // Refresh data after update
            $sql = "SELECT user_id, user_password, email, first_name, is_active FROM users WHERE user_id = ?";
            $stmt2 = $MgtConn->prepare($sql);

            if ($stmt2) {
                $stmt2->bind_param("i", $user_id);
                $stmt2->execute();
                $result = $stmt2->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $user_id = $row['user_id'];
                    $user_password = $row['user_password'];
                    $email = $row['email'];
                    $first_name = $row['first_name'];
                    $is_active = (bool) $row['is_active'];
                }

                $stmt2->close();
            }

        } else {
            $error = "Error updating user: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "Error preparing statement: " . $MgtConn->error;
        echo $error;
    }
}