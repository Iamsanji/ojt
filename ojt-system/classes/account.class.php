<?php

    require_once 'config/database.php';

    class Account {
        public $id = '';
        public $fname = '';
        public $lname = '';
        public $mname = '';
        public $password = '';
        public $email = '';
        public $role = '';

    

    protected $db;

    function __construct() {
        $this->db = new Database();
        $this->connection = $this->db->connect();
    }

    #add
    function add() {

        $sql = "INSERT INTO accounts (fname, lname, mname, password, email, role) VALUES (:fname, :lname, :mname, :password, :email, :role)";
        $query = $this->connection->prepare($sql);

        $query->bindParam(':fname', $this->fname);
        $query->bindParam(':lname', $this->lname);
        $query->bindParam(':mname', $this->mname);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':role', $this->role);

        if($query->execute()) {
            return true;
        } else {
            return false;
        }

    }

    #edit
    function edit() {

        $sql = "UPDATE accounts SET fname = :fname, lname = :lname, mname = :mname, password = :password, email = :email, role = :role WHERE id = :id";
        $query = $this->connection->prepare($sql);

        $query->bindParam(':id', $this->id);
        $query->bindParam(':fname', $this->fname);
        $query->bindParam(':lname', $this->lname);
        $query->bindParam(':mname', $this->mname);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':role', $this->role);

        return $query->execute();

    }

}

?>