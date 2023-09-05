<?php
session_start();
require 'connect.php';

$sql = "INSERT INTO cart (email, item_name) VALUES (:email, :item_name)";
$statement = $pdo->prepare($sql);
$email = $_SESSION['privilleged'];
$item_name = $_POST['item_name'];
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->bindParam(":item_name", $item_name, PDO::PARAM_STR);
$statement->execute();
$pdo = null;
header("location: Home.php");
?>
