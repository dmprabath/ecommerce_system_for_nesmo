<?php
//  function page for website
/*
01 getDistrict()  - to get details of district


 */
date_default_timezone_set("Asia/Colombo");

require("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();
}
function getInvId(){
    $dbobj = DB::connect();

    $cdate = date("Y-m-d",time());
    $sql = "SELECT count(inv_id) FROM tbl_invoice WHERE inv_date='$cdate';";

    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $row = $result->fetch_array();
    $count = $row[0];
    $count++;

    $newid = "INV".str_replace("-","",$cdate)."_".str_pad($count,4,"0",STR_PAD_LEFT);

    echo($newid);
    $dbobj->close();
}

function getPayId(){
    $dbobj = DB::connect();

    
    $sql = "SELECT count(pay_id) FROM tbl_payment;";

    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $row = $result->fetch_array();
    $count = $row[0];
    $count++;

    
    echo($count);
    $dbobj->close();
}
function getDestrict(){
    $dbobj = DB::connect();

    $sql = "SELECT districts FROM tbl_province order BY districts";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['districts']."'>".$row['districts']."</option>";
    }

    echo($output);
    $dbobj->close();
}

function getProvince(){

    $dbobj = DB::connect();

    $sql = "SELECT province FROM tbl_province GROUP BY province  ";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['province']."'>".$row['province']."</option>";
    }

    echo($output);
    $dbobj->close();

}


/*   ---------------- email send -----------------*/

function conSend(){
        $to = "newuser@localhost";
        $from ="postmaster@localhost";
        $sub = "Contact Details";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $msg = $_POST['message'];

        $message = "Name: ".$name."\n" ."Email: ".$email."\n"."Contact No: ".$phone."\n"."Massage :".$msg ;

        $headers = "From:".$from;
        mail($to,$sub,$message,$headers);
}
/*   ------------------ Shop page ---------------------*/

function getCategory(){
    $dbobj = DB::connect();

    $sql = "SELECT cat_id, cat_name FROM tbl_category";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
     $output .="<option value='0'>All Category</option>";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['cat_name']."'>".$row['cat_name']."</option>";
    }

    echo($output);
    $dbobj->close();
}

/*   ------------------ Get tank capacity ---------------------*/
function tankCapacity(){
    $dbobj = DB::connect();

    $sql = "SELECT * FROM `tbl_tank_cap`";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
     
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['cat_name']."'>".$row['cat_name']."</option>";
    }

    echo($output);
    $dbobj->close();
}

 function getProdInfo(){
    $cusid = $_POST["cusid"];
    $dbobj = DB::connect();
    $sql = "SELECT * FROM tbl_customers WHERE cus_id='$cusid';";

    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $rec = $result->fetch_assoc();
    echo(json_encode($rec));
    $dbobj->close();
}





/*   ------------ Feedback Page ------------- */
function getFeedback(){
    $prod_id = $_POST["prodid"];
    $dbobj = DB::connect();
    $sql = "SELECT cus_fname,cus_lname,prod_id,feed_msg,feed_star,feed_date FROM tbl_feedback fd JOIN tbl_customers cus ON fd.cus_id= cus.cus_id WHERE (fd.prod_id='$prod_id' AND fd.status='1') ORDER BY feed_date DESC";
    $result = $dbobj->query($sql);
    if ($dbobj->errno) {
        echo("SQL Error: " . $dbobj->error);
        exit;
    }
    $output = "";

    while ($rec = $result->fetch_assoc()) {
        $star = $rec['feed_star'];
        $output .="<div class='p-3 bg-light'>";
            $output .="<div class=''> <h5 class='text-info'>".$rec['cus_fname']." ".$rec['cus_lname']."</h5><p>".$rec['feed_date']."</p></div>";
            $output .="<div class=''>";
            if($star =="0"){
                $output .= "<img src='resources/img/products/star/1star.png' width='200px' />";
            }else if($star =="1"){
                $output .= "<img src='resources/img/products/star/1star.png' width='200px' />";
            }else if($star =="2"){
                $output .= "<img src='resources/img/products/star/2star.png' width='200px' />";
            }else if($star =="3"){
                $output .= "<img src='resources/img/products/star/3star.png' width='200px' />";
            }else if($star =="4"){
                $output .= "<img src='resources/img/products/star/4star.png' width='200px' />";
            }else {
                $output .= "<img src='resources/img/products/star/5star.png' width='200px' />";
            }
            $output .= "</div>";
        $output .= "<div class='col-lg-10'>";
        $output .= "<p>".$rec['feed_msg']."</p>";
        $output .= "</div>"; 

        $output .= "</div>";

    }
    echo($output);
    $dbobj->close();
}

function addFeedback(){
    $cus_id = $_POST['cus_id'];
    $prod_id = $_POST['prod_id'];
    $feed_msg = $_POST['feed_msg'];
    $feed_star = $_POST['feed_star'];
    $date = date("Y-m-d",time());

    $dbobj = DB::connect();
    $sql ="INSERT INTO tbl_feedback (cus_id,prod_id,feed_msg,feed_star,feed_date,status) value ('$cus_id','$prod_id','$feed_msg','$feed_star','$date','1')";

    $result = $dbobj->prepare($sql);
    if ($dbobj->errno) {
        echo("SQL Error: " . $dbobj->error);
        exit;
    };

    if(!$result->execute()){
        echo ("0,Something wrong please try again later");
    }else{
        echo("1,Thank You Successfully added");
    }
    $dbobj->close();
}







?>