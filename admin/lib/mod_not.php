<?php

require_once("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();

}
function viewINNotification(){
$user_id = $_GET['user'];
    $table = <<<EOT
	( SELECT not_id, not_title, not_message, not_type, not_date, not_time,not_from, not_to, not_status, emp_fname FROM tbl_notification  JOIN tbl_users ON tbl_notification.not_from = tbl_users.emp_id ORDER BY tbl_notification.not_id ASC
		) temp
EOT;

    $primaryKey ='not_id';
    $where = ("not_to ='$user_id' AND not_type='1'");


    $columns = array(
        array( 'db' => 'not_date', 'dt'=> 0),
        array( 'db' => 'not_time', 'dt'=> 1),
        array( 'db' => 'emp_fname', 'dt'=> 2),
        array( 'db' => 'not_title', 'dt'=> 3),
        array( 'db' => 'not_message', 'dt'=> 4),
        array( 'db' => 'not_status', 'dt'=> 5),
        array( 'db' => 'not_id', 'dt'=> 6),

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
        SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null,$where )
    );
}

function viewOUTNotification(){
    $user_id = $_GET['user'];
    $table = <<<EOT
	( SELECT not_id, not_title, not_message, not_type, not_date, not_time,not_from, not_to, not_status, emp_fname FROM tbl_notification  JOIN tbl_users ON tbl_notification.not_from = tbl_users.emp_id ORDER BY tbl_notification.not_id ASC
		) temp
EOT;

    $primaryKey ='not_id';
    $where = ("not_to ='$user_id' AND not_type='0'");


    $columns = array(
        array( 'db' => 'not_date', 'dt'=> 0),
        array( 'db' => 'not_time', 'dt'=> 1),
        array( 'db' => 'emp_fname', 'dt'=> 2),
        array( 'db' => 'not_title', 'dt'=> 3),
        array( 'db' => 'not_message', 'dt'=> 4),
        array( 'db' => 'not_status', 'dt'=> 5),
        array( 'db' => 'not_id', 'dt'=> 6),

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
        SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null,$where )
    );
}

function readMessage(){
    $not_id = $_POST['notid'];
    $dbobj = DB::connect();

    $sql = "UPDATE  tbl_notification SET not_status='0' WHERE not_id='$not_id'";

    $result = $dbobj->prepare($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    if(!$result->execute()){
        echo ("0");
    }else{
        echo("1");
    }
}



?>