<?php 
class Database{

    public function con(){
    
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "multimedia";
        return mysqli_connect($host, $user, $pass, $database);
    }    
}