<?php
class query_select extends query{
    private $columns;
    private $result;


    function Select($columns, $table, $page_id, $order){
        if (is_array($columns)){
            $this->columns = implode(', ', $columns);
        } else {
            $this->columns = $columns;
        }

        if (!empty($order)){
            $order_by = ' ORDER BY '.$order;
        } else {
            $order_by = '';
        }
        
        $this->result = $this->connection->query('SELECT '.$this->columns.' FROM '.$table.' WHERE page_id='.$page_id.$order_by);

        
        
        $data = array();
        
            while ($row = $this->result->fetch_assoc()) {
                array_push($data, $row);
            }
        
        
        return $data;
        
    }
}

