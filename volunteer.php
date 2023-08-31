<?php
$title = "Volunteers";
$status = '';

include "Controller.php";
$controller = new Controller();
$controller->verifyUser();
$controller->verifyRolePIC();
include "layout.php";

$team_data = $model->get('team');
$volunteer_data = $model->get('volunteer');
$data= $_SESSION['data'];

if (isset($_SESSION['success_volunteer'])) {
    $status = '<div class="flex text-start bg-[#33ff33]/25 text-black rounded-lg text-md px-4 py-4 w-full">'.$_SESSION['success_volunteer'].'</div>';
}else{

}

?>

<div class="px-4 md:px-16 lg:px-24 py-4 md:py-8 lg:py-16">
<span class="text-4xl font-bold">Volunteers</span></br>
        <span class="text-lg font-semibold">View and manage volunteers from this page</span>
      <?=$status;?>
      <form action="Controller.php/addVolunteer" method="post">
        <div class="flex flex-row flex-wrap my-4" id="form_content">
            <label class="w-full font-semibold text-lg" for="">Volunteer's Full Name</label>
            <input type="text" required name="full_name" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="John Doe"></input>
            <label class="w-full font-semibold text-lg" for="">NIJ</label>
            <input type="number" required name="nij" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="xxxxxxxx"></input>
            <label class="w-full font-semibold text-lg" for="">Team</label>
            <select name="team_id" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
                <option value="">-</option>
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
                <input type="radio" required name="crew_chief" class="mx-2" value="0" checked>No</input>
                <input type="radio" required name="crew_chief" class="mx-2" value="1">Yes</input>
            </div>
            <div class="flex flex-row flex-wrap w-full py-2">
                <label class="w-full font-semibold text-lg" for="">PIC</label>
                <input type="radio" required name="pic" class="mx-2" value="0" checked>No</input>
                <input type="radio" required name="pic" class="mx-2" value="1">Yes</input>
            </div>  
          <button class="h-10 w-full text-center bg-[#ff3333] text-white rounded-lg my-2 focus:outline-2 focus:outline-[#ff3333]">Add Volunteer</button>
        </div>
      </form>
      <table class="flex flex-col flex-wrap w-full my-4 justify-around">
          <thead class="h-10">
          <tr class="flex flex-row flex-wrap justify-around border-b-2 px-4 -mt-2 py-2 border-neutral-500 text-neutral-300 bg-neutral-950 rounded-ss-lg rounded-se-lg ">
            <th class="w-1/6 text-start">Id</th>
            <th class="w-1/6 text-start">Full Name</th>
            <th class="w-1/6 text-start">NIJ</th>
            <th class="w-1/6 text-start">Role</th>
            <th class="w-1/6 text-start">Team</th>
            <th class="w-1/6 text-start">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($volunteer_data as $volunteer):
          ?>
            <tr class="flex flex-row flex-wrap items-center justify-around px-4 py-2 even:bg-neutral-300 border-b-2 border-neutral-600 ">
              <td class="w-1/6 text-start"><?=$volunteer['id']?></td>
              <td class="w-1/6 text-start"><?=$volunteer['full_name']?></td>
              <td class="w-1/6 text-start"><?=$volunteer['nij']?></td>
              <td class="w-1/6 text-start"><?=(($volunteer['crew_chief'] != '0') ? "Crew Chief" : '-') .", ".(($volunteer['pic'] == '1') ? "PIC" : (($volunteer['pic'] == '2') ? 'PIC EK' : '-'))?></td>
              <td class="w-1/6 text-start"><?php
              if(explode(',',$volunteer['team_id']) == false){
                echo "Team ". $volunteer['team_id'];
                }else{
                $multi_team = explode(',',$volunteer['team_id']);
                foreach ($multi_team as $key=>$team) {
                    echo "Team ". $multi_team[$key].', ';
                  }
              }
              ?></td>
              <td class="w-1/6 text-start">
              <form class="flex flex-row flex-wrap" method="post" action="Controller.php/actionVolunteer">
                <input type="hidden" name="id" value='<?=$volunteer['id']?>'>
                <input type="hidden" name="full_name" value='<?=$volunteer['full_name']?>'>
                <button type="submit" name="action" value="edit" class="flex scale-down bg-[#ffab00] w-1/6 rounded-lg mr-2 py-2 justify-center"><img width="25px" height="25px" src="asset/pencil.png" alt=""></button>
                <button type="submit" name="action" value="delete" class="flex scale-down bg-[#ff3333] w-1/6 rounded-lg mr-2 py-2 justify-center"><img width="25px" height="25px" src="asset/trash.png" alt=""></button>
              </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
</div>
</div>
<script>
    
    $('#security').on('change', function(){
        if(this.value == 1){
            const form = document.getElementById('form_content');
            form.innerHTML += `<label for="">Team</label><input type="radio" required name="full_name" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="John Doe"></input>`
            $('#1').prop('selected', true);
        }else{

        };
    });
</script>