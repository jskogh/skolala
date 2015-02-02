<?php namespace app\models;

use app\DB;
use PDO;

class User {

    protected $db;

    protected $email;
    protected $f_name;
    protected $l_name;
    protected $adress;
    protected $postal_code;
    protected $postal_adress;
    protected $password;
    protected $phone;
    protected $newsletter;

    public function __construct() {
        $this->db = DB::get();
    }
    public function create(Array $user) {

        $this->email = $user['email'];
        $this->f_name = $user['f_name'];
        $this->l_name = $user['l_name'];
        $this->adress = $user['adress'];
        $this->postal_code = $user['postal_code'];
        $this->postal_adress = $user['postal_adress'];
        $this->password = password_hash($user['password'], PASSWORD_BCRYPT);
        $this->phone = $user['phone'];
        $this->newsletter = $user['newsletter'];

    }

    public function save() {
        $stm = $this->db->prepare('INSERT INTO users
                                  (email, f_name, l_name, adress, postal_code, postal_adress,
                                  password, phone, newsletter)
                                  VALUES (:email, :f_name, :l_name, :adress, :postal_code, :postal_adress,
                                  :password, :phone, :newsletter)');
        $stm->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stm->bindParam(':f_name', $this->f_name, PDO::PARAM_STR);
        $stm->bindParam(':l_name', $this->l_name, PDO::PARAM_STR);
        $stm->bindParam(':adress', $this->adress, PDO::PARAM_STR);
        $stm->bindParam(':postal_code', $this->postal_code, PDO::PARAM_INT);
        $stm->bindParam(':postal_adress', $this->postal_adress, PDO::PARAM_STR);
        $stm->bindParam(':password', $this->password, PDO::PARAM_STR);
        $stm->bindParam(':phone', $this->phone, PDO::PARAM_INT);
        $stm->bindParam(':newsletter', $this->newsletter, PDO::PARAM_BOOL);
        if ( $stm->execute() ) {

        }else{
            throw new \Exception("PDO couldn't execute");
        }
    }

    public function login($email, $password) {
        $stm = $this->db->prepare('SELECT *
                                   FROM users
                                   WHERE (email = :email)');
        $stm->bindParam(':email', strtolower($email), PDO::PARAM_STR);
        $stm->execute();

        $row = $stm->fetchObject();
        if ( password_verify($password, $row->password) ) {
            $_SESSION['user'] = "logged";
            $_SESSION['user_info'] = $row;
        }else{
            throw new \Exception("couldn't log in");
        }
    }



}