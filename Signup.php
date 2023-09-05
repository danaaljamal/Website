<?php
require("connect.php");

if($_SERVER['REQUEST_METHOD']=='POST'){
    $sql = "INSERT INTO users (full_name, email, password) VALUES (:full_name, :email, :password)";
    $statement = $pdo->prepare($sql);
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password === $confirm_password) {
        $sql = "INSERT INTO users (full_name, email, password) VALUES (:full_name, :email, :password)";
        $statement = $pdo->prepare($sql);

        $statement->bindParam(":full_name", $full_name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);
        $statement->execute();

        header("Location: Login.php");
        exit;
    } else {
        echo "Passwords do not match. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Simba Pet Shop - Sign Up</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <style>
        .signup-container {
            width: 350px;
            margin: 0 auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .signup-container h2 {
            margin-bottom: 30px;
            font-size: 22px;
        }

        .signup-container form label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 16px;
        }

        .signup-container form input {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .signup-container form .photo-button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .signup-container p {
            margin-top: 10px;
            font-size: 14px;
        }
        /* Resize the logo */
        .logo img {
            width: 150px;
            height: 145px;
        }
    </style>
    <script src='main.js'></script>
</head>
<script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        }

        document.getElementById("signup-form").addEventListener("submit", function(event) {
            if (!validatePassword()) {
                event.preventDefault();
            }
        });
    </script>

<body>
    <div class="logo">
        <img src="logo.png" alt="Pet Store Logo">
    </div>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form id="signup-form" method="post">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            
            <input type="image" src="SignUp.png" alt="Sign Up" class="photo-button">
        </form>
    </div>
    
</body>
</html>
