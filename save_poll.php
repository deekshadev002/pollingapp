<?php
// Include your database connection code here
include 'db.php';

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $question = $_POST['question'];
    $type = $_POST['type'];
    $options = $_POST['options']; // Assuming options are stored as an array

    // Validate and sanitize the data (ensure you perform proper validation and sanitization)

    // Insert the poll data into the database
    $stmt = $conn->prepare("INSERT INTO polls (question, type, options) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $question, $type, json_encode($options)); // Assuming options are stored as JSON string
    if ($stmt->execute()) {
        echo "success"; // Return success message
    } else {
        echo "error"; // Return error message
    }
    $stmt->close();
    $conn->close();
} else {
    echo "error"; // Return error message if form data is not submitted
}
?>

