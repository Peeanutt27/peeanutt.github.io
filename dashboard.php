<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <style>
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
            display: flex;
            justify-content: space-evenly;
        }

        .logo1 img{
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
            margin-left:  75rem; /* Adjusted */
        }

        .content {
            margin-top: 8.35rem; /* Adjusted to match the first page */
            padding: 20px;
            display: flex;
            justify-content: center; /* Center the cards horizontally */
            align-items: center; /* Center the cards vertically */
        }

        .card {
            width: 200px;
            height: 200px;
            background-color: #f0f0f0;
            border-radius: 8px;
            margin: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .card:hover {
            background-color: #e0e0e0;
        }
    </style>
    <div class="sidebar" id="sidebar">
        <a href="javascript:void(0);" class="logo1" onclick="toggleSidebar()">
            <img src="../assets/images/tts.png" width="110px" height="auto" alt="">
        </a>
    </div>
    <div class="navbar">
        <a href="javascript:void(0);" class="logo" onclick="toggleSidebar()">
            <img src="../assets/images/tts.png" width="140px" height="140" alt="logo">
        </a>
        <div class="out">Admin Name</div>
    </div>
    <div class="content" id="content">
        <div class="card" onclick="handleCardClick('user')">User</div>
        <div class="card" onclick="handleCardClick('admin-info')">Admin Info</div>
        <div class="card" onclick="handleCardClick('qr-code')">QR Code</div>
        <div class="card" onclick="handleCardClick('text-to-speech')">Text to Speech</div>
    </div>
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

        // Automatically redirect to dashboard when the page loads
        window.onload = function() {
            loadContent('../admin/dashboard.html');
        };
    </script>
</body>
</html>
