<?php
// Include your database connection file
include 'db.php';

// Add a debug statement to check if the script is executing
echo "Script is executing.";

// Query to fetch users from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if (!$result) {
    // Print an error message and terminate the script
    die("Error executing query: " . mysqli_error($conn));
}

// Check if any users were found
if (mysqli_num_rows($result) > 0) {
    // Initialize an empty variable to store HTML markup for users
    $usersHTML = '';

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Append HTML markup for each user to the variable
        $usersHTML .= "<div class='user'>";
        $usersHTML .= "<p>Name: " . $row['name'] . "</p>";
        $usersHTML .= "<p>Email: " . $row['email'] . "</p>";
        // Add buttons for edit, update, and delete actions
        $usersHTML .= "<button class='btn btn-success' onclick='editUser(" . $row['id'] . ")'>Edit</button>";
        $usersHTML .= "<button class='btn btn-danger' onclick='deleteUser(" . $row['id'] . ")'>Delete</button>";
        $usersHTML .= "</div>";
    }

    // Echo the HTML markup for all users
    echo $usersHTML;
} else {
    echo "No users found.";
}

// Close database connection
mysqli_close($conn);
?>

