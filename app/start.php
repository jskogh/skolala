<?php

use app\DB;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

DB::init(); // Initializes the DB connection