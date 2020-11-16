<?php 
class db_conn{
    public $host;
    public $username;
    public $password;
    public $db_name;
    public $connection;

    function __construct(){
        
        $connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
          }
        $this->connection = $connection;

    }
}

$db = new db_conn();

