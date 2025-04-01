<?php
require "db_management.php";

try {
    // Handle approval/unapproval actions
    if (isset($_POST['action']) && ($_POST['action'] === 'approve' || $_POST['action'] === 'unapprove') && isset($_POST['testimonial_id'])) {
        $testimonialId = intval($_POST['testimonial_id']); // Sanitize the ID
        $isApproved = ($_POST['action'] === 'approve') ? 1 : 0; // 1 for approved, 0 for unapproved

        $stmt = $MgtConn->prepare("UPDATE testimonials SET is_approved = ? WHERE id = ?");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $MgtConn->error);
        }
        $stmt->bind_param("ii", $isApproved, $testimonialId);

        if ($stmt->execute()) {
            // Success!
        } else {
            throw new Exception("Update failed: " . $stmt->error);
        }
        $stmt->close();
        header("Location: " . $_SERVER['REQUEST_URI']); // Redirect to the same page
    }

    // Retrieve testimonials from the database
    $sql = "SELECT * FROM testimonials ORDER BY submission_date DESC";  // Order by date
    $result = $MgtConn->query($sql);

    if ($result === false) {
        throw new Exception("Query failed: " . $MgtConn->error);
    }

    // Assuming you have already established the database connection and it's stored in $Mgtconn

    // Handle saving the reply
    if (isset($_POST['action']) && $_POST['action'] === 'save_reply' && isset($_POST['testimonial_id']) && isset($_POST['reply'])) {
        $testimonialId = intval($_POST['testimonial_id']);
        $comment_reply_date = date("Y-m-d H:i:s");
        $reply = mysqli_real_escape_string($MgtConn, $_POST['reply']); // Sanitize the reply - IMPORTANT!

        $stmt = mysqli_prepare($MgtConn, "UPDATE testimonials SET comment_reply =?,comment_reply_date = ? WHERE id = ?");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . mysqli_error($MgtConn));
        }
        mysqli_stmt_bind_param($stmt, "ssi", $reply, $comment_reply_date, $testimonialId);

        if (mysqli_stmt_execute($stmt)) {
            // Reply saved successfully
            echo "<p style='color: green;'>Reply saved successfully!</p>";  // Optional success message
        } else {
            throw new Exception("Reply save failed: " . mysqli_error($MgtConn));
        }
        mysqli_stmt_close($stmt);
        header("Location: " . $_SERVER['REQUEST_URI']); // Redirect to the same page
    }




} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    $result = null; // Prevent errors later
}
?>

<link rel="stylesheet" href="testimonials/show_testimonials.css" type="text/css">

<h1>Admin - Testimonial Management</h1>

<div id="testimonials-container">
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $testimonialId = $row["id"];
            $name = htmlspecialchars($row["name"]); // Escape for display
            $rating = intval($row["rating"]);
            $comment = htmlspecialchars($row["comment"]);
            $comment_reply = htmlspecialchars($row["comment_reply"]);
            $image = htmlspecialchars($row["image"]); // Escape for display
            $imagePath = htmlspecialchars("../files/uploads/testimonials/$image");
            $isApproved = (bool) $row["is_approved"]; // Cast to boolean
            $submissionDate = $row["submission_date"];

            echo "<div class='testimonial-block'>";

            if ($imagePath) {
                echo "<img src='" . htmlspecialchars($imagePath) . "' alt='Testimonial Image' class='testimonial-image'>"; //Escape
            }

            echo "<p><strong>Name:</strong> " . $name . "</p>";
            echo "<p><strong>Rating:</strong> " . $rating . "/5</p>";
            echo "<p><strong>Comment:</strong> " . nl2br($comment) . "</p>"; // nl2br for line breaks
            echo "<p><strong>Submitted:</strong> " . $submissionDate . "</p>";

            // Approval form
            echo "<form method='post'>";
            echo "<input type='hidden' name='testimonial_id' value='" . $testimonialId . "'>";

            if ($isApproved) {
                echo "<input type='hidden' name='action' value='unapprove'>";
                echo "<button type='submit' class='unapprove-button'>Unapprove</button>";
            } else {
                echo "<input type='hidden' name='action' value='approve'>";
                echo "<button type='submit' class='approve-button'>Approve</button>";
            }

            echo "</form>";
            echo "<button class='reply-button' data-testimonial-id='" . $testimonialId . "'>Reply</button>";

            echo "</div>"; // Close testimonial-block
    
            // Modal Structure (This needs to be inside the loop to create a modal for each testimonial)
            echo '<div id="replyModal-' . $testimonialId . '" class="modal">';
            echo '  <div class="modal-content">';
            echo '    <span class="close" onclick="closeModal(' . $testimonialId . ')">×</span>';
            echo '    <h2>Reply to Testimonial</h2>';
            echo '    <form method="post">';
            echo '      <input type="hidden" name="action" value="save_reply">';
            echo '      <input type="hidden" name="testimonial_id" value="' . $testimonialId . '">';
            echo '      <textarea name="reply" rows="5">' . $comment_reply . '</textarea><br>'; // Display existing reply
            echo '      <button type="submit">Save Reply</button>';
            echo '    </form>';
            echo '  </div>';
            echo '</div>';
        }
        $MgtConn->close();
    } else {
        echo "<p>No testimonials found.</p>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="testimonials/show_testimonials.js"></script>