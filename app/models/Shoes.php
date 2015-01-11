<?php namespace app\models;

use app\DB;
use PDO;

class Shoes {

    protected $db;

    public function __construct() {
        $this->db = DB::get();
    }

    public function all() {
        $stm = $this->db->prepare('SELECT * FROM shoes');
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id) {

        $stm = $this->db->prepare('SELECT * FROM shoes
                                   WHERE id = :id');
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchObject();
    }
}