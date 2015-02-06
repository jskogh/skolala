<?php

    require_once dirname(__FILE__).'/start.php';
    require_once dirname(__FILE__).'/stripeConfig.php';

    use app\models\Order;

    $order = new Order();

    $token = $_POST['stripeToken'];
    $amount = $_SESSION['shopping_cart_total'] * 100;
    try {
        $customer = Stripe_Customer::create([
            'email' => $_SESSION['user_info']->email,
            'card' => $token
        ]);

        $charge = Stripe_Charge::create([
            'customer' => $customer->id,
            'amount' => $amount,
            'currency' => 'SEK'
        ]);

        $order->create(
            $_SESSION['user_info']->id,
            $_SESSION['shopping_cart_total'],
            $_SESSION['user_info']->adress,
            (int)$_SESSION['user_info']->postal_code,
            $_SESSION['user_info']->postal_adress
        );

        $_SESSION['shopping_cart'] = [];

        header('location: ../purchase_complete.php');
    }catch (Stripe_CardError $e) {
        var_dump("Error: " . $e);
    }



