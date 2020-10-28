<?php
class query extends db_conn{


    function ManualQuery($query){
        return $this->connection->query($query);
    }
}