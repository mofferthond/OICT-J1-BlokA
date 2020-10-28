<!DOCTYPE html>
<html> 
    <head>
    <title>Mijn Account | by Daniel Kuiper</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/media.css">
    <link rel="stylesheet" href="/css/typography.css">
    <link rel="stylesheet" href="https://use.typekit.net/ffn0jjk.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../images/favicon-3.png">
    </head>
<body>
    <!-- 77/2.1 -->
    <div id="navigation" class="topbar topbar-inner">
        <!-- 78/2.1.1 -->
        <div class="container container-topbar">
            <!-- 79/2.1.1.1 -->
            <div class="title-container title-container-inner">
                <!-- 80/2.1.1.1.1 -->
                <a href="../mockup-index.php" class="logo-text">
                    <!-- 81/2.1.1.1.1.1 -->
                    <h3 class="title title-inner"> Daniël Kuiper </h3>
                </a>
            </div>
            <!-- 82/2.1.1.2 -->
            <div class="navigation navigation-inner">
                <!-- 83/2.1.1.2.1 -->
                <div class="navigation-col nav-col-1">
                    <!-- 84/2.1.1.2.1.1 -->
                    <a href="https://bydanielkuiper.nl/mockup-index" class="nav-button"> Home</a>
                </div>
                <!-- 85/2.1.1.2.2 -->
                <div class="navigation-col nav-col-2">
                    <!-- 86/2.1.1.2.2.1 -->
                    <a href="https://bydanielkuiper.nl/mockup-portfolios" class="nav-button-active nav-button"> Portfolios</a>
                </div>
                <!-- 87/2.1.1.2.3 -->
                <div class="navigation-col nav-col-3">
                    <!-- 88/2.1.1.2.3.1 -->
                    <a href="https://bydanielkuiper.nl/mockup-mijn-account" class="nav-button"> Account</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 89/2.2 -->
    <div id="hero" class="hero-inner">
        <!-- 90/2.2.1 -->
        <div class="overlap-264653-40">
            <!-- 91/2.2.1.1 -->
            <div class="hero-wrapper hero-wrapper-account">
                <!-- 92/2.2.1.1.1 -->
                <div class="container container-hero-account">
                    <!-- 93/2.2.1.1.1.1 -->
                    <div class="hero-content hero-content-account">
                        <!-- 94/2.2.1.1.1.1.1 -->
                        <h1 class="inner-title">Portfolios</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="search-user" class="content-portfolios">
        <div class="container container-portfolios">
            <div class="search-bar-wrapper">
                <!-- 4.3.1.1.1 -->
                <h3 class="portfolios-title">Explore</h3>
                <div class="col2 col2-portfolios">
                    <!-- 4.3.1.1.2.1 -->
                    <div class="wrapper-content-portfolios">
                        <h4 class="user-search-header">Users</h4>
                        <input type="text" id="search-bar-user" onkeyup="searchUser()" placeholder="Abdul Inshallah..." class="search-bar">
                        <!-- 4.3.1.1.2.1.3 -->
                        <div class="search-result-wrapper">
                            <ul id="ul-users">
                                <?php
                                    require "connect/dbconnect.php";
                                    $query = 'SELECT id, first_name, last_name, visibility, role, `profile-image` FROM `users` ORDER BY last_name ASC';
                                    $result = $db->connection->query($query);
                                    $count = 0;
                                    while ($row = $result->fetch_assoc()){
                                        
                                        echo '  <li class="list-users"';
                                        if ($count < 5){
                                            echo 'style="display: block;"';
                                        } else {
                                            echo 'style="display: none;"';
                                        }
                                        echo '>
                                                    <div class="col2-user-search-1 col2-user-search">
                                                        <img class="list-user-image" src="/uploads/'.$row['profile-image'].'">
                                                    </div>
                                                    <div class="col2-user-search-2 col2-user-search">
                                                        <a class="list-users-name" href="../user.php?id='.$row['id'].'">'.$row['first_name'].' '.$row['last_name'].'</a>
                                                    </div>
                                                </li>';
                                        $count++;

                                    }
                                    ?>
                            </ul>       
                        </div>
                    </div>
                </div>
                <!-- 4.3.1.1.2 -->
                <div class="col2 col2-portfolios">
                    <div class="wrapper-content-portfolios">
                        <h4 class="user-search-header">Portfolio items</h4>
                        <input type="text" id="search-bar-portfolio" onkeyup="searchItem()" placeholder="Project 1: Wahed a smachdalena" class="search-bar">
                        <div class="search-result-wrapper">
                            <ul id="ul-portfolio">
                                <?php
                                    $query = 'SELECT `users`.`profile-image`, `portfolio-items`.`title`, `portfolio-items`.`id` FROM `users` INNER JOIN `portfolio-items` ON `users`.`id` = `portfolio-items`.`user_id` ORDER BY `portfolio-items`.`title` ASC';
                                    $result = $db->connection->query($query);
                                    $count = 0;
                                    while ($row = $result->fetch_assoc()){
                                        echo '  <li class="list-users"';
                                        if ($count < 5){
                                            echo 'style="display: block;"';
                                        } else {
                                            echo 'style="display: none;"';
                                        }
                                        echo '>
                                                    <div class="col2-user-search-1 col2-user-search">
                                                        <img class="list-user-image" src="/uploads/'.$row['profile-image'].'">
                                                    </div>
                                                    <div class="col2-user-search-2 col2-user-search">
                                                        <a class="list-users-name" href="../item.php?id='.$row['id'].'">'.$row['title'].'</a>
                                                    </div>
                                                </li>';
                                        $count++;

                                    }
                                    ?>
                            </ul>       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function searchUser() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search-bar-user');
        filter = input.value.toUpperCase();
        ul = document.getElementById("ul-users");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
            } else {
            li[i].style.display = "none";
            }
        }
        }

        function searchItem() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search-bar-portfolio');
        filter = input.value.toUpperCase();
        ul = document.getElementById("ul-portfolio");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
            } else {
            li[i].style.display = "none";
            }
        }
        }
</script>