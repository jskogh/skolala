<?php

namespace app\models;
use app\DB;
use PDO;


class Order {

    public function create($user_id, $total_price, $shipping_adress, $shipping_postal_code, $shipping_postal_adress) {
        $db = DB::get();
        $stm = $db->prepare('INSERT INTO orders
                      (user_id, total_price, shipping_adress, shipping_postal_code, shipping_postal_adress)
                      VALUES (:user_id, :total_price, :shipping_adress, :shipping_postal_code, :shipping_postal_adress)');
        $stm->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stm->bindParam(':total_price', $total_price, PDO::PARAM_INT);
        $stm->bindParam(':shipping_adress', $shipping_adress, PDO::PARAM_STR);
        $stm->bindParam(':shipping_postal_code', $shipping_postal_code, PDO::PARAM_INT);
        $stm->bindParam(':shipping_postal_adress', $shipping_postal_adress, PDO::PARAM_STR);

        $stm->execute();

        $orderId = $db->lastInsertId();

        $this->createOrderDetails($orderId);


    }

    protected function createOrderDetails($orderId) {
        $orderId = (int)$orderId;
        $db = DB::get();

        foreach ( $_SESSION['shopping_cart'] as $item ) {
            for($x = 0; $x < $item['amount']; $x++) {

                // get products_id and stock
                $obj = $this->getProduct($item['shoeId'], $item['size']);

                $products_id = (int)$obj->id;
                $products_stock = (int)$obj->stock;

                // Insert into order_details
                $insertStm = $db->prepare('INSERT INTO order_details
                                           (order_id, products_id)
                                           VALUES (:order_id, :products_id)');
                $insertStm->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                $insertStm->bindParam(':products_id', $products_id, PDO::PARAM_INT);
                $insertStm->execute();



                $this->decrementProductStock($products_id, $products_stock);


            }
        }
    }

    protected function decrementProductStock($products_id, $products_stock) {

        $db = DB::get();

        $stock = $products_stock - 1;

        $updateStm = $db->prepare('UPDATE products_in_stock
                                   SET stock = :stock
                                   WHERE id = :products_id');
        $updateStm->bindParam(':stock', $stock, PDO::PARAM_INT);
        $updateStm->bindParam(':products_id', $products_id, PDO::PARAM_INT);
        $updateStm->execute();
    }

    protected function getProduct($shoe_id, $shoe_size) {
        $db = DB::get();

        $selectStm = $db->prepare('SELECT id, stock FROM products_in_stock
                                     Where shoe_id = :shoe_id
                                     AND product_size = :product_size');
        $selectStm->bindParam(':shoe_id', $shoe_id, PDO::PARAM_INT);
        $selectStm->bindParam(':product_size', $shoe_size, PDO::PARAM_INT);
        $selectStm->execute();

        return $selectStm->fetchObject();
    }



}