<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    
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
    }
    .table th {
        background-color: #f2f2f2;
    }
    .table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Button styles */
    .btn {
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
    }
    .btn:hover {
        background-color: red;
        transition: 0.3s ease-in-out;
    }
    </style>

    <div class="main">
        <div class="use"> 
            <center>
            <h2>Users</h2>

        </div>
    
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Created Time</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <?php
            // Include the database connection file
            include("../config/dbconnect.php");
            
            // Check if $conn is set and not null
            if ($conn) {
                $sql = "SELECT id, firstname, lastname, email,created_time FROM users";
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
                        <td><?= $row["created_time"] ?></td>  

                        <td>
                            <form method="post" action="../users/deleteUser.php" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn" name="delete">Delete</button>
                            </form>
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
    </div>
</body>
</html>

