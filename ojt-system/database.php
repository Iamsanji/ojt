<?php

    class Database {
        private $host = 'localhost';
        private $dbname = 'ojt_db';
        private $username = 'root';
        private $password = '';
    

    protected $connection;

    function connect() {

        if($this->connection === null) {
            $this->connection = new PDO ("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
        }
        return $this->connection;
    }

}

$object = new Database();
$connection = $object->connect();

?>