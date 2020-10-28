<?php 
class metadata extends query{
    public $meta;
    
    function get(){
        $query = 'SELECT content FROM metadata WHERE page_id='.constant("page_id");
        $this->meta = $this->ManualQuery($query);
        
        foreach ($this->meta as $value){
            echo '<meta '.$value['content'].'>';
        }     
        
    }
}