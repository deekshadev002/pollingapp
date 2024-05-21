<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: rgba(31, 41, 55, 1);
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .header, .footer {
            background-color: #333;
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
        .workflow {
            margin-bottom: 20px;
        }
        .form-check-label {
            margin-left: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn {
            margin-top: 10px;
        }
        textarea {
            width: 100%;
            height: 100px;
        }
        .admin-nav {
            list-style: none;
            padding-left: 0;
        }
        .admin-nav li {
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 20px;
        }
        #pollsContainer .question-card {
            background-color: #2d3748;
            border: 1px solid #4a5568;
            padding: 10px;
            margin-bottom: 10px;
            color: white;
        }
        #pollsContainer .question-card:nth-child(odd) {
            border-left: 5px solid #007bff;
        }
        #pollsContainer .question-card:nth-child(even) {
            border-left: 5px solid #ff007b;
	}

    </style>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark header">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="logo.png" alt="Logo"></a>
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
        <h2 class="my-4">Admin Dashboard</h2>
        <div class="row">
            <div class="col-md-3">
                <ul class="admin-nav">
                    <li><button class="btn btn-primary btn-block" onclick="toggleSection('createQuestion')">Create Question</button></li>
                    <li><button class="btn btn-primary btn-block" onclick="toggleSection('modifyUser')">Modify User</button></li>
                    <li><button class="btn btn-primary btn-block" onclick="toggleSection('userSettings')">User Settings</button></li>
                    <li><button class="btn btn-primary btn-block" onclick="toggleSection('createPoll')">Total submission user</button></li>
                    <li><button class="btn btn-primary btn-block" id="myPollsBtn">My Polls</button></li>
                </ul>
            </div>
            <div class="col-md-9">
                <!-- Create Question Section -->
                <div id="createQuestion" class="section" style="display: none;">
                    <h3>Create Question</h3>
                    <form id="questionForm" method="post" action="submit_question.php">
                        <div class="form-group">
                            <label for="question">Question:</label>
                            <input type="text" class="form-control" id="question" name="question" required>
                        </div>
                        <div class="form-group">
                            <label for="option1">Option 1:</label>
                            <input type="text" class="form-control" name="options[]" required>
                        </div>
                        <div class="form-group">
                            <label for="option2">Option 2:</label>
                            <input type="text" class="form-control" name="options[]" required>
                        </div>
                        <div class="form-group">
                            <label for="option3">Option 3:</label>
                            <input type="text" class="form-control" name="options[]" required>
                        </div>
                        <div class="form-group">
                            <label for="workflow">Workflow:</label>
                            <textarea class="form-control" id="workflow" name="workflow" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>

                <!-- Modify User Section -->
                <div id="modifyUser" class="section" style="display: none;">
                    <!-- Your modify user form goes here -->
                </div>


                <!-- Modify User Section -->
<div id="modifyUser" class="section" style="display: none;">
    <h3>User List</h3>
    <div id="userList"></div>
</div>





                <!-- Create Poll Section -->
                <div id="createPoll" class="section" style="display: none;">
                    <h3>Questions Saved Successfully!</h3>
                    <!-- Display a confirmation message -->
                </div>

                <!-- My Polls Section -->
                <div id="myPolls" class="section" style="display: none;">
                    <h3>My Polls</h3>
                    <div id="pollsContainer"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Your Company. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    function toggleSection(sectionId) {
        $(".section").hide();
        $("#" + sectionId).show();
    }

    $("#questionForm").on("submit", function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "submit_question.php",
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                $("#questionForm")[0].reset();
                toggleSection('createPoll');
            },
            error: function() {
                alert("Error submitting question.");
            }
        });
    });

    function displayQuestions() {
        $.ajax({
            type: "GET",
            url: "get_mypolls.php",
            success: function(response) {
                $("#pollsContainer").html(response);
                loadOptions(); // Load options after displaying questions
            },
            error: function() {
                alert("Error fetching questions.");
            }
        });
    }

    $(document).ready(function() {
        $("#logoutLink").on("click", function(event) {
            event.preventDefault();
            window.location.href = $(this).attr("href");
        });

        $("#myPollsBtn").on("click", function() {
            displayQuestions();
            toggleSection('myPolls');
        });
    });

    // New function to load options
    function loadOptions() {
        $(".question-card").each(function() {
            var questionId = $(this).data("question-id");
            var optionsContainer = $(this).find(".options-container");
            $.ajax({
                type: "GET",
                url: "get_options.php?question_id=" + questionId,
                success: function(response) {
                    optionsContainer.html(response);
                },
                error: function() {
                    optionsContainer.html("Error loading options.");
                }
            });
        });
    }









        $(document).ready(function() {
            // Function to toggle sections
            function toggleSection(sectionId) {
                $(".section").hide();
                $("#" + sectionId).show();
            }

            // Function to display users
            function displayUsers() {
                $.ajax({
                    type: "GET",
                    url: "get_users.php",
                    success: function(response) {
                        $("#userList").html(response);
                    },
                    error: function() {
                        alert("Error fetching users.");
                    }
                });
            }

            // Click event for User Settings button
            $("#userSettingsBtn").on("click", function() {
                displayUsers(); // Display users when button is clicked
                toggleSection('userSettings'); // Show the user settings section
            });
        });
    
  


// admin.php (JavaScript part)

function editQuestion(questionId) {
    window.location.href = "edit_question.php?id=" + questionId;
}







</script>

</body>
</html>

