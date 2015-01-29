<?php

use app\DB;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

// set visitor Session
    if ( ! isset($_SESSION['user']) ) {
            $_SESSION['user'] = 'visitor';
            $_SESSION['shopping_cart'] = [];
    }


DB::init(); // Initializes the DB connection