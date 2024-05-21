<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

// Check if the user is an admin
if ($_SESSION['is_admin']) {
    // Redirect directly to the admin panel
    header("Location: admin.php");
    exit();
}

// If the user is not an admin, display the welcome message
echo "Welcome, " . $_SESSION['username'];
?>


















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .header {
            background-color: black;
            color: white;
            padding: 10px 0;
        }
        .header .navbar-brand img {
            height: 50px;
        }
        .header .navbar-nav {
            margin-left: auto;
        }
        .header .nav-item {
            margin-left: 15px;
        }
        .footer {
            background-color: black;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
        }
        .container {
            margin-top: 20px;
            flex: 1;
        }
        .thank-you-message {
            display: none;
            color: green;
            font-weight: bold;
            margin-top: 20px;
        }
        .question {
            margin-bottom: 20px;
        }
        .options {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark header">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="logo.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Info</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" id="logoutLink">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h1 class="my-4">User Dashboard</h1>

        <!-- MCQ Question -->
        <div class="question">
            <h3>The HTML attribute used to define the inline styles is -</h3>
        </div>

        <!-- Options -->
        <div class="options">
            <div class="option">
                <input type="radio" name="question1" id="option1" value="style">
                <label for="option1">style</label>
            </div>
            <div class="option">
                <input type="radio" name="question1" id="option2" value="styles">
                <label for="option2">styles</label>
            </div>
            <div class="option">
                <input type="radio" name="question1" id="option3" value="class">
                <label for="option3">class</label>
            </div>
            <div class="option">
                <input type="radio" name="question1" id="option4" value="None of the above">
                <label for="option4">None of the above</label>
            </div>
        </div>

        <!-- Workflow Textarea -->
        <div class="workflow">
            <label for="workflow">Workflow:</label>
            <textarea id="workflow" name="workflow"></textarea>
        </div>

        <!-- Submit Button -->
        <button class="submit-button btn btn-primary" onclick="submitAnswer()">Submit Answer</button>

        <!-- Thank You Message -->
        <div class="thank-you-message" id="thankYouMessage">Thank you so much for submitting your feedback!</div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Company. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        function submitAnswer() {
            var selectedOption = document.querySelector('input[name="question1"]:checked');
            if (!selectedOption) {
                alert("Please select an option.");
                return;
            }

            // Hide questions and show thank you message
            document.querySelector('.question').style.display = 'none';
            document.querySelector('.options').style.display = 'none';
            document.querySelector('.workflow').style.display = 'none';
            document.querySelector('.submit-button').style.display = 'none';
            document.querySelector('.thank-you-message').style.display = 'block';
        }
    </script>
</body>
</html>

