<!-- get_mypolls.php file -->

<?php
include 'db.php';

$query = "SELECT * FROM questions";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error fetching questions: ' . mysqli_error($conn));
}

$totalCount = mysqli_num_rows($result);
$totalQuestionsHTML = "<p>Total Questions: $totalCount</p>";

$questionsHTML = "";
while ($row = mysqli_fetch_assoc($result)) {
    $questionsHTML .= "
    <div class='question-card' data-question-id='{$row['id']}'>
        <p><strong>Question:</strong> {$row['question_text']}</p>
        <div class='options'>
            <p><strong>Options:</strong></p>
            <ul>
                <li>{$row['option1']}</li>
                <li>{$row['option2']}</li>
                <li>{$row['option3']}</li>
            </ul>
        </div>
        <button class='btn btn-warning edit-btn' data-id='{$row['id']}'>Edit</button>
        <button class='btn btn-danger delete-btn' data-id='{$row['id']}'>Delete</button>
    </div>";
}

echo $totalQuestionsHTML . $questionsHTML;

mysqli_close($conn);
?>

