<?php
require "../connect/dbconnect.php";
include '../queries/query.php';
session_start();

class changeProfileImg extends query{
    function run($post, $files){
        $file = $files['image'];
        $file_name = $file['name'];
        $file_tmpname = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_type = $file['type'];

        $file_ext = explode('.', $file_name);
        $file_ext_actual = strtolower(end($file_ext)); 

        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'jfif');

        if (in_array($file_ext_actual, $allowed_ext)){
            if ($file_error == 0){
                if ($file_size < 2500000){
                    $file_new_name = uniqid('', true).'.'.$file_ext_actual;
                    $_SESSION['image'] = $file_new_name;

                    $file_destination = '../uploads/'.$file_new_name;
                    move_uploaded_file($file_tmpname, $file_destination);
                    
                    $query = 'UPDATE `users` SET `profile-image` = "'.$file_new_name.'" WHERE `users`.`ID` = '.$_SESSION['id'];
                    $this->ManualQuery($query);
                    if (!empty($this->connection->error)){
                        return $this->connection->error;
                    } else {
                        Header('location: ../mijn-account/');
                    }
                    
                } else {
                    echo 'Het gekozen bestand is te groot. (limiet 2.5 MB)';
                }
            } else {
                echo 'Er is iets misgegaan in het uploaden.';
            }
        } else {
            echo 'Verkeerde bestand-type';
        }
    }
}

$image = new changeProfileImg;
if (isset($_POST['submit'])){
    $image->run($_POST, $_FILES);
} else {
    Header('location: ../mijn-account/');
}
