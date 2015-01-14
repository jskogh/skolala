<?php
use app\models\User;
use app\models\Shoes;
use app\DB;

require_once 'app/start.php';

$shoes = new Shoes();

?>

    <?php include("incl/header.php"); ?>

    <div id="checkout_content">
        <div id="checkout_summary" style="width: 300px; margin: 0 auto">
            <h3>Products</h3>
            <ul>
                <li style="display: block; margin-top: 20px;">
                    <p>product1</p>
                    <p>xxx kr</p>
                </li>
                <li style="display: block; margin-top: 20px;">
                    <p>product2</p>
                    <p>xxx kr</p>
                </li>
                <li style="display: block; margin-top: 20px;">
                    <p>product3</p>
                    <p>xxx kr</p>
                </li>
            </ul>
            <form action="" method="post">
                <input type="submit" value="Köp" style="margin-top: 20px;"/>
            </form>
        </div>
    </div>
