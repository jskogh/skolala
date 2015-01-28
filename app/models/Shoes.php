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

        $stm = $this->db->prepare("SELECT shoes.*, categories.category, brands.brand_name , GROUP_CONCAT(category SEPARATOR ', ') AS categories
                                   FROM shoes
                                   JOIN brands
                                   ON shoes.brand_id = brands.id
                                   JOIN shoe_category
                                   ON shoes.id = shoe_category.shoe_id
                                   JOIN categories
                                   ON shoe_category.category_id = categories.id
                                   WHERE shoes.id = :id");
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchObject();
    }
}