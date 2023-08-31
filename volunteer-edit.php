<?php
$title = "Details";
include "Controller.php";
$controller = new Controller();
$controller->verifyUser();

if(isset($_SESSION['edit_volunteer'])){
}else{
  header("Location: ".$path."volunteer.php");
  die();
}
$team_data = $model->get('team');
$data = $_SESSION['edit_volunteer'];
include "layout.php";

?>
    <div class="px-4 md:px-16 lg:px-24 py-4 md:py-8 lg:py-16">
        <a href="<?=$path?>volunteer.php" class="underline"><-Back</a><br>
        <form action="Controller.php/actionVolunteer" method="post">
        <div class="flex flex-row flex-wrap my-4" id="form_content">
            <label class="w-full font-semibold text-lg" for="">Volunteer's Full Name</label>
            <input type="hidden" required name="id" value="<?=$_SESSION['edit_volunteer']['id']?>"></input>
            <input type="text" required name="full_name" value="<?=$_SESSION['edit_volunteer']['full_name']?>" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="John Doe"></input>
            <label class="w-full font-semibold text-lg" for="">NIJ</label>
            <input type="number" required name="nij" value="<?=preg_replace('/[[:^print:]]/', '', $_SESSION['edit_volunteer']['nij'])?>" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="xxxxxxxx"></input>
            <label class="w-full font-semibold text-lg" for="">Team</label>
            <select name="team_id" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
              <?php
              if($_SESSION['edit_volunteer']['team_id'] == "0"){
                echo '<option value="">Team 0</option>';
              } else{
                echo '<option value="'.$_SESSION[`edit_volunteer`][`team_id`].'">Team '.$_SESSION[`edit_volunteer`][`team_id`].'('.$team_data[(int) $_SESSION[`edit_volunteer`][`team_id`] - 1]['team_leader'].')</option>';
              }
              ?>
              <?php
              foreach($team_data as $team):
                ?>
                <option value="<?=$team['id']?>"><?=$team['team_name'].' ('.$team['team_leader'].')'?></option>
                <?php
                    endforeach;
                ?>
            </select>
            <div class="flex flex-row flex-wrap w-full py-2">
                <label class="w-full font-semibold text-lg" for="">Crew Chief</label>
                <input type="radio" required name="crew_chief" class="mx-2" value="0" <?php if($_SESSION['edit_volunteer']['crew_chief'] == "0") {echo "checked";}?>>No</input>
                <input type="radio" required name="crew_chief" class="mx-2" value="1" <?php if($_SESSION['edit_volunteer']['crew_chief'] == "1") {echo "checked";}?>>Yes</input>
            </div>
            <div class="flex flex-row flex-wrap w-full py-2">
                <label class="w-full font-semibold text-lg" for="">PIC</label>
                <input type="radio" required name="pic" class="mx-2" value="0" <?php if($_SESSION['edit_volunteer']['pic'] == "0") {echo "checked";}?> >No</input>
                <input type="radio" required name="pic" class="mx-2" value="1" <?php if($_SESSION['edit_volunteer']['pic'] == "1") {echo "checked";}?> >Yes</input>
            </div>  
          <button type="submit" name="action" value="update" class="h-10 w-full text-center bg-[#ff3333] text-white rounded-lg my-2 focus:outline-2 focus:outline-[#ff3333]">Update Volunteer</button>
        </div>
      </form>
    </div>
</div>
