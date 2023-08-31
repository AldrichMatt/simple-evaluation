<?php
$title = "Details";
include "Controller.php";
$controller = new Controller();
$controller->verifyUser();

$data = '';

if(isset($_SESSION['evaluation_data'])){
    $data = $_SESSION['evaluation_data'];
    $details = json_decode($data['details']);
}else{
    header("Location: dashboard.php");
    die();
}
include "layout.php";
?>
    <div class="px-4 md:px-16 lg:px-24 py-4 md:py-8 lg:py-16">
        <a href="<?=$path?>dashboard.php" class="underline"><-Back</a><br>
        <span class="text-2xl font-semibold">Evaluation #<?=$data['id']?></span><br>
        <span class="text-xl font-semibold"><?=$data['date']?></span><br><br>
        <span class="text-xl font-semibold">Team Leader : <?=$data['team_leader']?></span><br>
        <span class="text-xl font-semibold">Team <?=$data['team_id']?></span><br>
        <span class="text-xl font-semibold">Service : <?= $model->get_where('service','id','=',$data['service_id'])['service_name']?></span><br><br>
        <span class="text-2xl font-semibold">Details</span><br><br>
        <div class="columns-2">
            <div class="flex flex-col flex-wrap mb-4">
                <div class="text-xl font-semibold">PIC</div>
                <span>PIC : <?=$details->names->pic_name?></span>
                <span>Note : <?=$details->notes->pic_note?></span>
            </div>
            <div class="flex flex-col flex-wrap mb-4">
                <div class="text-xl font-semibold">VD</div>
                <span>VD : <?=$details->names->vd_name?></span>
                <span>Note : <?=$details->notes->vd_note?></span>
            </div>
            <div class="flex flex-col flex-wrap mb-4">
                <div class="text-xl font-semibold">TO</div>
                <span>TO : <?=$details->names->to_name?></span>
                <span>Note : <?=$details->notes->to_note?></span>
            </div>
            <div class="flex flex-col flex-wrap mb-4">
                <div class="text-xl font-semibold">Content</div>
                <span>Content : <?=$details->names->content_name?></span>
                <span>Note : <?=$details->notes->content_note?></span>
            </div>
            <div class="flex flex-col flex-wrap mb-4">
                <div class="text-xl font-semibold">Moving 3</div>
                <span>Moving 3 : <?=$details->names->moving3_name?></span>
                <span>Note : <?=$details->notes->moving3_note?></span>
            </div>
            <div class="flex flex-col flex-wrap mb-4">
                <div class="text-xl font-semibold">Moving 4</div>
                <span>Moving 4 : <?=$details->names->moving4_name?></span>
                <span>Note : <?=$details->notes->moving4_note?></span>
            </div>
        </div>
    </div>
</div>
