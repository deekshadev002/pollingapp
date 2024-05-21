<?php
$servername = "localhost";
$username = "deeksha";
$password = "password";
$dbname = "crud_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
`
