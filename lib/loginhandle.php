<?php
session_start();
	require_once("config.php");
	if(!isset($_POST["txtuname"])){
	    header("Location:../index.php");
	}
 
$uname = $_POST["txtuname"];
$upass = $_POST["txtupass"];

$dbobj = DB::connect();

$sql = "SELECT * FROM tbl_cuslogin JOIN tbl_customers ON tbl_cuslogin.cus_email = tbl_customers.cus_email WHERE tbl_cuslogin.cus_email='$uname';";

$result = $dbobj->query($sql);
	if($dbobj->errno){
		echo("SQL Error : " .$dbobj->error);
		exit;
	}

$nor =$result->num_rows;
if($nor>0){
	$row = $result->fetch_assoc();
	$u_pass = md5($upass);
	if($u_pass==$row["cus_pass"]){
        $_SESSION["customer"]["uid"]=$row["cus_id"];
        $_SESSION["customer"]["uname"]=$row["cus_fname"];

        sleep(1);
		echo ("1");
	}else{
		echo ("2"); 
	}
}else{
	echo("3");
}
	
$dbobj->close();
 
 ?>