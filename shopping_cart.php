<?php
use app\models\User;
use app\models\Shoes;
use app\DB;

require_once 'app/start.php';

?>

    <?php include("incl/header.php"); ?>

    <div id="checkout_content">
        <div id="checkout_summary" style="width: 300px; margin: 0 auto; background: #fff;">
            <ul>
                <?php
                if ( count($_SESSION['shopping_cart']) > 0 ) {
                    foreach ( $_SESSION['shopping_cart'] as $shoeArray) {
                        echo "<li class='menu_shopping_cart' style='display: block; margin-top: 20px;'>
                                        <p>
                                            <img style='width: 100px;' src='img/shoes/" . $shoes->get($shoeArray['shoeId'])->pic1 . "' alt='shoe1'/>
                                        </p>
                                        <p>" . $shoes->get($shoeArray['shoeId'])->product_name . "</p>
                                        <p>" . $shoes->get($shoeArray['shoeId'])->price . " kr</p>
                                        <p class='shoe-attr-size'>Storlek: <span>" . $shoeArray['size'] . "</span></p>
                                        <p class='shoe-attr-amount'>antal: <span>" . $shoeArray['amount'] . "</span></p>
                                        <form method='post'>
                                            <input class='remove-from-cart' type='submit' name='remove_from_cart' value='remove'/>
                                            <input class='prod-id' type='hidden' name='shoe_id' value='" . $shoes->get($shoeArray['shoeId'])->id . "' />
                                        </form>
                                    </li>";
                    }
                }
                ?>
            </ul>
            <form action="" method="post">
                <input type="submit" value="Till Kassan" style="margin-top: 20px;"/>
            </form>
        </div>
    </div>
