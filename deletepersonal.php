<?php
session_start(); // Start the session

// Include the database connection file
include("../config/dbconnect.php");

if(isset($_POST['delete']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete user from the database
    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Set session variable for delete success message
        $_SESSION['delete_success'] = true;

        // Redirect back to the login page
        header("Location: ../users/Login.php");
        exit(); // Stop further execution
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>

