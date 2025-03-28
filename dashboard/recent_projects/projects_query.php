<?php
require "../db_management.php";

$uploadDir = "../../files/uploads/";
if (!file_exists($uploadDir)) {
    if (!mkdir($uploadDir, 0777, true)) {
        echo "Failed to create the upload directory: Contact Developer";
        exit;
    }
}

if (isset($_POST['save_project'])) {
    $project_title = $_POST['project_title'];
    $description = $_POST['description'];
    $created = date("Y-m-d H:i:s");
    $updated = date("Y-m-d H:i:s");

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
        $filename = basename($_FILES["image"]["name"]); // Sanitize filename
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];
        $filepath = $_FILES["image"]["tmp_name"];

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!array_key_exists($ext, $allowed)) {
            echo "Error: Invalid file format.";
            exit;
        }

        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            echo "Error: File size is larger than 5MB.";
            exit;
        }

        if (!in_array($filetype, array_values($allowed))) { // Correct MIME check
            echo "Error: Invalid MIME type";
            exit;
        }

        $newFilename = uniqid() . "_" . $filename; // Unique filename to prevent overwrites
        $destination = $uploadDir . $newFilename;
        if (move_uploaded_file($filepath, $destination)) {
            $imagePath = $destination;
            // *** FIX: Check for prepare failure and report the error ***
            $stmt = $MgtConn->prepare("INSERT INTO projects (project_title,project_description,project_image,created_at,updated_at) VALUES (?, ?, ?, ?, ?)");
            if ($stmt === false) {
                echo "Prepare failed: " . htmlspecialchars($MgtConn->error);  // Echo the error! VERY IMPORTANT
                exit;
            }

            $stmt->bind_param('sssss', $project_title, $description, $filename, $created, $updated);

            if ($stmt->execute()) {
                echo "Project saved successfully!";
            } else {
                // *** FIX:  Report execution error ***
                echo "Failed to save project: " . htmlspecialchars($stmt->error);
            }

            // Close statement
            $stmt->close();


        } else {
            echo "Error: There was a problem uploading your file. Please try again.";
            exit;
        }
    } else {
        echo "Error: No file was uploaded or there was an error during upload.";
        exit;
    }
}

/*
// update_project.php
try {
    // Check if data is received via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['update_id'];
        $project_title = $_POST['update_project_title'];
        $description = $_POST['update_description'];
        $image = $_POST['update_image'];

        // Prepare and execute the update statement
        $stmt = $pdo->prepare("UPDATE projects SET project_title = :project_title, description = :description, image = :image WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':project_title', $project_title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            echo "Project updated successfully!";
        } else {
            echo "Failed to update project.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}*/