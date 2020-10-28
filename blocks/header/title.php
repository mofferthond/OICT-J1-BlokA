<?php
class header_title extends query_select{
    public $header_title;
    
    function get(){
        $this->header_title = $this->Select('title', 'headerdata', constant("page_id"), '');
        echo '<title>'.$this->header_title[0]['title'].'</title>';
    }
}





    






