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
                <?php
                    foreach ($_SESSION['shopping_cart'] as $shoe) {
                        echo "<li style='display: block; margin-top: 20px;'>
                                <p>
                                    <img style='width: 100px;' src='img/shoes/$shoe->pic1' alt='shoe1'/>
                                </p>
                                <p>$shoe->product_name</p>
                                <p>$shoe->price kr</p>
                                <form method='post'>
                                    <input type='submit' name='remove_from_cart' value='remove'/>
                                    <input type='hidden' name='shoe_id' value='$shoe->id' />
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
