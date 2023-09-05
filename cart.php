<?php
session_start();
if (!isset($_SESSION['privilleged'])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Simba Pet Shop - Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <link rel="stylesheet" href="style.css">
    <body style="background-color: white;"></body>
    <style>
        /* Your cart page styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .logo img {
            width: 150px;
            height: auto;
        }

        .cart-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white; /* Ensure this line is present */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            margin-bottom: 10px;
        }

        .cart-item img {
            max-width: 80px;
            height: auto;
            margin-right: 10px;
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-item-name {
            font-weight: bold;
        }

        .cart-item-price {
            color: #777;
        }

        .remove-from-cart-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .remove-from-cart-button:hover {
            background-color: #c0392b;
        }

        .cart-total {
            text-align: right;
            margin-top: 20px;
        }

        .checkout-button {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .checkout-button:hover {
            background-color: #27ae60;
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="logo">
            <img src="logo.png" alt="Pet Store Logo">
        </div>
    </header>
    <div class="cart-container">
        <h1>Your Cart</h1>
        <?php
        require 'connect.php';

        $sql = "SELECT * FROM cart WHERE email = :email;";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':email', $_SESSION['privilleged'],PDO::PARAM_STR);
        $statement->execute();
        $data = $statement->fetchAll();
        $value = 0;

        $sql_ = "SELECT * FROM items ";
        $statement_ = $pdo->prepare($sql_);
        $statement_->execute();
        $data_ = $statement_->fetchAll();

        foreach ($data as $row) {

            $img = '';
            $price = '';
            
            foreach ($data_ as $row_) {
              

                
                if ($row['item_name'] == $row_['item_name']) {

                    $img = $row_['img_src'];
                    $price = $row_['price'];
               }
            }

            echo "<div class='cart-item'>".
                "<img src='".$img."' alt='Product'>".
                "<div class='cart-item-details'>".
                    "<div class='cart-item-name'>" .$row['item_name']. "</div>".
                    "<div class='cart-item-price'>" .$price. "</div>".
                "</div>

                <button class='remove-from-cart-button' onclick='remove()' value='" . $value . "'>Remove</button>

                <form method='post' action='remove.php' class='removeForm' value='" . $value . "'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                </form>
            </div>";

            $value++;
        }

        echo "<form action='cheackout.php' class='checkOutPlace' method='post'>" .
            "<button class='checkout-button'>Checkout</button>" .
            "<input type='hidden' name='email' value='" . $_SESSION['privilleged'] . "'>" .
            "</form>";

        ?>
        <script>
            function remove() {
                var num = event.target.value;
                document.getElementsByClassName("removeForm")[num].submit();
            }
        </script>
    </div>
</body>

</html>
