<?php 
class stylesheets extends query{
    public $style;
    
    function get(){
        
        $query = 'SELECT url FROM stylesheets WHERE page_id='.constant("page_id");
        $this->style = $this->ManualQuery($query);
        

        foreach ($this->style as $value){
            echo '<link rel="stylesheet" href="'.$value['url'].'">';
        }     
        
    }
}