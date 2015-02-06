<?php

require_once(dirname(__FILE__).'/../vendor/stripe/stripe-php/lib/Stripe.php');

$stripe = [
    "secret_key" => "sk_test_sW7e0huKL2MlCtWOSEuSt0AK",
    "publishable_key" => "pk_test_JASS5HIpaoDPcSc8qk7sqSyp"
];

Stripe::setApiKey($stripe['secret_key']);
