<?php
require "autoload.php";


// public function __construct(){
    // global $path;
    $req = $_SERVER['REQUEST_URI'];
    $uri = explode('/',$req);
        if(array_search("Controller.php", $uri)){
            $method = array_pop($uri);
            if(method_exists($controller,$method)){
                $controller->$method();
            }else{
                header("Location: ".$path."dashboard.php");
            }
        }else{

        }
        class Controller{

    // }
    
    public function auth(){
        global $path;
        global $model;
        $nij = htmlspecialchars($_POST['nij']);
        $data = $model->get_where('volunteer', 'nij', '=', $nij);
        if($data['nij'] == $nij){
            $_SESSION['data'] = $data;
            $_SESSION['status'] = 'authsuccess';
            header("Location: ".$path."dashboard.php");
        }else{
            $_SESSION['status'] = 'authfail';
            header("Location: ".$path."index.php");
        }
    }

    public function verifyUser(){
        global $path;
        if(isset($_SESSION['data']) == false){
            header("Location: ".$path."index.php");
        }else{
            // header("Location: ".$path."dashboard.php");
        }
    }

    public function logout(){
        global $path;
        session_destroy();
        header("Location: ".$path."index.php");
    }
}