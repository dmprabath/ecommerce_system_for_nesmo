<?php
require_once("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();
}

function getCusId(){
    $dbobj = DB::connect();
    $sql = "SELECT cus_id FROM tbl_customers Order BY cus_id DESC LIMIT 1;";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error );
        exit;
    }
    $nor = $result->num_rows;

    if($nor == 0){
        $newCusId = "1";
    }else {
        $rec = $result->fetch_assoc();
        $newCusId =$rec["cus_id"];
        $newCusId++;
    }
    $dbobj->close();
    return $newCusId;
}

function addNewCus(){

    $fname =$_POST["f_name"];
    $cus_email=$_POST["txt_email"];
    $cus_number =$_POST["con_number"];
    $cus_pass =$_POST["txt_pass"];    
    $gender = $_POST["gender"];
    $birthdate =$_POST["bdate"];
    $status = 1;


 $dbobj =DB::connect();

 $sql = "INSERT INTO `tbl_customer` (`cus_name`,`cus_email`,`cus_contact`,`cus_password`,`cus_gender`,`cus_dob`,`cus_status`)
 VALUES ('$fname','$cus_email','$cus_number','$cus_pass','$gender','$birthdate','$status' );";

 $stmt =$dbobj->prepare($sql);
 if(!$stmt->execute()){
     echo ("0,SQL Error ".$stmt->error);
 }else{
     echo("1,Created successfully ");
 }
 $stmt->close();
 $dbobj->close();

}

function viewCustomer(){
    //echo("viewEmp");
    // DB table to use
    $table = 'tbl_customers';

    // Table's primary key
    $primaryKey = 'cus_id';

    $columns = array(
        array( 'db' => 'cus_id', 'dt' => 0 ),
        array( 'db' => 'cus_fname',  'dt' => 1 ),
        array( 'db' => 'cus_email',  'dt' => 2 ),
        array( 'db' => 'cus_mobile',   'dt' => 3 ),
        array( 'db' => 'cus_jdate',   'dt' => 4 ),
        array( 'db' => 'cus_status',   'dt' => 5 )
    );

    // SQL server connection information
    require_once("config.php");
    $host = Config::$host;
    $user = Config::$db_uname;
    $pass = Config::$db_upass;
    $db = Config::$db_name;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
        SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null )
    );
}

function viewCusProfile(){
    $cusid = $_POST["cusid"];
    $dbobj = DB::connect();
    $sql = "SELECT * FROM tbl_customers cus JOIN tbl_cus_address addr ON cus.cus_id = addr.cus_id WHERE cus.cus_id='$cusid' ;";

    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $rec = $result->fetch_assoc();
    echo(json_encode($rec));
    $dbobj->close();
}

function changeStatus(){
     $cusid = $_POST['cusid'];

     $dbobj = DB::connect();
     $sql = "UPDATE tbl_customers SET cus_status =(CASE WHEN cus_status=1 THEN 0 WHEN cus_status=0 THEN 1 END) WHERE cus_id = '$cusid';";
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