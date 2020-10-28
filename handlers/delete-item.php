<?php
require "../connect/dbconnect.php";
include '../queries/query.php';
session_start();

class DeleteItem extends query{
    function run($id, $email){
        if ($email == hash('md5', $_SESSION['email'])){
            $query = 'DELETE FROM `portfolio-items` WHERE id='.$id;
            $this->ManualQuery($query);
            if (!empty($this->connection->error)){
                return $this->connection->error;
            } else {
                Header('location: ../mijn-account/');
            }
        } else {
            echo 'Je hebt geen rechten om dit item te verwijderen.';
        }
    }
}

$deleteitem = new DeleteItem;
if (!empty($_GET['id']) && !empty($_GET['c'])){
    $deleteitem->run($_GET['id'], $_GET['c']);
} else {
    Header('location: ../mijn-account/');
}

