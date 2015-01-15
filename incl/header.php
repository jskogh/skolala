<?php
if ( ! $_SESSION['user']) {
    $_SESSION['user'] = 'visitor';
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
            <h1>Skolala</h1>
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

                </div>
            </div>

        </div>

    </div>