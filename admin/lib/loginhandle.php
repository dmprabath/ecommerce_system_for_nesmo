<?php
session_start(); //start session
	require_once("config.php");  // connect database
	if(!isset($_POST["txtuname"])){  // check user log or not
	    header("Location:index.php");
	}
 
$uname = $_POST["txtuname"]; // get typed email
$upass = $_POST["txtupass"]; // get typed password

$dbobj = DB::connect();
 //check user details using email
$sql = "SELECT emp_id,emp_fname,emp_img,user_type,user_pass FROM tbl_users LEFT OUTER JOIN tbl_ulogin ON tbl_users.emp_email=tbl_ulogin.user_name WHERE tbl_ulogin.user_name='$uname' AND tbl_users.emp_status='1' ";

$result = $dbobj->query($sql);
	if($dbobj->errno){
		echo("SQL Error : " .$dbobj->error);
		exit;
	}

$nor =$result->num_rows;
if($nor>0){
	$row = $result->fetch_assoc();
	$u_pass = md5($upass);
	if($u_pass==$row["user_pass"]){
		// store customer details to session
		$_SESSION["user"]["uid"] =$row["emp_id"];
		$_SESSION["user"]["image"]=$row["emp_img"];
        $_SESSION["user"]["uname"]=$row["emp_fname"];
        $_SESSION["user"]["utype"]=$row["user_type"];
        sleep(1);
		echo ("1"); //matched password with user in database
	}else{
		echo ("2"); // not matched password
	}
}else{
	echo("3"); // user not in the database
}
	
$dbobj->close();
 
 ?>