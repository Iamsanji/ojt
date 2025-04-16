<?php

    require_once(__DIR__ . '/../database.php');

    class Account {
        public $id = '1';
        public $fname = 'josh';
        public $lname = 'mendoza';
        public $mname = 'abil';
        public $password = 'mendoza123';
        public $email = 'admin';
        public $role = 'admin';

    

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

    function login($email, $password){
        $sql = "SELECT * FROM accounts WHERE email = :email LIMIT 1;";
        $query = $this->connection->prepare($sql); // use $this->connection, already set in __construct
    
        $query->bindParam(':email', $email);
    
        if ($query->execute()) {
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if ($data && $password === $data['password']) { // plain text comparison
                return true;
            }
        }
    
        return false;
    }
    
    function fetch($email){
        $sql = "SELECT * FROM accounts WHERE email = :email LIMIT 1;";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(':email', $email);
        $data = null;
        if($query->execute()){
            $data = $query->fetch();
        }

        return $data;
    }

}


// $obj = new Account();

// $obj->add();
?>