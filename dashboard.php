<?php
$title = "Home";

include "Controller.php";
$controller = new Controller();
$controller->verifyUser();
include "layout.php";

$data= $_SESSION['data'];
?>
    <div class="px-4 md:px-16 lg:px-24 py-4 md:py-8 lg:py-16">
        <span class="text-4xl font-bold">Welcome,</span></br><span class="text-2xl font-semibold"><?=$data['full_name']?>! </span>
</div>