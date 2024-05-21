<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required form fields are set
    if (!isset($_POST['question']) || !isset($_POST['options']) || !isset($_POST['workflow'])) {
        echo "Error: All fields are required.";
        exit();
    }

    // Sanitize user input
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $option1 = mysqli_real_escape_string($conn, $_POST['options'][0]);
    $option2 = mysqli_real_escape_string($conn, $_POST['options'][1]);
    $option3 = mysqli_real_escape_string($conn, $_POST['options'][2]);
    $workflow = mysqli_real_escape_string($conn, $_POST['workflow']);

    // Insert question into database using prepared statement
    $query = "INSERT INTO questions (question_text, option1, option2, option3, workflow) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $question, $option1, $option2, $option3, $workflow);

    if (mysqli_stmt_execute($stmt)) {
        echo "Question created successfully.";
    } else {
        echo "Error: Unable to create question.";
        // Log detailed error message for debugging
        error_log("Error creating question: " . mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Error: Invalid request method.";
}
?>




