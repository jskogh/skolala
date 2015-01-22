<?php
use app\models\User;
use app\models\Shoes;
use app\DB;
// Using this header as a main file for isset stuff. since this is included in all pages

$db = DB::get();
$shoes = new Shoes();
$shoe = new Shoes();

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
    <script src="js/main.js" type="text/javascript" > </script>
</head>

<body>
<div id="wrapper">
    <div id="header">

        <div id="logo">	<!-- <img src="img/logo.png" alt="logotype" width="105px" height="115px"/> -->
            <a href="index.php"> <h1><span class="green">Eco</span>Shoes</h1> </a>
        </div>


        <div id="navbar">

            <ul>
                <a href="index.php"><li>Startsida</li></a>
                <a href="product_page.php"><li>Shop</li></a>
                <a href="about.php"><li>Om oss</li></a>

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
                                echo "<li class='menu_shopping_cart' style='display: block; margin-top: 20px;'>
                                <p>
                                    <img style='width: 100px;' src='img/shoes/".$shoe->get($shoeId)->pic1."' alt='shoe1'/>
                                </p>
                                <p>" .$shoe->get($shoeId)->product_name . "</p>
                                <p>".$shoe->get($shoeId)->price." kr</p>
                                <p>antal: <span>$amount</span></p>
                                <form method='post'>
                                    <input class='remove-from-cart' type='submit' name='remove_from_cart' value='remove'/>
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