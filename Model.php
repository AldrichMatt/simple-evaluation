<?php

class Model extends Database{

    public function fetch_table($table){
        return mysqli_query($this->con(), "SELECT * FROM ".$table."")->fetch_all(MYSQLI_ASSOC);
    }
}