<?php
use app\models\User;
use app\models\Shoes;
use app\DB;
// Using this header as a main file for isset stuff. since this is included in all pages
$user = new User();


$shoes = new Shoes();

 ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title> ECOSHOES </title>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/shopping_cart.js" type="text/javascript" > </script>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="js/main.js" type="text/javascript" > </script>
</head>

<body>
<div id="wrapper">
    <div id="header">

        <div id="logo">	
            <a href="index.php"> <h1><span class="green">Eco</span>Shoes</h1> </a>
        </div>


        <div id="navbar">

            <ul>
                <a href="index.php"><li>Startsida</li></a>
                <a href="product_page.php"><li>Shop</li></a>
                <a href="about.php"><li>Om oss</li></a>
                <a href="https://ecoshoesmiljoblogg.wordpress.com" target="_blank"><li>Miljöbloggen</li></a>
                <?php
                    if ($_SESSION['user'] == "logged") {
                        echo "<a href='login.php'><li class='logout-button'>Logga ut</li></a>";
                    } else {
                        echo "<a href='login.php'><li>Logga in</li></a>";
                    }
                ?>

            </ul>

            <div id="shopping_cart">
                <a id="rollDown"><img class="shopping_cart_img" src="img/icons/shopping_cart.png" alt="shopping_cart_logo" /></a>

                <div id="shopping_cart_preview">
                    <div id="checkout_summary" style="width: 300px; margin: 0 auto">
                       
                        <ul>
                            <?php

                            if ( isset($_SESSION['shopping_cart']) ) {
                                foreach ( $_SESSION['shopping_cart'] as $shoeArray) {
                                    echo "<li class='menu_shopping_cart' style='display:inline-block; margin-top: 20px;'>
                                        <div class='cart-item-inline'>
                                            <img style='width: 100px;' src='img/shoes/" . $shoes->get($shoeArray['shoeId'])->pic1 . "' alt='shoe1'/>
                                        </div>
                                        <div class='cart-item-inline'>
                                            <p>" . $shoes->get($shoeArray['shoeId'])->product_name . "<span class='green cart-green'> " . " " . $shoes->get($shoeArray['shoeId'])->price . " kr </span> </p>
                                            <p class='shoe-attr-size'>Storlek: <span>" . $shoeArray['size'] . "</span></p>
                                            <p class='shoe-attr-amount'>antal: <span>" . $shoeArray['amount'] . "</span></p>
                                            <form method='post'>
                                                <div id='view_product'><a href='single_item_page.php?product-id=" . $shoes->get($shoeArray['shoeId'])->id . "'><input type='button' name='view_product_from_cart' value='Till produkt'/></a></div>
                                                <input class='remove-from-cart' type='submit' name='remove_from_cart' value='x'/>
                                                <input class='prod-id' type='hidden' name='shoe_id' value='" . $shoes->get($shoeArray['shoeId'])->id . "' />
                                            </form>
                                        </div>
                                    </li>";
                                }
                            }

                            ?>
                        </ul>

                    </div>
                        <form action="" method="post">
                            <a href="checkout_page.php"><input type="button" value="Till Kassan" style="margin-top: 20px;"/></a>
                        </form>
                </div>
            </div>

        </div>

    </div>