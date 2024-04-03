<?php
session_start(); // Start the session
if (isset($_SESSION['login_status']) && $_SESSION['login_status'] === "success") {
    echo "<script>alert('Logged in successfully');</script>";
    unset($_SESSION['login_status']); 
}


if (isset($_SESSION['update_status']) && $_SESSION['update_status'] === "success") {
    echo "<script>alert('User information updated successfully!');</script>";
    unset($_SESSION['update_status']);
}
if (isset($_SESSION['delete_status']) && $_SESSION['delete_status'] === "success") {
    echo "<script>alert('Account deleted successfully!');</script>";
    unset($_SESSION['delete_status']);
}
if (isset($_SESSION['delete_user_success']) && $_SESSION['delete_user_success'] === true) {
    echo "<script>alert('Account deleted successfully!');</script>";
    unset($_SESSION['delete_user_success']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* CSS styles */

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #A9A9A9;
        }

        .sidebar {
            position: fixed;
            left: -300px; /* Initially hidden */
            top: 0;
            width: 150px;
            height: 100%;
            background-color: gray;
            color: #fff;
            padding: 20px;
            transition: left 0.3s ease; /* Smooth transition */
            z-index: 1;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin-top: 90%;
            margin-left: -15px;
        }

        .sidebar ul li {
            margin-bottom: 50px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            justify-content: space-evenly;
            position: relative;
        }

        .sidebar ul li a:hover {
            color: black;
        }

        .sidebar ul li a::after {
            content: '';
            display: block;
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0%;
            height: 2px;
            color: black;
            background-color: #fff;
            transition: width 0.3s ease;
        }

        .sidebar ul li a:hover::after,
        .sidebar ul li a.active::after {
            width: 100%;
            color: black;
        }

        .logo1 img {
            margin-top: -40px;
            margin-left: 12px;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            background-color: #848884;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 0 20px;
            z-index: 0;
        }

        .navbar .out {
            margin-left: 75rem;
        }

        .content {
            margin-top: 8.35rem;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 500px; /* Limit the maximum width of the modal */
            position: relative;
        }

        .close {
            color: #aaaaaa;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
        }
        

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="#" class="logo1" onclick="toggleSidebar()">
            <img src="../assets/images/tts.png" width="110px" height="auto" alt="">
        </a>
        <ul>
            <li><a href="#" onclick="loadContent('../admin/dashboard.php')">Dashboard</a></li>
            <li><a href="#" onclick="loadContent('../admin/users.php')">Users</a></li>
            <li><a href="#" onclick="loadContent('../admin/adminupd.php')">Account Info</a></li>
            <li><a href="../users/tts.php">Text-to-Speech</a></li>
            <li><a href="../users/Login.php">Log Out</a></li>
        </ul>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <a href="#" class="logo" onclick="toggleSidebar()">
            <img src="../assets/images/tts.png" width="140px" height="140" alt="logo">
        </a>
        <div class="out">Admin Name</div>
    </div>

    <!-- Main Content -->
    <div class="content" id="content">
        <!-- Placeholder for content -->
    </div>

    <!-- Update User Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeUpdateForm()">&times;</span>
            <h2>Update User</h2>
            <form id="updateForm" method="post" action="../admin/updateUser.php">
                <input type="hidden" id="updateId" name="id" value="">
                <label for="firstName">First Name:</label><br>
                <input type="text" id="firstName" name="firstname" required><br>
                <label for="lastName">Last Name:</label><br>
                <input type="text" id="lastName" name="lastname" required><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>
                <span id="togglePassword" class="toggle-password" onclick="togglePasswordVisibility()">
                    <i id="eyeIcon" class=""></i>
                </span>
                <br><br>
                <button type="submit" class="btn2" name="update">Update</button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        function loadContent(url) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("content").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        function deleteUser(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText.trim() === 'success') {
                        loadContent('../users/users.php');
                    } else {
                        alert('Error deleting user.');
                    }
                }
            };
            xhttp.open("POST", "../users/deleteUser.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("delete=1&id=" + id);
        }

        function handleCardClick(cardName) {
            alert('Clicked ' + cardName);
        }

        function openUpdateForm(id, firstname, lastname, email, password) {
            document.getElementById("updateId").value = id;
            document.getElementById("firstName").value = firstname;
            document.getElementById("lastName").value = lastname;
            document.getElementById("email").value = email;
            document.getElementById("password").value = password;
            document.getElementById("updateModal").style.display = "block";
            
            var closeButton = document.querySelector("#updateModal .close");
            closeButton.addEventListener("click", closeUpdateForm);
        }

        function closeUpdateForm() {
            document.getElementById("updateModal").style.display = "none";
        }
        window.onclick = function(event) {
        var modal = document.getElementById("updateModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");

        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }


        window.onload = function() {
            loadContent('../admin/dashboard.php');
        };
    </script>

</body>
</html>
