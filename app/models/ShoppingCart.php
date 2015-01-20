<?php namespace app\models;

use app\DB;
use PDO;
use app\models\Shoes;

class ShoppingCart {

    public function addToCart(Shoes $shoe, $shoeId) {

        if ( array_key_exists($shoeId, $_SESSION['shopping_cart']) ) {

            $result = $_SESSION['shopping_cart'][$shoeId]['amount'] += 1;

            echo json_encode($result);

        } else {

            $result['amount'] = $_SESSION['shopping_cart'][$shoeId]['amount'] = 1;
            $result['prop'] = $shoe->get($shoeId);
            echo json_encode($result);
        }
    }

    public function removeFromCart($shoeId) {

        if (isset($_SESSION['shopping_cart'][$shoeId])) {
            if ($_SESSION['shopping_cart'][$shoeId]['amount'] > 1) {

                $_SESSION['shopping_cart'][$shoeId]['amount'] -= 1;
                $result = $_SESSION['shopping_cart'][$shoeId]['amount'];
                echo json_encode($result);

            } else {
                unset($_SESSION['shopping_cart'][$shoeId]);
                echo json_encode(false);
            }

        }
    }

}