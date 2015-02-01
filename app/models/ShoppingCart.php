<?php namespace app\models;

use app\DB;
use PDO;

class ShoppingCart {

    protected $db;

    public function __construct() {
        $this->db = DB::get();
    }

    public function addToCart(Shoes $shoe, $shoeId, $size) {


        $match = false;
        if ( count($_SESSION['shopping_cart']) > 0 ) {

            foreach ( $_SESSION['shopping_cart'] as $key => $shoeArray ) {
                if ( ($_SESSION['shopping_cart'][$key]['shoeId'] === $shoeId) && ($_SESSION['shopping_cart'][$key]['size'] === $size) ) {

                    $_SESSION['shopping_cart'][$key]['amount'] += 1;

                    $result['attr'] = [
                                        'amount' => $_SESSION['shopping_cart'][$key]['amount'],
                                        'size' => $_SESSION['shopping_cart'][$key]['size']
                                      ];
                    echo json_encode($result);
                    $match = true;
                }
            }

            if( !$match ){

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

        foreach ( $_SESSION['shopping_cart'] as $key => $shoeArray ) {
            if ( ($_SESSION['shopping_cart'][$key]['shoeId'] == $shoeId) && ($_SESSION['shopping_cart'][$key]['size'] == $size) ) {


                if ($_SESSION['shopping_cart'][$key]['amount'] > 1) {
                    $_SESSION['shopping_cart'][$key]['amount'] -= 1;
                    $result['attr'] = [
                        'amount' => $_SESSION['shopping_cart'][$key]['amount'],
                        'size' => $_SESSION['shopping_cart'][$key]['size']
                    ];
                    echo json_encode($result);

                } else {
                    $_SESSION['shopping_cart'][$key]['amount'] -= 1;
                    $result['attr'] = [
                        'amount' => $_SESSION['shopping_cart'][$key]['amount'],
                        'size' => $_SESSION['shopping_cart'][$key]['size']
                    ];
                    echo json_encode($result);
                    unset($_SESSION['shopping_cart'][$key]);

                }
            }
        }
    }

    public function totalAmount(Shoes $shoes ) {
        $_SESSION['shopping_cart_total'] = 0;

        foreach( $_SESSION['shopping_cart'] as $item ) {
            $_SESSION['shopping_cart_total'] += $shoes->get($item['shoeId'])->price * $item['amount'];
        }
    }

    /*public function updateOrCreateCartFromSessionToDB($userId, $productId, $productSize) {
        $stm = $this->db->prepare('SELECT * FROM shopping_carts
                                   WHERE user_id = :user_id');
        $stm->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_OBJ);
        if ( count($rows) > 0 ) {

            $match = false;
            foreach ( $_SESSION['shopping_cart'] as $key => $item ) {
                if ( ($_SESSION['shopping_cart'][$key]['shoeId'] === $productId) && ($_SESSION['shopping_cart'][$key]['size'] === $productSize) ) {
                    $updateStm = $this->db->prepare('UPDATE shopping_carts
                                                     SET (cart_product_amount = :cart_product_amount)
                                                     WHERE user_id = :user_id
                                                     AND cart_product_id = :cart_product_id
                                                     AND cart_product_size = :cart_product_size
                                                     ');
                    $updateStm->bindParam(':user_id', $userId, PDO::PARAM_INT);
                    $updateStm->bindParam(':cart_product_id', $productId, PDO::PARAM_INT);
                    $updateStm->bindParam(':cart_product_size', $productSize, PDO::PARAM_INT);
                    $updateStm->bindParam(':cart_product_amount', $item['amount'], PDO::PARAM_INT);

                    $updateStm->execute();

                    $match = true;
                }
            }

            if ( ! $match ) {
                $createStm = $this->db->prepare('INSERT INTO shopping_carts
                                             (user_id, cart_product_id, cart_product_size, cart_product_amount)
                                             VALUES (:user_id, :cart_product_id, :cart_product_size, :cart_product_amount)
                                             ');
                $createStm->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $createStm->bindParam(':cart_product_id', $productId, PDO::PARAM_INT);
                $createStm->bindParam(':cart_product_size', $productSize, PDO::PARAM_INT);
                $createStm->bindParam(':cart_product_amount', 1, PDO::PARAM_INT);

                $createStm->execute();
            }
        }else {
            // Make new DB shopping_cart entries so that it matches the the SESSION cart when user has NO cart.
            foreach ( $_SESSION['shopping_cart'] as $item ) {
                $insertStm = $this->db->prepare('INSERT INTO shopping_carts
                                             (user_id, cart_product_id, cart_product_size, cart_product_amount)
                                             VALUES (:user_id, :cart_product_id, :cart_product_size, :cart_product_amount)
                                             ');
                $insertStm->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $insertStm->bindParam(':cart_product_id', $item['shoeId'], PDO::PARAM_INT);
                $insertStm->bindParam(':cart_product_size', $item['size'], PDO::PARAM_INT);
                $insertStm->bindParam(':cart_product_amount', $item['amount'], PDO::PARAM_INT);

                $insertStm->execute();
            }
        }
    }*/

}