<?php
require_once("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type(); 
}
/*   ------------------ Generate customer ID -------------------- */
function getCusId(){
    $dbobj = DB::connect();
    $sql = "SELECT cus_id FROM tbl_customers ORDER BY cus_id DESC LIMIT 1;"  ;
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error );
        exit;
    }
    $nor = $result->num_rows;

    if($nor == 0){
        $cusid = "CUS00001";
    }else{
        $rec = $result->fetch_assoc();
        $lastid =$rec["cus_id"];
        $num = substr($lastid,3);
        $num++;
        $cusid="CUS".str_pad($num,5,"0",STR_PAD_LEFT);
    }
    $dbobj->close();
    $cusid = str_replace(' ', '', $cusid);
    return $cusid;
}

function addNewCus(){
    $cus_id =$_POST['cus_id']; // get auto generated customer id from register form
    $fname =$_POST["fname"];    //get customer first name
    $lname =$_POST["lname"];    //get customer last name
    $cus_email=$_POST["email"]; // get customer email
    $gender=$_POST["gender"];   // ge customer gender
    $cus_dob=$_POST["bdate"];   //get customer email

    $cus_pass =$_POST["password"]; // get customer password
    $jdate = date("Y-m-d",time()); // get customer register date
    $cus_pass=md5($cus_pass);     // encrypt customer password using MD5 

 $dbobj =DB::connect();

    //check customer register or not
 $sql_check = "SELECT cus_id FROM tbl_customers WHERE cus_email='$cus_email'"; 
 $result  = $dbobj->query($sql_check);

  $row = $result->fetch_assoc();


  if($row==""){
    // if customer not registerd
      $sql = "INSERT INTO tbl_customers(`cus_id`,`cus_fname`,`cus_lname`,`cus_email`,`cus_gender`,`cus_dob`,`cus_jdate`,`cus_status`) VALUES ('$cus_id','$fname','$lname','$cus_email','$gender','$cus_dob','$jdate','1' );";

      $stmt =$dbobj->prepare($sql);
      if($dbobj->errno){
          echo("SQL Error : ".$dbobj->error );
          exit;
      }

      if(!$stmt->execute()){
          echo ("0,SQL Error ".$stmt->error);
          exit;

      }else{
        // create login privillages
          $sql2 = "INSERT INTO tbl_cuslogin (`cus_email`,`cus_pass`) VALUES ('$cus_email','$cus_pass')";
          $stmt2= $dbobj->prepare($sql2);
          $sql_address = "INSERT INTO tbl_cus_address (cus_id) VALUES ('$cus_id')";
          $stmt_address= $dbobj->prepare($sql_address);
          $stmt_address->execute();

          if($dbobj->errno){
              echo("SQL Error : ".$dbobj->error );
              exit;
          }
          if($stmt2->execute()){
              echo("1,You are registered successfully");
          }else{
              echo("2,This email already registered");
          }
          $stmt2->close();
      }

      $stmt->close();


  }else{
    // if customer already registerd
      echo("2,This Email Already Registered ");
  }

 $dbobj->close();

}

/*   ---------------- View Customer profile in myaccount -----------------*/

function viewCusProfile(){
    $cusid = $_POST["cusid"];
    $dbobj = DB::connect();
    $sql = "SELECT * FROM tbl_customers cus JOIN tbl_cus_address ca ON cus.cus_id= ca.cus_id WHERE cus.cus_id='$cusid';";

    $result = $dbobj->query($sql);
    $row = $result->num_rows;
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    if($row !="0"){
        $rec = $result->fetch_assoc();
    }else{
        $sql2 = "SELECT * FROM tbl_customers WHERE cus_id='$cusid';";
        $result2 = $dbobj->query($sql2);
        $rec = $result2->fetch_assoc();
    }

    echo(json_encode($rec));
    $dbobj->close();
}

/*   ---------------- Update Customer profile in myaccount -----------------*/

function updateCusProfile(){
  $cusid = $_POST['cus_id'];
  $cus_fname = $_POST['cus_fname'];
  $cus_lname = $_POST['cus_lname'];
  $cus_email = $_POST['cus_email'];
  $cus_mobile = $_POST['cus_mobile'];

  $add_line1 = $_POST['add_line1'];
  $add_line2 = $_POST['add_line2'];
  $cus_city = $_POST['cus_city'];
  $cus_district = $_POST['cus_district'];
  $cus_province = $_POST['cus_province'];

  $dbobj = DB::connect();
  $sql_cus = "UPDATE tbl_customers SET cus_fname = ?, cus_lname=?, cus_email=?,cus_mobile=? WHERE cus_id=?";
  $stmt = $dbobj->prepare($sql_cus);
  $stmt->bind_param("sssss",$cus_fname,$cus_lname,$cus_email,$cus_mobile,$cusid);
  if(!$stmt->execute()){
    echo("0,Not Updated");
  }else{
    $sql_add = "UPDATE tbl_cus_address SET line1=?, line2=?, city=?, district=?, province = ? WHERE cus_id =? ";
    $stmt_add = $dbobj->prepare($sql_add);
    $stmt_add->bind_param("ssssss", $add_line1,$add_line2,$cus_city,$cus_district,$cus_province,$cusid);
    if(!$stmt_add->execute()){
      echo("0,Not successfully Updated");
    }else{
      echo("1,successfully Updated");
    }
    
  }
  $stmt->close();
  $dbobj->close();

}

function sendContact(){

    $to = "newuser@localhost";
    $from ="postmaster@localhost";
    $sub = "Contact Details";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $msg = $_POST['message'];

    $message = "Name: ".$name."\n" ."Email: ".$email."\n"."Contact No: ".$phone."\n"."Massage :".$msg ;

    $headers = "From:".$from;
    if(mail($to,$sub,$message,$headers)){
        echo "1,Success send";
    }else{
        echo "0,Did not send";
    }


}


    /*---------------- Email Check Form start -----------------------*/

function checkEmail(){
  $txtemail = $_POST['txtemail']; // customer email
  $dbobj = DB::connect();
  //check its registerd or not
   $sql = "SELECT cus_id,cus_fname FROM tbl_customers WHERE cus_email='$txtemail'";
   $result = $dbobj->query($sql);

   if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }
  $rec = $result->fetch_assoc();
 

  $row = $result->num_rows;
  if($row != "0"){
    // this is registerd email
    $row =randomCode($dbobj,$txtemail,$rec); // pass database , customer email and other data to randomeCode function

  }else{
    //Not registerd email send error massage 
    $row = "0, Email is Not Registerd";
  }
  echo($row);
   $result->close();
  $dbobj->close();
   

}

    /*---------------- Generate Code and send Email -----------------------*/

function randomCode($dbobj,$txtemail,$rec){  
  $e_length = strlen($txtemail); // get email letter count
  $time = time(); // get current time
  $time =substr($time,-4); // get last seconds

  $e_length = $e_length+$time; // email length plus time 
  $code ="5";

  for($i=1 ; $i<$time; $i++){
    $tim = time(); // get current time
    $tim =substr($tim,-4); //get last numbers
    $code = $code+($e_length/$tim); // lenth devide by number
  }
  $code = substr($code,0,4);
  $code = str_replace(".",$i,$code); // replace time insted of dot 

  $cusid = $rec['cus_id'];  // cutomer id
  $cusname = $rec['cus_fname']; //customer first name
  $sql_pass ="UPDATE tbl_customers SET temp_pass ='$code' WHERE cus_id ='$cusid'";

  $stmt_pass=$dbobj->prepare($sql_pass);


  if(!$stmt_pass->execute()){
      return "0,Email Not sended";
    }else{
          /*---------------- Send Email -----------------------*/
          require '../resources/plugin/phpmailer/PHPMailerAutoload.php';
          $mail = new PHPMailer;

          $mail->isSMTP();                            // Set mailer to use SMTP
          $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                     // Enable SMTP authentication
          $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                          // TCP port to connect to

          $mail->setFrom('contactnesmo@gmail.com', 'Nesmo Contact');
          $mail->addReplyTo('contactnesmo@gmail.com', 'Nesmo Contact');
          $mail->addAddress($txtemail);  

          $mail->isHTML(true);  // Set email format to HTML

          $bodyContent ="<div style='border: 2px solid black; width: 600px ; padding: 8px '>
                        <h3 style='text-align:center '>Email Confirmation Code Form NESMO</h3>
                        <p>Hi ".$cusname.",</p>
                        <p>You have request a  New password,<br>
                        This is a your email confirmation code. Enter this code to request form.</p>

                        <p style='border : 1px solid red ; padding : 2px; width : 100px'>".$code."</p>
                        <p>* if you are not request a new password ignore this email</p>
                        <p style='border-top: 1px solid black'>NESMO International (pvt) Ltd ,<br> No. 103, Highlevel Road, Pannipitiya.<br>
                          contactnesmo@gmail.lk
                        </p>

          </div>"; 
          $mail->Subject = "Password Reset in nesmo.lk ";  // email header
          $mail->Body    = $bodyContent;

          if(!$mail->send()) {
             
              return '0,Not successfull try again ';
          } else {
              return '1,Email Sended Sucessfully';
          }
      
    }
    $stmt_pass->close();

}


function checkcode(){
 $cus_email = $_POST['code_email']; //customer email
 $txtcode = $_POST['txtcode'];    // temporary code
 $dbobj = DB::connect();
 $sql = "SELECT cus_id FROM tbl_customers WHERE cus_email='$cus_email' AND temp_pass ='$txtcode'";
 $result = $dbobj->query($sql);
 if($dbobj->errno){
         echo("SQL Error : ".$dbobj->error );
         exit;
}

 $row = $result->num_rows;
 echo($row);
 $dbobj->close();

}

function updatePass(){
 $cus_email = $_POST['pass_email']; // customer email
 $txtpass = $_POST['txtpass']; // get password 
 $txtpass = md5($txtpass);    // encrypt the password using MD5 assign to variable


 $dbobj = DB::connect();
 $sql = "UPDATE tbl_cuslogin SET cus_pass= ? WHERE cus_email=? ";
 $stmt = $dbobj->prepare($sql);
 $stmt->bind_param("ss",$txtpass,$cus_email);
  if(!$stmt->execute()){
    echo("0,SQL Error, Please try again:".$stmt->error);
  }else{
    $sql_temp = "UPDATE tbl_customers SET temp_pass='0' WHERE cus_email='$cus_email'";
    $result = $dbobj->prepare($sql_temp);
    if(!$result->execute()){
      echo("0,Password Not Changed ");
    }else{
      echo("1,Password Changed Succeessfully");
    }
  }
 
 $stmt->close();
 $dbobj->close();

}


function myOrderList(){
  $cusid = $_POST['cusid'];
  $dbobj = DB::connect();
  $sql = "SELECT ip.inv_id,inv.inv_date,pro.prod_id,pro.prod_modal,pro.cat_id,pro.prod_img,ip.prod_qty,ip.prod_sprice,ip.warr_expire FROM tbl_invoice inv JOIN tbl_inv_prod ip ON inv.inv_id = ip.inv_id JOIN tbl_products pro ON pro.prod_id = ip.prod_id WHERE inv.cus_id='$cusid' ORDER BY inv_date DESC ";
  $result= $dbobj->query($sql);
   if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }

  $output = "";
  $output = "";
  $i = "1";
  while($rec=$result->fetch_assoc()){
    $output .= "<div id='' class='card bg-light my-2'>";
    $output .= "<div class='col-lg-12 h-75 d-inline-block'>";
    $output .= "<div class='row'>";
    $output .= "  <div  class='col-lg-12 col-sm-12'>";
    $output .= "     <p>Order Date : ".$rec['inv_date']."<br> Order ID : ".$rec['inv_id']."</p>";
    $output .= "  </div>";
    $output .= "  <div  class='col-lg-6 col-sm-12'>";
    $output .= "  <img src='resources/img/products/".$rec['prod_img']."' class='w-50'>";
    $output .= "  </div>";
    $output .= "  <div  class='col-lg-6 col-sm-12'>";
    $output .= "  <h5 class='text-left'> Name : ".$rec['prod_modal']."</h5>";
    $output .= "  <p> Price : LKR.".$rec['prod_sprice']."<br>";
    $output .= "  Quantity : ".$rec['prod_qty']."<br>";
    $output .= "  Warrenty Period : ".$rec['warr_expire']."</p>";
    $output .= "  <div id='div'>";
    $output .= "  <input type='hidden' id='prod_id' name='prod_id' value='".$rec['prod_id']."'>  ";
    $output .= "  <button class='btn btn-sm btn-primary my-2' id='btn_add_review' name='".$rec['prod_id']."'>Add Reviews</button>";
    $cdate = date("Y-m-d");
    if($cdate <$rec['warr_expire']){
      $output .= "  <button class='btn btn-sm btn-warning my-2' id='btn_warrenty' name='".$rec['inv_id']."/".$rec['prod_id']."' >Warrenty Claim </button>";
    }
    
    $output .= "  </div>"; 
    $output .= "  </div>";
    $output .= "</div>";
    $output .= "</div>";
    $output .= "</div>";
  
  }
  if($output==""){
    echo ("<p>No Orders</p>");
  }else{
    echo($output);
  }
  
  $dbobj->close();

}

function requestWarrenty(){
  $cusid = $_POST['cus_id'];
  $invid = $_POST['prod_woiid'];
  $prodid = $_POST['prod_woid'];
  $problemm = $_POST['warr_problem'];
  $rdate = date("Y-m-d");
  $status ="0";

  //echo($cusid." ".$invid." ".$prodid." ".$problemm." ".$rdate);

  $dbobj = DB::connect();

  $wrrid = "SELECT warr_id FROM  tbl_warrenty ORDER BY warr_id DESC LIMIT 1";
  $resid = $dbobj->query($wrrid);
  $row = $resid->fetch_assoc();
  $newID = $row['warr_id'];
  $newID++;
  
  //echo($newID);
  $sql_warr = "INSERT INTO tbl_warrenty (warr_id,cus_id,inv_id,warr_date,status) VALUES ('$newID','$cusid','$invid','$rdate','$status')";
  $stmt_warr = $dbobj->prepare($sql_warr);
  if(!$stmt_warr->execute()){
     echo ("0,Please try again later ");
  }else{

    $sql_prod ="INSERT INTO tbl_warr_prod (warr_id,prod_id,warr_probleme) VALUES ('$newID','$prodid','$problemm')";
      $stmt_prod= $dbobj->prepare($sql_prod);
      if(!$stmt_prod->execute()){
        echo ("0,Please try again later ");
      }else{
        echo ("1,Sucessfully Sended");
      }
    //echo ("1,Sucessfully Sended");
      $stmt_prod->close();
  }
  $stmt_warr->close();
  $dbobj->close();
}

/* ---------------------------------------------------------------------*/
/*   ----------------- Warrenty list in account ---------------------*/



function cusWarrenty($cusid){
  $dbobj = DB::connect();
  $sql = "SELECT warr.*,pro.prod_name FROM tbl_warrenty warr JOIN tbl_warr_prod wp ON warr.warr_id= wp.warr_id JOIN tbl_products pro ON wp.prod_id= pro.prod_id WHERE cus_id='$cusid'";

  $result = $dbobj->query($sql);

  $output ="";

 while ($row = $result->fetch_assoc()) {
   $output .= "<tr><td>".$row['inv_id']."</td><td>".$row['warr_date']."</td><td>".$row['prod_name']."</td>";

   $status = $row['status'];


   switch ($status) {
     case '0':
         $output .= "<td > <P class='text-warning'>Pending..</p> </td>";
       break;
     
     case ' 1':
       $output .= "<td class='text-primary'> Accept.. </td>";
       break;
     
     case '2':
       $output .= "<td class='text-success'> Complete.. </td>";
       break;
     
     case '3':
       $output .= "<td class='text-danger'> Canceld.. </td>";
       break;
   }
   $output .="<td> <button class='btn btn-primary' name='".$row['warr_id']."' id='detButton'> Details</button> ";
   if($status !="3"){
    $output .="<button class='btn btn-danger' name='".$row['warr_id']."' id='cancelButton'> Cancel</button> ";
   }
   $output .="</td></tr>";
   
  } 
  echo($output);


}

/* ----------------------- View my warrenty ------------------ */
function viewMyWarrenty(){
  $warrid =$_POST['warrid'];

  $dbobj = DB::connect();

  $sql = "SELECT warr.*,wp.warr_probleme,wp.solution,pro.prod_name FROM tbl_warrenty warr JOIN tbl_warr_prod wp ON warr.warr_id= wp.warr_id JOIN tbl_products pro ON wp.prod_id= pro.prod_id WHERE warr.warr_id='$warrid'";

  $result = $dbobj->query($sql);
  $output = "";
  $row = $result->fetch_assoc();
   $output .= "<div class='form-group row'>
                        <label for='' class='col-lg-4 col-form-label'>Invoice No</label>
                        <div class='col-lg-5'><p>".$row['inv_id']."</p></div>                    

                    </div>";
   $output .= "<div class='form-group row'>
                        <label for='' class='col-lg-4 col-form-label'>Date</label>
                        <div class='col'><p>".$row['warr_date']."</p></div>                    

                    </div>";
   $output .= "<div class='form-group row'>
                  <label for='' class='col-lg-4 col-form-label'>Items Name</label>
                  <div class='col'><p>".$row['prod_name']."</p></div>                    

              </div>";
   $output .= "<div class='form-group row'>
                  <label for='' class='col-lg-4 col-form-label'>Probleme</label>
                  <div class='col'><p>".$row['warr_probleme']."</p></div>                    

              </div>";
   $output .= "<div class='form-group row'>
                  <label for='' class='col-lg-4 col-form-label'>Solution</label>
                  <div class='col'><p>".$row['solution']."</p></div>                    

              </div>";


                $st = $row['status'];

                if($st=="0"){
                    $output .= "<div class='form-group row'>
                  <label for='' class='col-lg-4 col-form-label'>Status</label>
                  <div class='col-lg-5'><p class='text-warning'>Pending</p></div>                    
                          </div>";
                }else if($st=="1"){
                  $output .= "<div class='form-group row'>
                  <label for='' class='col-lg-4 col-form-label'>Status</label>
                  <div class='col-lg-5'><p class='text-success'>Accept</p></div>                    
                          </div>";

                }else if($st=="3"){
                 
                  $output .= "<div class='form-group row'>
                  <label for='' class='col-lg-4 col-form-label'>Status</label>
                  <div class='col-lg-5'><p class='text-danger'>Canceled</p></div>                    
                          </div>";
                }
              

  echo ($output);

  $dbobj->close();

}


/* ----------------------- cancel my warrenty ------------------ */


function cancelMyWarrenty(){
  $warrid =$_POST['warrid'];

  $dbobj = DB::connect();

  $sql = "UPDATE tbl_warrenty SET status='3' WHERE warr_id='$warrid'";

  $result = $dbobj->prepare($sql);
  if(!$result->execute()){
    echo "0,Please try again later";
  }else{
    $sql_can = "UPDATE tbl_warr_prod SET solution='customer was caneled' WHERE warr_id='$warrid'";

  $result_can = $dbobj->prepare($sql_can);
  if(!$result_can->execute()){
      echo "0,Please try again later";
  }else{

    echo "1,Successfully removed";
  }
  }
  $dbobj->close();
  
  

}

function readNotification(){
  $id = $_POST['id'];
  $dbobj = DB::connect();
  $sql = "UPDATE tbl_notification SET not_status='1' WHERE not_id ='$id'";
  $dbobj->query($sql);

  if($dbobj->errno){
    echo("0");
  }else{
    echo("1");
  }
  $dbobj->close();
}


?>

