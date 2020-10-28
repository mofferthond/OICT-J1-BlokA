<?php
class header_favicon extends query_select{
    public $header_favicon;
    
    function get(){
        $this->header_favicon = $this->Select('favicon', 'headerdata', constant("page_id"), '');
        echo '<link rel="icon" type="image/png" href="'.$this->header_favicon[0]['favicon'].'">';
    }
}