<?php
class Model extends Database{

    // get all data from table
    public function get($table){
        return mysqli_query($this->con(), "SELECT * FROM ".$table."")->fetch_all(MYSQLI_ASSOC);
    }
    // get one spesific data
    public function get_where($table, $column, $operator, $value){
        return mysqli_query($this->con(), "SELECT * FROM ".$table." WHERE ".$column." ".$operator." '".$value."'")->fetch_assoc();
    }
    // get all spesific data
    public function get_all_where($table, $column, $operator, $value){
        return mysqli_query($this->con(), "SELECT * FROM ".$table." WHERE ".$column." ".$operator." '".$value."'")->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($table, $column, $value){
        mysqli_query($this->con(), "INSERT INTO ".$table." (".$column.") VALUES (".$value.")");
    }
    public function update($table, $columnValuePair, $condition){
        mysqli_query($this->con(), "UPDATE ".$table." SET ".$columnValuePair." WHERE ".$condition."");
    }
    public function delete($table, $column, $value){
        mysqli_query($this->con(), "DELETE FROM ".$table." WHERE ".$column." = '".$value."'");
    }
}