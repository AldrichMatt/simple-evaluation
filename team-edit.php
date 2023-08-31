<?php
$title = "Details";
include "Controller.php";
$controller = new Controller();
$controller->verifyUser();

$team_leaders = $controller->getTeamLeaders();
if(isset($_SESSION['edit_team'])){
    $data = $_SESSION['edit_team'];
}else{
    header("Location: ".$path."team.php");
    die();
}
include "layout.php";

$data = '';

?>
    <div class="px-4 md:px-16 lg:px-24 py-4 md:py-8 lg:py-16">
        <a href="<?=$path?>team.php" class="underline"><-Back</a><br>
        <form action="Controller.php/actionTeam" method="post">
        <div class="flex flex-row flex-wrap my-4">
            <label for="">Id (Please fill the Id with the same number as Team Name) e.g: 1</label>
            <input type="hidden" required name="old_team_id" value="<?=$_SESSION['edit_team']['id']?>" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="1"></input>
            <input type="number" required name="team_id" value="<?=$_SESSION['edit_team']['id']?>" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="1"></input>
            <label for="">Team Name (Please fill the Team Name with the same number as Id) e.g: Team 1</label>
            <input type="text" required name="team_name" value="<?=$_SESSION['edit_team']['team_name']?>" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Team 1"></input>
            <label for="">Crew Chief</label>
            <select name="team_leader" required class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
              <option value="<?=$_SESSION['edit_team']['team_leader']?>"><?=($_SESSION['edit_team']['team_leader']!== "")? $_SESSION['edit_team']['team_leader'] : '-' ?></option>
                <?php
                foreach($team_leaders as $crew_chief):
                ?>
                  <option value="<?=$crew_chief['full_name']?>"><?=$crew_chief['full_name']?></option>
                <?php endforeach; ?>
            </select>
          </div>
          <button type="submit" name="action" value="update" class="h-10 w-full text-center bg-[#ff3333] text-white rounded-lg my-2 focus:outline-2 focus:outline-[#ff3333]">Update Team</button>

      </form>
    </div>
</div>
