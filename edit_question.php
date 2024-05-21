<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM questions WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // Display the form pre-filled with question details
        // You can design the form as per your requirement
        echo "
        <form method='post' action='update_question.php'>
            <input type='hidden' name='id' value='{$row['id']}'>
            <input type='text' name='question' value='{$row['question_text']}' required>
            <input type='text' name='option1' value='{$row['option1']}' required>
            <input type='text' name='option2' value='{$row['option2']}' required>
            <input type='text' name='option3' value='{$row['option3']}' required>
            <button type='submit'>Save</button>
        </form>";
    } else {
        echo "Question not found.";
    }
    
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>

