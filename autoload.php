<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Database.php';
require_once 'Model.php';
require_once 'Controller.php';
global $model, $controller, $path;
$model = new Model();
$controller = new Controller();
$path = "/mulmed-eval/simple-evaluation/";