<?php

require_once("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();

}
function getSupId(){
    $dbobj = DB::connect();
    $sql = "SELECT sup_id FROM tbl_suppliers ORDER BY sup_id DESC LIMIT 1;"  ;
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error );
        exit;
    }
    $nor = $result->num_rows;

    if($nor == 0){
        $supid = "SUP0001";
    }else{
        $rec = $result->fetch_assoc();
        $lastid =$rec["sup_id"];
        $num = substr($lastid,3);
        $num++;
        $supid="SUP".str_pad($num,4,"0",STR_PAD_LEFT);
    }
    $dbobj->close();
    $supid = str_replace(' ', '', $supid);
    return $supid;
}

function viewSupplier(){

    $table ="tbl_suppliers";

    $primaryKey ='sup_id';

    $columns = array(

        array( 'db' => 'sup_id', 'dt'=> 0),
        array( 'db' => 'sup_name', 'dt'=> 1),
        array( 'db' => 'sup_contact', 'dt'=> 2),
        array( 'db' => 'sup_email', 'dt'=> 3),
        array( 'db' => 'sup_address', 'dt'=> 4)

    );
    require_once('config.php');
    $host = Config::$host ;
    $user = Config::$db_uname ;
    $pass = Config::$db_upass ;
    $db = Config::$db_name ;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
        SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null )
    );
}
function addNewSupplier(){
    $supid = $_POST['sup_id'];
    $supname = $_POST['sup_name'];
    $supmobile = $_POST['sup_mobile'];
    $supemail = $_POST['sup_email'];
    $supaddress = $_POST['sup_address'];
    $status = 1;



    $dbobj = DB::connect();
    $sql ="INSERT INTO tbl_suppliers (sup_id,sup_name,sup_contact,sup_email,sup_address,sup_status) VALUES ('$supid','$supname','$supmobile','$supemail','$supaddress','$status')";
    $result = $dbobj->prepare($sql);
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error );
        exit;
    }

    sleep(1);
    if(!$result->execute()){
        echo ("0,Something Missing");
    }else{
        echo("1,Successfully Updated");
    }

}
function updateSupplier(){
    $supid = $_POST['vsup_id'];
    $supname = $_POST['vsup_name'];
    $supmobile = $_POST['vsup_mobile'];
    $supemail = $_POST['vsup_email'];
    $supaddress = $_POST['vsup_address'];

    $dbobj = DB::connect();
    $sql ="UPDATE tbl_suppliers SET sup_name='$supname',sup_contact='$supmobile',sup_email='$supemail',sup_address='$supaddress' WHERE sup_id='$supid'";
    $result = $dbobj->prepare($sql);
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error );
        exit;
    }
    sleep(1);
    if(!$result->execute()){
        echo ("0,Something Missing");
    }else{
        echo("1,Successfully Updated");
    }

}
function changeStatus(){
    $supid = $_POST['supid'];

    $dbobj = DB::connect();
    $sql = "UPDATE tbl_suppliers SET sup_status =(CASE WHEN sup_status=1 THEN 0 WHEN sup_status=0 THEN 1 END) WHERE sup_id = '$supid';";
    $stmt = $dbobj->prepare($sql);

    if(!$stmt->execute()){
        echo("0,SQL Error : ".$stmt->error);
    }
    else{
        echo("1,Successfully Changed!");
    }
    $stmt->close();
    $dbobj->close();
}

?>