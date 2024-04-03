<?php
include('../config/dbconnect.php');
if (isset($_POST['register_account'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $insert = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $num = mysqli_num_rows($insert);

        if($num > 0){
            ?>
            <script>
                alert("Email Already Exists")
                location.href = "../users/register.php";
            </script>
           <?php
        } else {
            $submit = mysqli_query($conn, "INSERT INTO users (firstname , lastname , email, passwd) VALUES('$firstname', '$lastname', '$email' , '$password')");
            if($submit == True){
                 ?>
                    <script>
                        alert("Account Created");
                        location.href = "../users/Login.php";
                    </script>
                <?php
            } else {
                ?>
                    <script>
                        alert("Failed to Create Account");
                        location.href = "../users/register.php";
                    </script>
                <?php
            }
        }
    }
// }
?>