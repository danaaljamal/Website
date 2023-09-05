<?php
session_start();
if(!isset($_SESSION['privilleged'])){
   header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Simba Pet Shop - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <link rel="stylesheet" href="style.css">
    <style>
      
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Adjust min and max width as needed */
            gap: 20px;
            justify-items: center;
            padding: 20px;
        }

        .product {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .product img {
            max-width: 100%;
            height: auto;
        }

        .product h3 {
            margin-top: 10px;
            font-size: 18px;
        }

        .add-to-cart-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-to--button:hover {
            background-color:#0056b3;
        }

        /* Adjusted logo size */
        .logo img {
            width: 150px;
            height: 145px;
        }
        .welcome-header {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }
        .cart-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .cart-button:hover {
            background-color: white;
        }
        .bag-button {
            position: absolute;
            top: 50px;
            right: 1%;
            background-color: white;
            color: white;
            border: none;
            padding: 8px 9px;
            cursor: pointer;
        }

        .bag-button:hover {
            background-color:gray;
        }
        /* Added style for the bag image */
        .bag-image {
            width: 50px;
            height: 50px;
            vertical-align: middle;
            margin-right: 5px;
        }
    </style>
    <script src="main.js"></script>
</head>
<body>
    <i class="fa-brands fa-facebook"></i>
    <header class="navbar">
        <div class="logo">
            <img src="logo.png" alt="Pet Store Logo">
        </div>
    </header>
    <h1 class="welcome-header">Welcome to Simba Pet Shop</h1>

    <div class="product-container">
    <?php
        require 'connect.php';
        $sql="SELECT * FROM items";
        $statement=$pdo->prepare($sql);
        $statement->execute();
        $data=$statement->fetchAll();
        $value=0;
        foreach($data as $row){
        echo"<div class='product'>
        <img src=' ".$row['img_src']." ' alt='".$row['item_name']."'>
        <h3>".$row['item_name']."</h3>
        <button class='add-to-cart-button' onclick='addToCart()' value=".$value.">Add to Cart</button>
        <form action='addtocart.php' method='post' class='itemform' value=".$value.">".
        "<input type='hidden' value=".$row['item_name']." name='item_name' class='item_name'>".
        "</form>
    </div>";
    $value++;
}


    ?> 
     <div class="logout-button" style="text-align: center; margin-top: 20px;">
        <a href="Logout.php">Logout</a>
    </div> 
    <script>
    function addToCart(){
             var num=event.target.value;
             
             document.getElementsByClassName("itemform")[num].submit();
            }
    </script>
    </div>
    <a href="cart.php" class="bag-button"><img src="cart.png" class="bag-image"></a>
</body>
</body>
</html>
