<?php 
class db_conn{
    public $host;
    public $username;
    public $password;
    public $db_name;
    public $connection;

    function __construct(){
        $this->host = 'db.bydanielkuiper.nl';
        $this->username = 'md537971db526033';
        $this->password = 'zmSmgvW5pYC@qNW';
        $this->db_name = 'md537971db526033';
        
        $connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
          }
        $this->connection = $connection;

    }
}

$db = new db_conn();

