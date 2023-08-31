<?php
$title = "Login";
$status = '';
require_once("Controller.php");
$controller = new Controller();
$controller->verifyUser();
include "login-layout.php";
if(isset($_SESSION['status'])){
  if($_SESSION['status'] == 'authfail'){
    $status = '<div class="flex text-start bg-[#ff3333]/25 text-black rounded-lg text-md px-4 py-4 w-full">Login Failed, NIJ invalid, or try contacting local administrator</div>';
}else{
  
}};

?>

<div class="flex w-full h-full fixed items-center px-auto py-auto justify-center flex-col">
    <img
          src="asset/GMS.png"
          style="height: 140px"
          alt="TE Logo"
          loading="lazy" />
      <div class="bg-neutral-200 px-16 py-8 w-4/6 rounded-lg">
        <?=$status;?>
        <div class="text-4xl text-neutral-950 font-bold my-8">Log In</div>
        <!-- <div class="flex flex-row flex-wrap my-4">
          <label for="">Full Name</label>
          <input type="text" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Full name"></input>
        </div> -->
        <form action="Controller.php/auth" method="post">
        <div class="flex flex-row flex-wrap my-4">
            <label for="">NIJ</label>
            <input type="number" required name="nij" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="NIJ"></input>
          </div>
          <button class="h-10 w-full text-center bg-[#ff3333] text-white rounded-lg my-2 focus:outline-2 focus:outline-[#ff3333]">Log In</button>
        </div>
      </form>
    </div>

<?php
include "footer.php";
?>