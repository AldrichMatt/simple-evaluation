<?php

include "Database.php";
$database = new Database();
$data_raw = array_map('str_getcsv', file('data.csv'));


foreach($data_raw as $data){
    $data_each = [
        'nij' => '',
        'full_name' => '',
        'crew_chief' => '',
        'pic' => '',
        'team_id' => '',
    ];
    $data_role = explode('&', strtolower($data[3]));
    $data_each['nij'] = $data[0];
    $data_each['full_name'] = $data[1];
    if(in_array('crew chief' || 'crew chief ',$data_role))
    {
        $data_each['crew_chief'] = '1';
    } else{ 
        $data_each['crew_chief'] = '0'; 
    }
    if(in_array(' pic voltage',$data_role))
    {
        $data_each['pic'] = '1';
    } elseif(in_array('pic',$data_role, true))
    {
        $data_each['pic'] = '1';
    } else
    { 
        $data_each['pic'] = '0'; 
    }
    $data_each['team_id'] = preg_replace("/&/",",",(preg_replace("/[^0-9+&]/", "", $data[2]) ? preg_replace("/[^0-9+&]/", "", $data[2]) : '0' ));
    
    // var_dump($data_each);
    // echo "</br></br>";
    mysqli_query($database->con(), "INSERT INTO volunteer (nij, full_name, crew_chief, pic, team_id) VALUES ('".$data_each['nij']."','".$data_each['full_name']."','".$data_each['crew_chief']."','".$data_each['pic']."','".$data_each['team_id']."')");
}

?>