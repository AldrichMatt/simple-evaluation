<?php
$title = "Teams";

include "Controller.php";
$controller = new Controller();
$controller->verifyUser();
$controller->verifyRolePIC();
$_SESSION['edit_team'] = null;

include "layout.php";

$team_data = $model->get('team');
$team_leaders = $controller->getTeamLeaders();
// var_dump($team_leaders);
$data= $_SESSION['data'];
$status = '';

if (isset($_SESSION['success_team'])) {
  $status = '<div class="flex text-start bg-[#33ff33]/25 text-black rounded-lg text-md px-4 py-4 w-full">'.$_SESSION['success_team'].'</div>';
}else{

}
?>

<div class="px-4 md:px-16 lg:px-24 py-4 md:py-8 lg:py-16">
        <span class="text-4xl font-bold">Teams</span></br>
        <span class="text-lg font-semibold">View and manage teams from this page</span>
        <?=$status;?>
        <form action="Controller.php/addTeam" method="post">
        <div class="flex flex-row flex-wrap my-4">
            <label for="">Id (Please fill the Id with the same number as Team Name) e.g: 1</label>
            <input type="number" required name="team_id" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="1"></input>
            <label for="">Team Name (Please fill the Team Name with the same number as Id) e.g: Team 1</label>
            <input type="text" required name="team_name" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Team 1"></input>
            <label for="">Crew Chief</label>
            <select name="team_leader" required class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
              <option>-</option>
                <?php
                foreach($team_leaders as $crew_chief):
                ?>
                  <option value="<?=$crew_chief['full_name']?>"><?=$crew_chief['full_name']?></option>
                <?php endforeach; ?>
            </select>
          </div>
          <button class="h-10 w-full text-center bg-[#ff3333] text-white rounded-lg my-2 focus:outline-2 focus:outline-[#ff3333]">Add Team</button>

      </form>

      <table class="flex flex-col flex-wrap w-full my-4 justify-around">
          <thead class="h-10">
          <tr class="flex flex-row flex-wrap justify-around border-b-2 px-4 -mt-2 py-2 border-neutral-500 text-neutral-300 bg-neutral-950 rounded-ss-lg rounded-se-lg ">
            <th class="w-1/4 text-start">Id</th>
            <th class="w-1/4 text-start">Team Name</th>
            <th class="w-1/4 text-start">Crew Chief</th>
            <th class="w-1/4 text-start">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($team_data as $team):
          ?>
            <tr class="flex flex-row flex-wrap items-center justify-around px-4 py-2 even:bg-neutral-300 border-b-2 border-neutral-500 ">
              <td class="w-1/4 text-start"><?=$team['id']?></td>
              <td class="w-1/4 text-start"><?=$team['team_name']?></td>
              <td class="w-1/4 text-start"><?=($team['team_leader'] != '') ? $team['team_leader'] : '-' ?></td>
              <td class="w-1/4 text-start">
              <form class="flex flex-row flex-wrap" method="post" action="Controller.php/actionTeam">
                <input type="hidden" name="team_id" value='<?=$team['id']?>'>
                <button type="submit" name="action" value="edit" class="flex scale-down bg-[#ffab00] w-1/6 rounded-lg mr-2 py-2 justify-center"><img width="25px" height="25px" src="asset/pencil.png" alt=""></button>
                <button type="submit" name="action" value="delete" class="flex scale-down bg-[#ff3333] w-1/6 rounded-lg mr-2 py-2 justify-center"><img width="25px" height="25px" src="asset/trash.png" alt=""></button>
              </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
</div>