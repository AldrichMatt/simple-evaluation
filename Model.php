<?php
class Model extends Database{

    public function get($table){
        return mysqli_query($this->con(), "SELECT * FROM ".$table."")->fetch_all(MYSQLI_ASSOC);
    }
    public function get_where($table, $column, $operator, $value){
        return mysqli_query($this->con(), "SELECT * FROM ".$table." WHERE ".$column." ".$operator." '".$value."'")->fetch_assoc();
    }
}