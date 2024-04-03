<?php
session_start(); // Start the session

include("../config/dbconnect.php");

if (isset($_POST["login_submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to check if the email and password combination exists
    $query = mysqli_query($conn, "SELECT id FROM admin WHERE email = '$email' AND password = '$password'");
    $validate = mysqli_num_rows($query);

    if ($validate == 1) {
        // If administrator is found, start a session and store user ID in session variable
        $user_data = mysqli_fetch_assoc($query);
        $_SESSION['admin_id'] = $user_data['id'];
        
        // Set session variable for success message
        $_SESSION['login_status'] = "success";

        // Redirect the administrator to the desired page
        header("Location: ../admin/Admintry.php");
        exit(); // Ensure script execution stops after redirection
    } else {
        // If login is unsuccessful, display an alert and redirect back to the login page
        ?>
        <script>
            alert("Incorrect Email or Password");
            window.location.href = "../admin/admlogin.php";
        </script>
        <?php
        exit(); // Ensure script execution stops after redirection
    }
}
?>
