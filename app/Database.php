<?php namespace app;

class Database {

    protected $instance;

    public function __construct() {

    }

    public static function get() {
        return $this->instance;
    }
}