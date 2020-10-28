<?php
require "../connect/dbconnect.php";
include '../queries/query.php';

session_start();

class AddPortfolioItem extends query{
    public $id;
    function getLastId(){
        $query = 'SELECT MAX(id) from `portfolio-items`';
        $result = $this->ManualQuery($query);
        while ($row = $result->fetch_assoc()) {
            $last_id = $row["MAX(id)"];
        }
        return $last_id;
    }
    
    function AddItem($title, $description, $start_date, $end_date){
        $this->id = $this->getLastId();
        $this->id++;
        $query = 'INSERT INTO `portfolio-items`(id, user_id, title, description, start_date, end_date) VALUES ('.$this->id.', "'.$_SESSION['id'].'","'.$title.'","'.$description.'","'.$start_date.'","'.$end_date.'")';
        echo $query;
        $this->ManualQuery($query);
        if (!empty($this->connection->error)){
            return $this->connection->error;
        } else {
            Header('location: ../mijn-account.php');
        }
    }
}

$additem = new AddPortfolioItem;
$additem->AddItem($_POST['title'], $_POST['description'], $_POST['start_date'], $_POST['end_date']);