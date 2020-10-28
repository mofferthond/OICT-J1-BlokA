<?php 
include "header/title.php";
include "header/stylesheets.php";
include "header/favicon.php";
include "header/meta.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
        $title = new header_title(); 
        $title->get();

        $favicon = new header_favicon(); 
        $favicon->get();

        $meta = new metadata();
        $meta->get();

        $style = new stylesheets();
        $style->get();
        ?>
    </head>
    <body>


