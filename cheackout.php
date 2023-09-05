<?php
require 'connect.php';
session_start();
$sql="DELETE FROM cart WHERE email=:email";

$email=$_POST['email'];

$statement=$pdo->prepare($sql);
$statement->bindValue(':email', $_SESSION['privilleged']);
$statement->execute();
$pdo=null;
header("location:Home.php");
?>