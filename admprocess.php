<?php
include('../config/dbconnect.php');

if (isset($_POST['register_account'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists in the database
    $insert = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");
    $num = mysqli_num_rows($insert);

    if($num > 0){
        ?>
        <script>
            alert("Email Already Exists")
            location.href = "../admin/admreg.php";
        </script>
       <?php
    } else {
        // Insert new user data into the database
        $submit = mysqli_query($conn, "INSERT INTO admin (firstname , lastname , email, password) VALUES('$firstname', '$lastname', '$email' , '$password')");
        if($submit == True){
            // Start a session and store user information
            session_start();
            $_SESSION['user_email'] = $email; // Store user's email in session variable
            $_SESSION['user_firstname'] = $firstname; // Store user's first name in session variable

            ?>
            <script>
                alert("Account Created");
                location.href = "../admin/Admintry.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Failed to Create Account");
                location.href = "../admin/admreg.php";
            </script>
            <?php
        }
    }
}
?>
