<?php 
require "../connect/dbconnect.php";
include '../queries/query.php';

class Registration extends query{
    public $id;

    function getLastId(){
        $query = 'SELECT MAX(id) FROM users';
        $result = $this->ManualQuery($query);
        while ($row = $result->fetch_assoc()) {
            $last_id = $row["MAX(id)"];
        }
        return $last_id;
    }

    function uploadData($first_name, $last_name, $email, $password, $visibility){
        $this->id = $this->getLastId();
        $this->id++;
        $query = 'INSERT INTO users(ID, first_name, last_name, email, password, visibility, role) VALUES ("'.$this->id.'","'.$first_name.'","'.$last_name.'","'.$email.'","'.$password.'","'.$visibility.'", "Poster")';
        $this->ManualQuery($query);
        if (!empty($this->connection->error)){
            return $this->connection->error;
        } else {
            return 'done';
        }
    }
}


if (empty($_POST)){
    Header('location: ../');
} else {
    $registration = new Registration;
    $result = $registration->uploadData($_POST['first_name'], $_POST['last_name'], strtolower($_POST['email']), hash('md5',$_POST['password']), $_POST['visibility']);

    if ($result == 'done'){
        session_start();
        $_SESSION['id'] = $registration->id;
        $_SESSION['logged-in'] = 1;
        $_SESSION['first_name'] = $_POST['first_name'];
        $_SESSION['last_name'] = $_POST['last_name'];
        $_SESSION['email'] = strtolower($_POST['email']);
        $_SESSION['visibility'] = $_POST['visibility'];
        $_SESSION['role'] = 'Poster';
        Header('location: ../mijn-account/');

    } else {
        echo 'Registratie mislukt. Reden: '.$result.' <a href="../mockup-inlog.php">Verder</a>.';
    }
}