<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM poll WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "Question deleted successfully.";
    } else {
        echo "Error deleting

