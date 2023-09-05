<?php
session_start();
require("connect.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "SELECT * FROM users WHERE email=:email and password=:password";
    $statement = $pdo->prepare($sql);
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement->bindParam(":email",$email,PDO::PARAM_STR);
    $statement->bindParam(":password",$password,PDO::PARAM_STR);
    $statement->execute();
    $count=$statement->rowCount();

    if($count==1){
        $_SESSION['privilleged']=$email;
        header("location:home.php");
    }else{
        echo "Invalid email or password";
    }
    $pdo=null;
}
?>






<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Simba Pet Shop</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <style>
        .login-container {
            width: 350px;
            margin: 0 auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        
        }

        .login-container h2 {
            margin-bottom: 30px;
            font-size: 22px;
        }

        .login-container form label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 16px;
        }

        .login-container form input {
            width: 100%;
            padding: 5px;
            margin-bottom: 50px;
            border: 1px solid #ccc;
    
        }

        .login-container form .photo-button {
            background: none;
            border: none;
            padding: 0;
        }

        .login-container p {
            margin-top: 10px;
            font-size: 14px;
        }

        .login-container p a {
            color: #007bff;
        }

        .login-container p a:hover {
            text-decoration: underline;
        }

        /* Resize the logo */
        .logo img {
            width: 150px;
            height: 145px;
        }
    </style>
    <script src='main.js'></script>
</head>

<body>
    <div class="logo">
        <img src="logo.png" alt="Pet Store Logo">
    </div>
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form" method="post" action="login.php">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
			<!-- <button id="loginButton" type="submit" >Login</button> -->
            <input type="image" src="Login.png"  id="login" alt="Login" class="photo-button">
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>
