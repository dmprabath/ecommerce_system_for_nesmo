<?php

 require_once("config.php"); 
 if(isset($_GET["type"])){
    $type = $_GET["type"];
     $type();

}
     $uploadDir = 'picture/';
    $response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
    




 function getCatId(){
     $dbobj = DB::connect();
     $sql = "SELECT cat_id FROM tbl_category ORDER BY cat_id DESC LIMIT 1;"  ;
     $result = $dbobj->query($sql);

     if($dbobj->errno){
         echo("SQL Error : ".$dbobj->error );
         exit;
     }
     $nor = $result->num_rows;

     if($nor == 0){
         $newid = "CAT00001";
     }else{
         $rec = $result->fetch_assoc();
         $lastid =$rec["cat_id"];
         $num = substr($lastid,3);
         $num++;
         $newid="CAT".str_pad($num,5,"0",STR_PAD_LEFT);
     }
     $dbobj->close();
     $newid = str_replace(' ', '', $newid);
    return $newid;
 }
 function viewCategories(){

    $table ='tbl_category';

    $primaryKey ='cat_id';

    $columns = array(
        array( 'db' => 'cat_id', 'dt'=> 0),
        array( 'db' => 'cat_name', 'dt'=> 1),

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
 function AddNewCategories(){
     $cat_id = $_POST['cat_id'];
     $cat_name = $_POST["cat_name"];

     $dbobj = DB::connect();
     $sql = "INSERT INTO tbl_category (cat_id, cat_name) VALUES('$cat_id','$cat_name')";

     $result = $dbobj->prepare($sql);

     if($dbobj->errno){
         echo("SQL Error : ".$dbobj->error );
         exit;
     }
     if(!$result->execute()){
         sleep(1);
         echo ("0,Sorry, please try again later");
     }else{
         sleep(1);
         echo ("1,Category created successfully");
     }

$dbobj->close();
 }


?>