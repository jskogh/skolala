<?php namespace app\models;

class User {

    public $name;

    public function __construct() {
        $this->name = "Snubben";
        $this->age = 49;
    }
}