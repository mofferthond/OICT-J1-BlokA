<?php
class query_select_recursive extends query{
    private $columns;
    private $result;


    function SelectRecursive($columns, $table, $condition, $column2, $table2,  $page_id){
        if (is_array($columns)){
            $this->columns = implode(', ', $columns);
        } else {
            $this->columns = $columns;
        }
        if ($page_id != 0){
            $page_id_query =' page_id='.$page_id.' AND ';
        } else {
            $page_id_query = '';
        }
        $query = 'SELECT `'.$this->columns.'` FROM `'.$table.'` WHERE '.$page_id_query.$condition.'=(SELECT `'.$column2.'` FROM `'.$table2.'`)';
        $this->result = $this->connection->query($query);
        
        $data = array();
        while ($row = $this->result->fetch_assoc()) {
           array_push($data, $row[$columns]);
        }
    
        return $data;
    }
}

