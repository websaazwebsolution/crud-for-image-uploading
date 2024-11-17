<?php 
include_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $guest_id = $_POST['guest_id'];
    $guest_name = $_POST['guest_name'];
    $guest_email = $_POST['guest_email'];

    // Fetch current image filename from the database
    $sql = "SELECT guest_image FROM guest WHERE guest_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $guest_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Get current image filename
        $row = $result->fetch_assoc();
        $current_image = $row['guest_image'];
    } else {
        echo "No guest found.";
        exit;
    }

    // Prepare SQL statement for updating guest data
    $sql = "UPDATE guest SET guest_name = ?, guest_email = ?";

    // Check if an image was uploaded
    if (!empty($_FILES['guest_image']['name'])) {
        // Handle file upload
        $image_tmp = $_FILES['guest_image']['tmp_name'];
        
        // Get the file extension
        $imageExt = pathinfo($_FILES['guest_image']['name'], PATHINFO_EXTENSION);
        
        // Generate a unique name for the image
        $newImageName = uniqid('img-', true) . "." . strtolower($imageExt);

        // Move uploaded file to target directory (make sure this directory exists)
        move_uploaded_file($image_tmp, "../images/" . basename($newImageName));

        // Add image to SQL statement
        $sql .= ", guest_image = ?";
        
        // Prepare statement with image
        $stmt = $conn->prepare($sql . " WHERE guest_id = ?");
        $stmt->bind_param("sssi", $guest_name, $guest_email, $newImageName, $guest_id);

        // Unlink (delete) the old image file if it exists
        if (!empty($current_image)) {
            $old_image_path = "../images/" . basename($current_image);
            if (file_exists($old_image_path)) {
                unlink($old_image_path);  // Delete old image
            }
        }
        
    } else {
        // Prepare statement without image
        $stmt = $conn->prepare($sql . " WHERE guest_id = ?");
        $stmt->bind_param("ssi", $guest_name, $guest_email, $guest_id);
    }

    // Execute the statement
    if ($stmt->execute()) {
        $successMsg =  "Guest data updated successfully.";
        header("Location: ../index.php?successMsg=Guest updated successfully");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>