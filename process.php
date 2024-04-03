<?php
include("../config/dbconnect.php");

if (isset($_POST["login_submit"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to check if the email and password combination exists
    $query = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email' AND passwd = '$password'");
    $validate = mysqli_num_rows($query);

    if ($validate == 1) {
        // If user is found, start a session and store user ID in session variable
        session_start();
        $user_data = mysqli_fetch_assoc($query);
        $_SESSION['user_id'] = $user_data['id'];
        
        // Set session variable for login success message
        $_SESSION['login_success'] = true;

        // Redirect the user to the desired page
        header("Location: ../users/tts.php");
        exit(); // Ensure script execution stops after redirection
    } else {
        // If login is unsuccessful, display an alert and redirect back to the login page
        ?>
        <script>
            alert("Incorrect Email or Password");
            window.location.href="../users/Login.php";
        </script>
        <?php
        exit(); // Ensure script execution stops after redirection
    }
}
?>
