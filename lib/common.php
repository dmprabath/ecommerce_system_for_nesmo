<?php
//require("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();
}
/*----------------------Generate New Id --------------------------   */

function countcusnotification($cusid){
    //$cusid = $_POST['cusid'];
    $dbobj = DB::connect();
    $sql = "SELECT * FROM tbl_notification nots JOIN tbl_cus_notification cus ON nots.not_id = cus.notif_id  WHERE cus_id ='$cusid' AND not_status='0'";
    $result = $dbobj->query($sql);
    $count = $result->num_rows;
    if ($count=="0"){
        echo " <span class='badge badge-danger badge-counter'></span>";
    }else{
        echo " <span class='badge badge-danger badge-counter'>".$count."</span>";
    }
    
    $dbobj->close();
}


?>