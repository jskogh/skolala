<?php
use app\DB;
use app\models\Shoes;
use app\models\ShoppingCart;
require_once '../app/start.php';

$db = DB::get();
$shoe = new Shoes();
$cart = new ShoppingCart();

if ( isset($_POST['add_to_cart']) ) {

    $cart->addToCart($shoe, $_POST['shoe_id'], $_POST['size']);
    $cart->totalAmount($shoe);

    if ( $_SESSION['user'] == "logged" ) {
        //$cart->updateOrCreateCartFromSessionToDB($_SESSION['user_info']->id, $_POST['shoe_id'], $_POST['size']);
    }
}

if ( isset($_POST['remove_from_cart']) ) {
    $cart->removeFromCart( $_POST['shoe_id'], $_POST['size']);
    $cart->totalAmount($shoe);
}



