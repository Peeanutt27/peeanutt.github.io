<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
</head>
<body>

    <style>
        div.main{
            width: 75%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            vertical-align: middle; /* Added */
        }
        .table th {
            background-color: #f2f2f2;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn,.btn2 {
            display: inline-block;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            font-size: 14px;
            vertical-align: middle; /* Added */
        }
        .btn{
            margin-top: 2px;
        }
        .btn:hover {
            background-color: red;
            transition: 0.3s ease-in-out;
        }
        .btn2:hover {
            background-color: green;
            transition: 0.3s ease-in-out;
        }

        .button2 {
            display: flex;
            justify-content: center;
            margin-top: 250px;
        }
        .button {
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
            text-decoration:none;
        }
        .button:hover {
            padding: 10px 60px;
            transform: translateY(-0px);
            background-color: gray;
            color: black;
            border: none;
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
            background-color: gree;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #31473A;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 10px;

        }
        .modal-content h2{
            margin-left: 175px;
        }
        .modal-content form{
            display:  grid;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content input[type="text"],
        .modal-content input[type="text"],
        .modal-content input[type="email"] {
            width: 300px; 
            padding: 10px;
            border: 1px solid white;
            border-radius: 10px;
            box-sizing: border-box;
            color: black;
            
        }

        /* CSS code */
    .modal-content input[type="password"] {
        width: 300px; /* Adjust width to accommodate checkbox and label */
        padding: 10px;
        border: 1px solid white;
        border-radius: 10px;
        box-sizing: border-box;
        color: black;
        margin-top: 10px;
    }

    .show {
        display: inline-block; /* Ensure the label is displayed inline */
        vertical-align: middle; /* Align the label vertically with the input field */
        margin-left: 5px; /* Add some spacing between the checkbox and the label */
    }

    .modal-content input[type="checkbox"] {
        justify-self: center;
        align-self: center;
        vertical-align: middle; /* Align the checkbox vertically with the input field */
        margin-top: 10px; /* Add some top margin for spacing */
        margin-right: 23px; /* Add some right margin for spacing */
    }


        label.show{
            margin-top: -20px;
            width: 120px;

        }

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        #password{
            margin-top: 10px;
        }

    </style>

    <div class="main">
        <div class="use"> 
            <center>
            <h2>Admin Users</h2>
        </div>
    
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
            // Include the database connection file
            include("../config/dbconnect.php");
            
            // Check if $conn is set and not null
            if ($conn) {
                $sql = "SELECT * FROM admin";
                $result = $conn->query($sql);
                
                // Check if query executed successfully
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
            ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["firstname"] ?></td>      
                            <td><?= $row["lastname"] ?></td>    
                            <td><?= $row["email"] ?></td>
                            <td><?= $row["password"] ?></td>
                            
                            <td>
                                <form method="post" action="../admin/deladm.php" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn" name="delete">Delete</button>
                                </form>
                            </td>
                            <td>
                            <button class="btn2" onclick="openUpdateForm('<?= $row['id'] ?>', '<?= $row['firstname'] ?>', '<?= $row['lastname'] ?>', '<?= $row['email'] ?>', '<?= $row['password'] ?>')">Update</button>
                        </td>

                        </tr>
            <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Error retrieving data</td></tr>";
                }
                
                // Close the database connection
                $conn->close();
            } else {
                echo "<tr><td colspan='6'>Failed to connect to database</td></tr>";
            }
            ?>
        </table>

        <div class="button2">
            <a href="../admin/admreg.php" class="button">Create Admin Account</a>
        </div>
    </div>

    <!-- Update User Modal -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Update User</h2>
            <form id="updateForm" method="post" action="../admin/updateUser.php">
                <input type="hidden" id="updateId" name="id" value="">
                <label for="firstName">First Name:</label><br>
                <input type="text" id="firstName" name="firstname" required><br>
                <label for="lastName">Last Name:</label><br>
                <input type="text" id="lastName" name="lastname" required><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required>
                <input type="checkbox" onclick="togglePasswordVisibility()"><label class="show">Show Password</label>
                <br><br>
                <button type="submit" class="btn2" name="update">Update</button>

            </form>
        </div>
    </div>

    <script>
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

    function displayUpdateAlert() {
        alert("User information updated successfully!");
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


   
            
    </script>


</body>
</html>
