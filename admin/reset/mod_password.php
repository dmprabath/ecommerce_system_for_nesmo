<?php 
require_once("../lib/config.php"); 
 if(isset($_GET["type"])){
    $type = $_GET["type"];
     $type();
}

function checkLogin(){
	$uname = $_POST['uname'];
	$upass = $_POST['upass'];
	$upass = md5($upass);
	$mail = $_POST['mail'];
		if($mail != md5($uname)){
			echo "0,Check again your email address";
		}else{

			$dbobj =DB::connect();
			$sql_check = "SELECT * FROM tbl_ulogin WHERE user_name ='$uname' AND user_pass='$upass' ";
			$result = $dbobj->query($sql_check);

			$norow = $result->num_rows;
			if($norow=="0"){
				echo "0,Your email or password is wrong";
			}else{
				echo "1,";
			}
			$dbobj->close();
		}

}


function changePass(){
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$pass = md5($pass);
	
	$dbobj = DB::connect();
	$sql_change = "UPDATE tbl_ulogin SET user_pass=? WHERE user_name=?";
	$stmt = $dbobj->prepare($sql_change);
	$stmt->bind_param("ss",$pass,$email);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}else{
		echo "1,";
	}
	$stmt->close();
	$dbobj->close();

}




?>