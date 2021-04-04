<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location:index.php");
}else{


$type=$_SESSION["user"]["utype"];
$name=$_SESSION["user"]["uname"];
    header("location:../home.php");
}
/*switch($type){
    case "1" ;


        break;
    case "2";
        header("location:../index.php");
}*/
?>
 <h2>fdfdf</h2>
 <button id="click">Click Me</button>
 <?php

 ?>
