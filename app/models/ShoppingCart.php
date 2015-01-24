<?php namespace app\models;

use app\DB;
use PDO;
use app\models\Shoes;

class ShoppingCart {
// if ( array_key_exists($shoeId, array_values($_SESSION['shopping_cart'])) )
    public function addToCart(Shoes $shoe, $shoeId, $size) {

        $match = false;
        if ( count($_SESSION['shopping_cart']) > 0 ) {
            $_SESSION['shopping_cart'] = array_values( $_SESSION['shopping_cart']);
            foreach ( $_SESSION['shopping_cart'] as $key => $shoeArray ) {
                if ( ($_SESSION['shopping_cart'][$key]['shoeId'] == $shoeId) && ($_SESSION['shopping_cart'][$key]['size'] == $size) ) {

                    $_SESSION['shopping_cart'][$key]['amount'] += 1;

                    $result['attr'] = [
                                        'amount' => $_SESSION['shopping_cart'][$key]['amount'],
                                        'size' => $_SESSION['shopping_cart'][$key]['size']
                                      ];
                    echo json_encode($result);
                    $match = true;
                }
            }

            if( ! $match ){
                $result['attr'] = $_SESSION['shopping_cart'][] = [
                    'shoeId' => $shoeId,
                    'amount' => 1,
                    'size' => $size
                ];
                $result['prop'] = $shoe->get($shoeId);
                echo json_encode($result);
            }

        } else {

            $result['attr'] = $_SESSION['shopping_cart'][] = [
                'shoeId' => $shoeId,
                'amount' => 1,
                'size' => $size
            ];
            $result['prop'] = $shoe->get($shoeId);
            echo json_encode($result);
        }
    }

    public function removeFromCart($shoeId, $size) {
        $_SESSION['shopping_cart'] = array_values( $_SESSION['shopping_cart']);

        $idKey = array_search($shoeId, $_SESSION['shopping_cart']);
        $sizeKey = array_search($size, $_SESSION['shopping_cart']);

        if ( $idKey ==  $sizeKey) {
            if ( $_SESSION['shopping_cart'][$idKey]['amount'] <= 1 ) {
                unset($_SESSION['shopping_cart'][$idKey]);
                echo json_encode(false);

            }else {
                $_SESSION['shopping_cart'][$idKey]['amount'] -= 1;

                $result[] = [
                    'amount' => $_SESSION['shopping_cart'][$idKey]['amount'],
                    'size' => $_SESSION['shopping_cart'][$idKey]['size']
                ];
                echo json_encode($result);
            }
        }
    }

}