<?php

use app\models\User;
use app\models\Shoes;
use app\DB;
// Using this header as a main file for isset stuff. since this is included in all pages

$db = DB::get();
$shoes = new Shoes();
$shoe = new Shoes();
// set visitor Session
if ( ! $_SESSION['user'] ) {
    $_SESSION['user'] = 'visitor';
    $_SESSION['shopping_cart'] = [];
}

// Add to shopping cart
if ( isset($_POST['add_to_cart']) ) {
    if ( array_key_exists($_POST['shoe_id'], $_SESSION['shopping_cart']) ) {
        $_SESSION['shopping_cart'][$_POST['shoe_id']]['amount'] += 1;
    } else {
        $_SESSION['shopping_cart'][$_POST['shoe_id']] = ['amount' => 1];
    }
}

// delete from shopping cart
if ( isset($_POST['remove_from_cart']) ) {
    if ( isset( $_SESSION['shopping_cart'][$_POST['shoe_id']]) ) {
        if ( $_SESSION['shopping_cart'][$_POST['shoe_id']]['amount'] > 1 ) {
            $_SESSION['shopping_cart'][$_POST['shoe_id']]['amount'] -= 1;
        }else {
            unset($_SESSION['shopping_cart'][$_POST['shoe_id']]);
        }
    }
}


 ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title> Skolala || Ekologiska skor </title>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/shopping_cart.js" type="text/javascript" > </script>
    <script src="js/slideshow.js" type="text/javascript" > </script>
</head>

<body>
<div id="wrapper">
    <div id="header">

        <div id="logo">	<!-- <img src="img/logo.png" alt="logotype" width="105px" height="115px"/> -->
            <h1><span class="green">Eco</span>Shoes</h1>
        </div>


        <div id="navbar">

            <ul>
                <li href="">Boots</li>
                <li href="">Sneakers</li>
                <li href="">Sale</li>

            </ul>

            <div id="shopping_cart">
                <a id="rollDown"><img class="shopping_cart_img" src="img/icons/shopping_cart.png" alt="shopping_cart_logo" /></a>

                <div id="shopping_cart_preview">
                    <div id="checkout_summary" style="width: 300px; margin: 0 auto">
                        <h3>Products</h3>
                        <ul>
                            <?php
                            foreach (array_keys($_SESSION['shopping_cart']) as $shoeId) {
                                $amount = $_SESSION['shopping_cart'][$shoeId]['amount'];
                                echo "<li style='display: block; margin-top: 20px;'>
                                <p>
                                    <img style='width: 100px;' src='img/shoes/".$shoe->get($shoeId)->pic1."' alt='shoe1'/>
                                </p>
                                <p>" .$shoe->get($shoeId)->product_name . "</p>
                                <p>".$shoe->get($shoeId)->price." kr</p>
                                <p>antal: $amount</p>
                                <form method='post'>
                                    <input type='submit' name='remove_from_cart' value='remove'/>
                                    <input type='hidden' name='shoe_id' value='".$shoe->get($shoeId)->id."' />
                                </form>
                            </li>";
                            }
                            ?>
                        </ul>
                        <form action="" method="post">
                            <input type="submit" value="Till Kassan" style="margin-top: 20px;"/>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>