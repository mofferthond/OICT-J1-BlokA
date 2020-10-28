<?php
class Content extends query_select{
    private $pointer;
    private $left_to_close = array();
    private $close_counter;

    function ElementExists($location_id){
        $query = 'SELECT location_id FROM elements WHERE location_id LIKE "'.$location_id.'"';
        $result = $this->ManualQuery($query);

        if ($result->num_rows == 0){
            return 0;
        } else {
            return 1;
        }
    }

    function ElementWrite(){
        $this->pointer = constant('page_id').'.1';
        $this->ElementLoop();
    }
    
    function ElementLoop(){
            if (!$this->ElementExists($this->pointer) && strlen($this->pointer) == 3){

            } else {
            
            $query = 'SELECT type, class, attributes, content FROM elements WHERE location_id="'.$this->pointer.'"';
            $result = $this->ManualQuery($query);
            while ($row = $result->fetch_assoc()) {
                $data = $row;
            }

            if (substr($data['content'], 0, 10) == 'function->'){
                //run function
                $function = substr($data['content'], 10);
                $data['content'] = $this->$function();
            }

                if ($data['type'] == 'img'){
                    echo '<'.$data['type'].' class="'.$data['class'].'" '.$data['attributes'].' '.$data['content'].'>';
                } else {
                echo '<'.$data['type'].' class="'.$data['class'].'" '.$data['attributes'].'>'.$data['content'];
                }
                $current_pointer = $this->pointer;

                //Look for Child
                $this->pointer .= '.1';
                if ($this->ElementExists($this->pointer)){
                    array_push($this->left_to_close, $data['type']);
                    $this->ElementLoop();
                    
                    
                } else{
                    
                    //Look for sibling
                    
                    $last_child = substr($this->pointer, -3, 1);
                    $last_child++;
                    $this->pointer = substr($this->pointer, 0, -3);
                    $this->pointer = $this->pointer.$last_child;
                    if ($this->ElementExists($this->pointer)){

                        echo '</'.$data['type'].'>';
                        $this->ElementLoop();
                        
                    
                    } else {
                        //Look for parent-sibling
                        $close_counter = 1;
                        while (!$this->ElementExists($this->pointer) && strlen($this->pointer) > 3){ 
                            
                                    
                            $last_parent = substr($this->pointer, -3, 1);
                            $last_parent++;
                            $this->pointer = substr($this->pointer, 0, -3);
                            $this->pointer = $this->pointer.$last_parent;
                            $close_counter++;
                        }
                        
                        array_push($this->left_to_close, $data['type']);
                        while ($close_counter > 0){
                            echo '</'.array_pop($this->left_to_close).'>';
                            $close_counter--;
                        }
                        $this->ElementLoop();
                    }
                }
             
        }  
    }

    function getName(){
        return $_SESSION['first_name'].' '. $_SESSION['last_name'];
    }

    function getEmail(){
        return $_SESSION['email'];
    }

    function getVisibility(){
        return $_SESSION['visibility'];
    }

    function getRole(){
        return $_SESSION['role'];
    }

    function getImage(){
        if (isset($_SESSION['image'])){
            return 'src="../uploads/'.$_SESSION['image'].'"';
        } else {
            $query = 'SELECT `profile-image` FROM users WHERE id='.$_SESSION['id'];
            $result = $this->ManualQuery($query);
            while ($row = $result->fetch_assoc()) {
                $_SESSION['image'] = $row['profile-image'];
            }
            return 'src="../uploads/'.$_SESSION['image'].'"';
        }
    }

    function getPortfolioItems(){
        $query = 'SELECT id, user_id, title, description, start_date, end_date FROM `portfolio-items` WHERE user_id='.$_SESSION['id'];
        $result = $this->ManualQuery($query);
        if ($result->num_rows == 0){
            return '<p class="no-portfolio-items-p">Het lijkt er op alsof je nog geen portfolio-items hebt aangemaakt.</p>';
        } else {
            while ($row = $result->fetch_assoc()){
                echo '  <div class="single-portfolio-item">
                <div class="col3-portfolio col3-portfolio-1">
                    <div class="portfolio-item-image-container"> 
                        <img class="portfolio-item-image" '.$this->getImage().'>
                    </div>
                    <div class="portfolio-item-intro">
                        <p class="portfolio-item-intro-text">'.$_SESSION['first_name'].' '.$_SESSION['last_name'].'</p>
                        <p class="portfolio-item-intro-text">'.$_SESSION['role'].'</p>
                    </div>
                </div>
                <div class="col3-portfolio col3-portfolio-2">
                    <div class="col3-portfolio-wrapper">
                        <h4 class="portfolio-item-title">'.$row['title'].'</h4>
                        <p class="portfolio-item-description">'.$row['description'].'</p>
                    </div>
                </div>
                <div class="col3-portfolio col3-portfolio-3">
                    <div class="col3-portfolio-wrapper">
                        <span class="portfolio-date-key">Start:</span>
                        <span class="portfolio-date-value">'.$row['start_date'].'</span>
                        <span class="portfolio-date-key">Tot:</span>
                        <span class="portfolio-date-value">'.$row['end_date'].'</span>
                        <div class="delete-button-group">
                            <a class="delete-item delete-confirm" onclick="confirmDelete('.$row['id'].')" style="display: block;" id="delete-button-'.$row['id'].'">verwijder</a>
                            <a class="delete-item delete-yes" href="../handlers/delete-item.php?id='.$row['id'].'&c='.hash('md5',$_SESSION['email']).'" style="visibility: hidden;" id="yes-delete-'.$row['id'].'">ja</a>
                            <a class="delete-item delete-no" onclick="cancelDelete('.$row['id'].')" style="visibility: hidden;" id="no-delete-'.$row['id'].'">nee</a>
                        </div>
                    </div>
                </div>
            </div>
                ';
            }
        }
    }

    function getUsersforSearch(){
        $query = 'SELECT id, first_name, last_name, email, visibility, role, `profile-image` FROM `users` WHERE visibility="open" ORDER BY last_name ASC';
        $result = $this->ManualQuery($query);
        $count = 0;
        $li = '';
        while ($row = $result->fetch_assoc()){
            
            $li .= '  <li class="list-users"';
            if ($count < 5){
                $li .= 'style="display: block;"';
            } else {
                $li .= 'style="display: none;"';
            }
            $li .=  '>
                        <div class="col2-user-search-1 col2-user-search">
                            <img class="list-user-image" src="/uploads/'.$row['profile-image'].'">
                        </div>
                        <div class="col2-user-search-2 col2-user-search">
                            <a class="list-users-name" href="../user.php?id='.$row['id'].'&c='.hash('md5', $row['email']).'">'.$row['first_name'].' '.$row['last_name'].'</a>
                        </div>
                    </li>';
            $count++;

        }
        return $li;
    }

    function getItemsforSearch(){
        $query = 'SELECT `users`.`profile-image`, `portfolio-items`.`title`, `portfolio-items`.`id` FROM `users` INNER JOIN `portfolio-items` ON `users`.`id` = `portfolio-items`.`user_id` WHERE `users`.`visibility`="open" ORDER BY `portfolio-items`.`title` ASC';
        $result = $this->ManualQuery($query);
        $count = 0;
        $li = '';
        while ($row = $result->fetch_assoc()){
            $li .= '  <li class="list-users"';
            if ($count < 5){
                $li .= 'style="display: block;"';
            } else {
                $li .= 'style="display: none;"';
            }
            $li .= '>
                        <div class="col2-user-search-1 col2-user-search">
                            <img class="list-user-image" src="/uploads/'.$row['profile-image'].'">
                        </div>
                        <div class="col2-user-search-2 col2-user-search">
                            <a class="list-users-name" href="../item.php?id='.$row['id'].'">'.$row['title'].'</a>
                        </div>
                    </li>';
            $count++;

        }
        return $li;
    }

    function getUserPageData(){
        $query = 'SELECT id, first_name, last_name, visibility, email, role, `profile-image` FROM users WHERE id='.$_GET['id'];
        $result = $this->ManualQuery($query);
        return $result->fetch_assoc();
    }

    function getNameUser(){
        $data = $this->getUserPageData();        
        return $data['first_name'].' '. $data['last_name'];
    }

    function getImageUser(){
        $data = $this->getUserPageData();    
        return 'src="uploads/'.$data['profile-image'].'"';
    }

    function getVisibilityUser(){
        $data = $this->getUserPageData();        
        return $data['visibility'];
    }

    function getRoleUser(){
        $data = $this->getUserPageData();        
        return $data['role'];
    }

    function getPortfolioItemsUser(){
        $data = $this->getUserPageData();  
        $query = 'SELECT id, user_id, title, description, start_date, end_date FROM `portfolio-items` WHERE user_id='.$data['id'];
        $result = $this->ManualQuery($query);
        if ($result->num_rows == 0){
            return '<p class="no-portfolio-items-p">Het lijkt er op alsof er nog geen portfolio-items zijn aangemaakt.</p>';
        } else {
            while ($row = $result->fetch_assoc()){
                echo '  <div class="single-portfolio-item">
                <div class="col3-portfolio col3-portfolio-1">
                    <div class="portfolio-item-image-container"> 
                        <img class="portfolio-item-image" '.$this->getImageUser().'>
                    </div>
                    <div class="portfolio-item-intro">
                        <p class="portfolio-item-intro-text">'.$this->getNameUser().'</p>
                        <p class="portfolio-item-intro-text">'.$data['role'].'</p>
                    </div>
                </div>
                <div class="col3-portfolio col3-portfolio-2">
                    <div class="col3-portfolio-wrapper">
                        <h4 class="portfolio-item-title">'.$row['title'].'</h4>
                        <p class="portfolio-item-description">'.$row['description'].'</p>
                    </div>
                </div>
                <div class="col3-portfolio col3-portfolio-3">
                    <div class="col3-portfolio-wrapper">
                        <span class="portfolio-date-key">Start:</span>
                        <span class="portfolio-date-value">'.$row['start_date'].'</span>
                        <span class="portfolio-date-key">Tot:</span>
                        <span class="portfolio-date-value">'.$row['end_date'].'</span>
                    </div>
                </div>
            </div>
                ';
            }
        }
    }

    function getAccountPageLink(){ 
        return 'https://www.bydanielkuiper.nl/user.php?id='.$_SESSION['id'].'&c='.hash('md5', $_SESSION['email']);
    }
}
$write = new Content;
$write->ElementWrite();
