<?php
use app\models\User;
use app\models\Shoes;
use app\DB;

require_once 'app/start.php';

$shoe = new Shoes()

?>

    <?php include("incl/header.php"); ?>

    <div id="checkout_content">
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
