<?php
require "connect/dbconnect.php";
include "queries/include.php";

session_start();
if (empty($_SESSION)){
    define("page_id", 3);
} else {
    define("page_id", 2);
}



include "blocks/include.php";