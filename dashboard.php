<?php
$title = "Home";
$status = "";
include "Controller.php";
$controller = new Controller();
$controller->verifyUser();
$evaluations = $controller->getDataEvaluation();
include "layout.php";

$data= $_SESSION['data'];
if (isset($_SESSION['success_evaluation'])) {
    $status = '<div class="flex text-start bg-[#33ff33]/25 text-black rounded-lg text-md px-4 py-4 w-full">'.$_SESSION['success_evaluation'].'</div>';
  }else{
  
  }
?>
    <div class="px-4 md:px-16 lg:px-24 py-4 md:py-8 lg:py-16">
        <span class="text-4xl font-bold">Welcome,</span></br><span class="text-2xl font-semibold"><?=$data['full_name']?>! </span></br></br></br>
        <span class="text-2xl font-bold">Dashboard</span></br>
        <span class="text-lg font-semibold">View and manage evaluations from this page</span>
        <?=$status;?>
        <table class="flex flex-col flex-wrap w-full my-4 justify-around">
          <thead class="h-10">
          <tr class="flex flex-row flex-wrap justify-around border-b-2 px-4 -mt-2 py-2 border-neutral-500 text-neutral-300 bg-neutral-950 rounded-ss-lg rounded-se-lg ">
            <th class="w-1/6 text-start">Id</th>
            <th class="w-1/6 text-start">Date</th>
            <th class="w-1/6 text-start">Team Leader</th>
            <th class="w-1/6 text-start">Team Id</th>
            <th class="w-1/6 text-start">Service</th>
            <th class="w-1/6 text-start">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($evaluations as $evaluation):
          ?>
            <tr class="flex flex-row flex-wrap items-center justify-around px-4 py-2 even:bg-neutral-300 border-b-2 border-neutral-500 ">
              <td class="w-1/6 text-start"><?=$evaluation['id']?></td>
              <td class="w-1/6 text-start"><?=$evaluation['date']?></td>
              <td class="w-1/6 text-start"><?=$evaluation['team_leader'] ?></td>
              <td class="w-1/6 text-start"><?=$evaluation['team_id'] ?></td>
              <td class="w-1/6 text-start"><?= $model->get_where('service','id','=',$evaluation['service_id'])['service_name']?></td>
              <td class="w-1/6 text-start">
              <form class="flex flex-row flex-wrap" method="post" action="Controller.php/actionEvaluation">
                <input type="hidden" name="evaluation_id" value='<?=$evaluation['id']?>'>
                <button type="submit" name="action" value="view" class="flex scale-down bg-[#676767] w-1/6 rounded-lg mr-2 px-1 py-2 justify-center"><img width="25px" height="25px" src="asset/eye.png" alt=""></button>
                <!-- <button type="submit" name="action" value="delete" class="flex scale-down bg-[#ff3333] w-1/6 rounded-lg mr-2 px-1 py-2 justify-center"><img width="25px" height="25px" src="asset/trash.png" alt=""></button> -->
              </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
</div>