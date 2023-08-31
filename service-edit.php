<?php
$title = "Details";
include "Controller.php";
$controller = new Controller();
$controller->verifyUser();

if(isset($_SESSION['edit_service'])){
    $data = $_SESSION['edit_service'];
}else{
    header("Location: ".$path."service.php");
    die();
}
include "layout.php";

$data = '';

?>
    <div class="px-4 md:px-16 lg:px-24 py-4 md:py-8 lg:py-16">
        <a href="<?=$path?>service.php" class="underline"><-Back</a><br>
        <form action="Controller.php/actionservice" method="post">
        <div class="flex flex-row flex-wrap my-4">
            <label for="">Id (Please fill the Id with the same number as service Name) e.g: 1</label>
            <input type="hidden" required name="old_service_id" value="<?=$_SESSION['edit_service']['id']?>" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="1"></input>
            <input type="number" required name="service_id" value="<?=$_SESSION['edit_service']['id']?>" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="1"></input>
            <label for="">Service Name</label>
            <input type="text" required name="service_name" value="<?=$_SESSION['edit_service']['service_name']?>" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Service name"></input>
          </div>
          <button type="submit" name="action" value="update" class="h-10 w-full text-center bg-[#ff3333] text-white rounded-lg my-2 focus:outline-2 focus:outline-[#ff3333]">Update service</button>

      </form>
    </div>
</div>
