<?php
session_start(); // Start the session

include("../config/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    // Get the ID of the user to be deleted
    $id = $_POST["id"];

    // Delete the user from the database
    $sql = "DELETE FROM admin WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Set session variable for success message
        $_SESSION['delete_status'] = "success";
        
        // Redirect back to the admin account info section
        header("Location: ../admin/Admintry.php"); // Ensure no other output is sent
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    $conn->close();
}
?>
