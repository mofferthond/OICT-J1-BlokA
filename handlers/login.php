<?php
require "../connect/dbconnect.php";
include '../queries/query.php';

session_start();
class Login extends query{

    function run($email, $password){
        $query = 'SELECT id, first_name, last_name, email, visibility, role FROM users WHERE email="'.$email.'" AND password="'.hash('md5', $password).'"';
        $result = $this->ManualQuery($query); 

        if (!empty($this->connection->error)){
            return $this->connection->error;
        } else {

        if ($result->num_rows == 1){
            
            $row = $result->fetch_assoc();
            foreach ($row as $key => $value){
                $_SESSION[$key] = $value;
                Header('location: ../mijn-account.php');
            }
        } else {
            echo 'Inloggen mislukt, <a href="../mijn-account/">Opnieuw proberen</a>.';
        }
        
            
        }
    }
}
$login = new Login;
$login->run($_POST['email'], $_POST['password']);