<?php
include("../config/dbconnect.php");

// Retrieve the email from the URL parameter
$email = isset($_GET['email']) ? $_GET['email'] : '';

// Perform a database query to check if the email exists
$query = "SELECT firstname, lastname, email, passwd FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Check if a row was returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch the row
        $row = mysqli_fetch_assoc($result);
        $response = array(
            'success' => true,
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'passwd' => $row['passwd']
        );
    } else {
        // Email not found in the database
        $response = array(
            'success' => false
        );
    }
    // Free result set
    mysqli_free_result($result);
} else {
    // Query failed
    $response = array(
        'success' => false
    );
}

// Close connection
mysqli_close($conn);

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

?>
