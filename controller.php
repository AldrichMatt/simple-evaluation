<?php
require "autoload.php";


// public function __construct(){
    global $uri;
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
    
    public function getDate(){
        return $date = date('l, d-m-Y');
    }

    public function auth(){
        global $path;
        global $model;
        $nij = htmlspecialchars($_POST['nij']);
        $volunteer = $model->get_where('volunteer', 'nij', '=', $nij);
        // $team = $model->get_all_where('team', 'id', '=', $volunteer['team_id']);


        $data=[
            "full_name" => $volunteer['full_name'],
            "team_id" => $volunteer['team_id'],
            "crew_chief" => $volunteer['crew_chief'],
            "pic" => $volunteer['pic']
        ];

        if($volunteer['nij'] == $nij){
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
        global $uri;
        if(array_search('index.php', $uri)){
            if(isset($_SESSION['data']) !== false){
                header("Location: ".$path."dashboard.php");
            } 
        }else{
            if(isset($_SESSION['data']) == false){
                header("Location: ".$path."index.php");
            }
        }
    }
    
    public function verifyRolePIC(){
        global $path;
        $data = $_SESSION['data'];
        
        if($data['pic']){
            
        } else{
            header("Location: ".$path."index.php");
        }

    }

    
    
    public function verifyRoleCC(){

        global $path;
        $data = $_SESSION['data'];
        
        if($data['crew_chief'] || $data['pic']){

        }else{
            header("Location: ".$path."index.php");
        }
    }
    
    public function evaluation(){
        global $path;
        global $model;
        $data = $_POST;
        $date = $data['date'];
        $team_leader = $data['team_leader'];
        $team_id = $data['team_id'];
        $service_id = $data['service_id'];
        $notes = [
            'pic_note' => $data['pic_note'],
            'center_note' => $data['center_note'],
            'moving3_note' => $data['moving3_note'],
            'moving4_note' => $data['moving4_note'],
            'to_note' => $data['to_note'],
            'content_note' => $data['content_note'],
            'vd_note' => $data['vd_note']
        ];
        $names = [
            'pic_name' => $data['pic_name'],
            'center_name' => $data['center_name'],
            'moving3_name' => $data['moving3_name'],
            'moving4_name' => $data['moving4_name'],
            'to_name' => $data['to_name'],
            'content_name' => $data['content_name'],
            'vd_name' => $data['vd_name']
        ];
        $details = [
            'notes' => $notes,
            'names' => $names,
        ];
        $details= json_encode($details);
        // var_dump($details);
        
        $model->insert('evaluation', "`team_leader`,`date`,`team_id`, `service_id`, `details`", "'".$team_leader."','".$date."','".$team_id."', '".$service_id."', '".$details."'");
        $_SESSION['success_team'] = "Succesfully added a new evaluation";
        header("Location: ".$path."dashboard.php");
    }

    public function getTeamLeaders(){
        global $model;
        return $model->get_all_where("volunteer", "crew_chief", "=", "1");
        
    }

    public function getService(){
        global $model;
        return $model->get("service");
        
    }

    public function getEvaluation($evaluation_id){
        global $model;
        return $model->get_where("evaluation","id", '=', $evaluation_id);
    }
    
    public function getTeamMember($team_id = 0){
        global $model;
        if($team_id != 0){
            $team_data = $model->get_all_where("volunteer", "team_id", "=", $team_id);
            $_SESSION['team_data'] = $team_data;
            return $team_data;
        } else{
            $_SESSION['team_data'] = '';
            $team_id = $_POST['team_id'];
            $team_data = $model->get_all_where("volunteer", "team_id", "=", $team_id);
            $_SESSION['team_data'] = $team_data;
            unset($_POST['team_id']);
            echo json_encode($team_data);
        }
        
    }

    public function getDataEvaluation(){
        global $model;
        $data = $_SESSION['data'];
         
        if($data['pic']){
            return $model->get('evaluation');
        }else{
            return $model->get_all_where('evaluation', 'team_id', '=', $data['team_id']);
        }
    }

    public function addTeam(){
        global $model;
        global $path;
        $team_id = $_POST['team_id'];
        $team_name = $_POST['team_name'];
        $team_leader = ($_POST['team_leader'] != NULL)? "'".$_POST['team_leader']."'" : NULL;
 
        $model->insert("team", "id, team_name, team_leader", "'".$team_id."', '".$team_name."', ".$team_leader."");
        $_SESSION['success_team'] = "Succesfully added a new team";
        header("Location: ".$path."team.php");
    }
    public function addService(){
        global $model;
        global $path;
        $service_id = $_POST['service_id'];
        $service_name = $_POST['service_name'];
 
        $model->insert("service", "id, service_name", "'".$service_id."', '".$service_name."'");
        $_SESSION['success_service'] = "Succesfully added a new service";
        header("Location: ".$path."service.php");
    }
    
    public function addVolunteer(){
        global $model;
        global $path;
        $full_name = $_POST['full_name'];
        $nij = $_POST['nij'];
        $team_id = ($_POST['team_id'] == '' ? '0' : $_POST['team_id']);
        $crew_chief = $_POST['crew_chief'];
        $pic = $_POST['pic'];

        $model->insert("volunteer", "`nij`,`full_name`,`crew_chief`,`pic`,`team_id`", "'".$nij."','".$full_name."','".$crew_chief."','".$pic."','".$team_id."'");
        $_SESSION['success_volunteer'] = "Succesfully added a new volunteer";
        header("Location: ".$path."volunteer.php");
    }
    public function actionTeam(){
        global $model;
        global $path;
        $team_id = $_POST['team_id'];
        $action = $_POST['action'];

        switch ($action) {
            case 'delete':
                $model->delete('`team`', '`id`', $team_id);
                $_SESSION['success_team'] = "Succesfully deleted team ".$team_id;
                header("Location: ".$path."team.php");
                break;
            case 'edit':
                $_SESSION['edit_team'] = $model->get_where('team', 'id', '=', $team_id);
                header("Location: ".$path."team-edit.php");
                break;
            case 'update':

                $old_team_id = $_POST['old_team_id'];
                $team_id = $_POST['team_id'];
                $team_name = $_POST['team_name'];
                $team_leader = ($_POST['team_leader'] != NULL)? "'".$_POST['team_leader']."'" : NULL;
 

                $model->update("`team`", "`id` = '".$team_id."', `team_name` = '".$team_name."', `team_leader` = ".$team_leader." ", "`id` = '".$old_team_id."'");
                $_SESSION['success_team'] = "Succesfully edited team #".$team_id;
                header("Location: ".$path."team.php");
                break;
            
            default:
                header("Location: ".$path."team.php");
                break;
        }
    }
    public function actionService(){
        global $model;
        global $path;
        $service_id = $_POST['service_id'];
        $action = $_POST['action'];

        switch ($action) {
            case 'delete':
                $model->delete('`service`', '`id`', $service_id);
                $_SESSION['success_service'] = "Succesfully deleted service ".$service_id;
                header("Location: ".$path."service.php");
                break;
            case 'edit':
                $_SESSION['edit_service'] = $model->get_where('service', 'id', '=', $service_id);
                header("Location: ".$path."service-edit.php");
                break;
            case 'update':

                $old_service_id = $_POST['old_service_id'];
                $service_id = $_POST['service_id'];
                $service_name = $_POST['service_name'];
 

                $model->update("`service`", "`id` = '".$service_id."', `service_name` = '".$service_name."'", "`id` = '".$old_service_id."'");
                $_SESSION['success_service'] = "Succesfully edited service #".$service_id;
                header("Location: ".$path."service.php");
                break;
            
            default:
                header("Location: ".$path."service.php");
                break;
        }
    }
    public function actionEvaluation(){
        global $model;
        global $path;
        $evaluation_id = $_POST['evaluation_id'];
        $action = $_POST['action'];

        switch ($action) {
            case 'delete':
                $model->delete('`evaluation`', '`id`', $evaluation_id);
                $_SESSION['success_evaluation'] = "Succesfully deleted evaluation #".$evaluation_id;
                header("Location: ".$path."dashboard.php");
                break;
                
            case 'view':
                $_SESSION['evaluation_data'] = $this->getEvaluation($evaluation_id);
                header("Location: ".$path."details.php");
                break;
            default:
            header("Location: ".$path."dashboard.php");
                break;
        }
    }
    public function actionVolunteer(){
        global $model;
        global $path;
        $volunteer_id = $_POST['id'];
        $volunteer_name = $_POST['full_name'];
        $action = $_POST['action'];

        switch ($action) {
            case 'delete':
                $model->delete('`volunteer`', '`id`', $volunteer_id);
                $_SESSION['success_volunteer'] = "Succesfully deleted ".$volunteer_name;
                header("Location: ".$path."volunteer.php");
                break;
            case 'edit':
                $_SESSION['edit_volunteer'] = $model->get_where('volunteer', 'id', '=', $volunteer_id);
                header("Location: ".$path."volunteer-edit.php");
                break;
            case 'update':
                $volunteer_id = $_POST['id'];
                $full_name = $_POST['full_name'];
                $nij = $_POST['nij'];
                $team_id = ($_POST['team_id'] == '' ? '0' : $_POST['team_id']);
                $crew_chief = $_POST['crew_chief'];
                $pic = $_POST['pic'];
                
                
                $model->update("`volunteer`", "`full_name` = '".$full_name."', `nij` = '".$nij."', `crew_chief` = '".$crew_chief."', `pic` = '".$pic."', `team_id` = '".$team_id."'", "`id` = '".$volunteer_id."'");
                $_SESSION['success_volunteer'] = "Succesfully updated volunteer #".$volunteer_id;
                header("Location: ".$path."volunteer.php");
                break;
            
            default:
                header("Location: ".$path."volunteer.php");
                break;
        }
    }
    public function logout(){
        global $path;
        session_destroy();
        header("Location: ".$path."index.php");
    }
}