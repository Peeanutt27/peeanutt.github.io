<?php
session_start(); // Start the session

include("../config/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Get the updated values from the form
    $id = $_POST["id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Update the user information in the database
    $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', passwd='$password' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Set session variable for success message
        $_SESSION['update_status'] = "success";
        
        // Redirect back to the admin account info section
        header("Location: ../users/view.php"); // Ensure no other output is sent
        
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    $conn->close();
}
?>
