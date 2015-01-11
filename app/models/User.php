<?php namespace app\models;

use app\DB;
use PDO;

class User {

    public $name;

    public function __construct() {
        $this->name = "Snubben";
        $this->age = 49;
    }
}