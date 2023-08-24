<?php
$title = "Home";

include "layout.php";

$volunteer_data = $model->fetch_table("volunteer");
print_r($volunteer_data);
?>

Hello