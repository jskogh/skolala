<?php namespace app;

use PDO;

class DB {

    protected static $instance;

    public static function init() {
        self::$instance = new PDO('mysql:host=db4free.net;dbname=skolala;charset=utf8', 'skolala', 'Medie2014');
    }

    public static function get() {
        return self::$instance;
    }
}