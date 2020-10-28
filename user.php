<?php
session_start();
require "connect/dbconnect.php";
include "queries/include.php";
if (isset($_GET['id'])){
    $q = new query;
    $query = 'SELECT first_name, last_name, email, visibility, role, `profile-image` FROM users WHERE id='.$_GET['id'];
    $result = $q->ManualQuery($query);
    if ($result->num_rows == 0){
        echo '<p class="no-portfolio-items-p">Deze gebruiker bestaat niet. Hoe kom je hier überhaupt? Ga terug.</p>';
    } else {
        $row = $result->fetch_assoc();
        if ($row['visibility'] == 'open'){
            define("page_id", 5);
            include "blocks/include.php";
        } elseif ($row['visibility'] == 'protected') {
            if (isset($_GET['c'])){
                if ($_GET['c'] == hash('md5', $row['email'])){
                    define("page_id", 5);
                    include "blocks/include.php";
                } else {
                    echo '<p class="no-portfolio-items-p">Je hebt de verkeerde link voor dit account.</p>';
                }
            } else {
                echo '<p class="no-portfolio-items-p">Je hebt geen toegang voor dit account. Het is een protected account.</p>';
            }
            
        } elseif ($row['visibility'] == 'private'){
            echo '<p class="no-portfolio-items-p">Deze guy heeft zijn profiel op private staan.</p>';
        }
    }
} else {
    Header('location:portfolios/');
}
