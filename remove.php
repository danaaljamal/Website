<?php
require 'connect.php';
$sql="DELETE FROM cart WHERE id=:id";

$id=$_POST['id'];
$statement=$pdo->prepare($sql);
$statement->bindParam(":id",$id, PDO::PARAM_INT);
$statement->execute();
$pdo=null;

header("location:cart.php");
?>