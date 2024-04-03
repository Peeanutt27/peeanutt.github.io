<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Create Account</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color:#EDF4F2;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #A9A9A9;
}

.container1 {
    padding-left: 0px;
    padding-right: 100px;
}


.container h1 {
    text-align: center;
}

.container2 {
    padding-left: 10px;
    width: 400px;
}

.login-container {
    background-color: #31473A;
    padding: 20px;
    border-radius: 5px;
    width: 100%;
    height: 500px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-container h2 {
    text-align: center;
}
.login-form{
    margin-top: 35px;
}

.login-form .form-group {
    margin-bottom: 10px;
    
}
.login-form .form-group a{
    text-decoration:none;
    color:#EDF4F2;
}
.login-form .form-group a:hover {
    color: gray; 
    transition: width 0.3s ease;
}



.login-form input[type="email"],
.login-form input[type="password"] {
    width: calc(100% - 20px); 
    padding: 10px;
    border: 1px solid white;
    border-radius: 10px;
    box-sizing: border-box;
    color: black;
    
}
.login-form input[type="text"] {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid white;
    border-radius: 10px;
    box-sizing: border-box;
    color: black;
}


.login-form .button-container {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.login-form input[type="submit"] {
    font-family: Prata;
    font-weight: 600;
    font-size: 20px;
    color: white;
    background-color: black;
    padding: 10px 70px;
    border: none;
    box-shadow: none;
    border-radius: 50px;
    transition: 786ms;
    transform: translateY(0);
    display: flex;
    flex-direction: row;
    align-items: center;
    cursor: pointer;
    text-transform: uppercase;
   
}

.login-form input[type="submit"]:hover {
    padding: 10px 60px;
    transform: translateY(-0px);
    background-color: gray;
    color: black;
    border: none;
}


.form-name input{
    width: calc(100% - 20px); 
    padding: 10px;
    border: 1px solid #222831;
    border-radius: 10px;
    box-sizing: border-box;
    color: white;
    background-color: #EDF4F2;
}

    </style>
</head>
<body>
    <div class="container1">
        <div class="container">
            <h1><img src="..\assets\images\accept.png" alt="Company Logo"></h1>
        </div>
    </div>
    <div class="container2">
        <div class="login-container">
            <h2>Create Account</h2>
            <form class="login-form" action="../users/reg_process.php" method="POST">   
                <div class="form-name">
                    <label>First Name</label><br>
                    <input type="text" name="firstname" placeholder="First Name"><br><br>

                    <label>Last Name</label><br>
                    <input type="text" name="lastname" placeholder="Last Name">
                </div><br>
                <div class="form-email">
                    <label>Email</label><br>
                    <input type="email" name="email" placeholder="Email">
                    <br><br>
                </div>

                <div class="form-group">
                    <label>Password</label><br>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="show"><label for="show" class="show">Show Password</label>
                </div>
                <div class="button-container">
                    <input type="submit" name="register_account" value="Create Account">
                </div>
                <center>
                <div class="form-group">
                    <p><a href="../users/Login.php">Go Back</a></p>
                </div>
                </center>
            </form>
        </div>
    </div>
    <script>
        document.getElementById("show").addEventListener("change", togglePasswordVisibility);

        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");

            if (this.checked) {
                // Temporarily change input type to "text" to reveal password
                passwordField.setAttribute("type", "text");
            } else {
                // Revert input type back to "password" to mask password
                passwordField.setAttribute("type", "password");
            }
        }


    </script>
</body>
</html>
