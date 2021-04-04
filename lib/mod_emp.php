<?php
 require_once("config.php");
 if(isset($_GET["type"])){
    $type = $_GET["type"];
 }


 function getEmpId(){
     $dbobj = DB::connect();
     $sql = "SELECT emp_id FROM tbl_employee ORDER BY emp_id DESC LIMIT 1;"  ;
     $result = $dbobj->query($sql);

     if($dbobj->errno){
         echo("SQL Error : ".$dbobj->error );
         exit;
     }
     $nor = $result->num_rows;

     if($nor == 0){
         $newid = "EMP00001";
     }else{
         $rec = $result->fetch_assoc();
         $lastid =$rec['emp_id'];
         $num = substr($lastid, 3);
         $num++;
         $newid="EMP".str_pad($num,5,"0",STR_PAD_LEFT);
     }
     $dbobj->close();
    return $newid;
 }
 
?>