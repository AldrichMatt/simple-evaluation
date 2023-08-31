<?php
$title = "Evaluation Form";

include "Controller.php";
$controller = new Controller();
$controller->verifyUser();
$controller->verifyRoleCC();
$date = $controller->getDate();
include "layout.php";
$data= $_SESSION['data'];
if(preg_match('/,/i',$data['team_id'])){
  @$team_member = $_SESSION['team_data'];
}else{
  $team_member = $controller->getTeamMember($data['team_id']);
}

$services = $controller->getService();
?>
<script>
    // $('document').ready(getTeamMember());
    $('window').on('load', getTeamMember());
    function getTeamMember(){
      var team_id = $('#team_id').val();
      console.log(team_id);
      $.ajax({
        method : "POST",
        url : "<?=$path?>/Controller.php/getTeamMember",
        dataType : "json",
        data : {
          team_id : team_id
        },
        complete: function(data){
            $('#form').load(location.href + ' #form','200');

        }
      })
    };
  </script>
   <form action="Controller.php/evaluation" method="POST"> 
     <div class="px-4 md:px-16 lg:px-24 py-4 md:py-8 lg:py-16">
   <span class="text-4xl font-bold">Welcome,</span></br><span class="text-2xl font-semibold"><?=$data['full_name']?>! </span><br>
          <input type="hidden" name="date" value="<?=$date?>">
          <span>Team Leader</span>
          <input type="text" value="<?=$data['full_name']?>" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" disabled>
          <input type="hidden" name="team_leader" value="<?=$data['full_name']?>">
          <!-- <input name="team_leader" type="text" value="" disabled class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]"></input> -->
          <span>Team Id</span>
          <?php if(explode(',',$data['team_id'])){
            $teams = explode(',', $data['team_id']);
            // var_dump($teams);
            echo '<select name="team_id" onchange="getTeamMember()" id="team_id" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">';
            echo '<option value="">-</option>';
            foreach ($teams as $team) {
              echo '<option value="'.$team.'">'.$team.'</option>';
            }
            echo '</select>';
          }else{
          }?>
          <!-- <input name="team_id" type="text" value="" disabled class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]"></input> -->
          <span>Service</span>
          <select name="service_id" id="" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
            <option value=''>-</option>
          <?php
            foreach($services as $service):
              ?>
                <option value="<?=$service['id']?>"><?=$service['service_name']?></option>
            <?php
            endforeach;
            ?>
          </select>
          <div id="form">
          <div class="flex my-6 flex-col flex-wrap">
          <span>PIC</span>
          <select required name="pic_name" id="" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
            <option value="">-</option>
            <?php
            foreach($team_member as $member):
              ?>
                <option value="<?=$member['full_name']?>"><?=$member['full_name']?></option>
            <?php
            endforeach;
            ?>
          </select>
          <input type="text" value="" name="pic_note" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Note"></input>
        </div>  
          <div class="flex my-6 flex-col flex-wrap">

            <span>Camera Center</span>
          <select required name="center_name" id="" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
            <option value="">-</option>
            <?php
            foreach($team_member as $member):
              ?>

                <option value="<?=$member['full_name']?>"><?=$member['full_name']?></option>
            <?php
            endforeach;
            ?>
          </select>
          <input type="text" value="" name="center_note" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Note"></input>
        </div>
          <div class="flex my-6 flex-col flex-wrap">

            <span>Camera Moving 3</span>
          <select name="moving3_name" id="" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
            <option value="">-</option>
            <?php
            foreach($team_member as $member):
              ?>

                <option value="<?=$member['full_name']?>"><?=$member['full_name']?></option>
            <?php
            endforeach;
            ?>
          </select>
          <input type="text" value="" name="moving3_note" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Note"></input>
        </div>
          <div class="flex my-6 flex-col flex-wrap">

            <span>Camera Moving 4</span>
          <select name="moving4_name" id="" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
            <option value="">-</option>
            <?php
            foreach($team_member as $member):
              ?>

                <option value="<?=$member['full_name']?>"><?=$member['full_name']?></option>
            <?php
            endforeach;
            ?>
          </select>
          <input type="text" value="" name="moving4_note" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Note"></input>
        </div>
          <div class="flex my-6 flex-col flex-wrap">

            <span>Text Operator</span>
          <select required name="to_name" id="" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
            <option value="">-</option>
            <?php
            foreach($team_member as $member):
              ?>

                <option value="<?=$member['full_name']?>"><?=$member['full_name']?></option>
            <?php
            endforeach;
            ?>
          </select>
          <input type="text" value="" name="to_note" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Note"></input>
        </div>
          <div class="flex my-6 flex-col flex-wrap">

            <span>Content Operator</span>
          <select required name="content_name" id="" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
            <option value="">-</option>
            <?php
            foreach($team_member as $member):
              ?>

                <option value="<?=$member['full_name']?>"><?=$member['full_name']?></option>
            <?php
            endforeach;
            ?>
          </select>
          <input type="text" value="" name="content_note" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Note"></input>
        </div>
          <div class="flex my-6 flex-col flex-wrap">

            <span>Video Director (VD)</span>
          <select required name="vd_name" id="" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]">
            <option value="">-</option>
            <?php
            foreach($team_member as $member):
              ?>

                <option value="<?=$member['full_name']?>"><?=$member['full_name']?></option>
            <?php
            endforeach;
            ?>
          </select>
          <input type="text" value="" name="vd_note" class="h-10 w-full bg-neutral-300 rounded-ss-lg rounded-se-lg px-4 my-2 border-b-2 border-neutral-500 focus:outline-0 focus:border-[#ff3333]" placeholder="Note"></input>
        </div>
            <button class="h-10 w-full text-center bg-[#ff3333] text-white rounded-lg my-2 focus:outline-2 focus:outline-[#ff3333]">Submit</button>
        </div>
      </form>
      
    </div>
    
  </div>
  </div>
  