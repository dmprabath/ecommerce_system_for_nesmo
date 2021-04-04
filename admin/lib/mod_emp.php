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
    




 function getEmpId(){
     $dbobj = DB::connect();
     $sql = "SELECT emp_id FROM tbl_users ORDER BY emp_id DESC LIMIT 1;"  ;
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
         $lastid =$rec["emp_id"];
         $num = substr($lastid,3);
         $num++;
         $newid="EMP".str_pad($num,5,"0",STR_PAD_LEFT);
     }
     $dbobj->close();
     $newid = str_replace(' ', '', $newid);
    return $newid;
 }
 function viewEmployee(){

    $table =<<<EOT
	( SELECT * FROM tbl_users JOIN tbl_ulogin ON tbl_users.emp_email = tbl_ulogin.user_name JOIN tbl_role rol ON rol.role_id=tbl_ulogin.user_type ORDER BY tbl_users.emp_id ASC
		) temp
EOT;

    $primaryKey ='emp_id';

    $columns = array(
        array( 'db' => 'emp_img', 'dt'=> 0),
        array( 'db' => 'emp_id', 'dt'=> 1),
        array( 'db' => 'emp_fname', 'dt'=> 2),
        array( 'db' => 'emp_email', 'dt'=> 3),
        array( 'db' => 'role_name', 'dt'=> 4),
        array( 'db' => 'emp_status', 'dt'=> 5),

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

function getemp(){
     $emp_id = $_POST["empid"];
     $dbobj= DB::connect();
     $sql = "SELECT * FROM tbl_users WHERE emp_id='$emp_id' ;";
     
     $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $rec = $result->fetch_assoc();
    echo(json_encode($rec));
    $dbobj->close();

}
function chekEmail(){
     $email = $_POST["email"];
     $dbobj= DB::connect();
     $sql = "SELECT * FROM tbl_users WHERE emp_email='$email' ;";
     
     $result = $dbobj->query($sql);
     $rec = $result->num_rows;

     if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
     }
     if($rec=="0"){
        echo("0");
     }else{
        echo("1");
     }
    
    
    $dbobj->close();

}

function addNewEmp(){
    $emp_id = $_POST['txt_id'];
    $emp_fname = $_POST['txtfname'];
    $emp_lname = $_POST['txtlname'];
    $emp_email = $_POST['txt-email'];
    $connum   = $_POST['con_num'];
    $address = $_POST['address'];
    $bdate   = $_POST['bdate'];
    $nic      = $_POST['txt-nic'];
    $jdate    = $_POST['jdate'];
    $gender   = $_POST['gender'];
    $emp_role = $_POST['role'];
    $status = "1";

    $img_name = $_FILES['emp_file']['name'];
    $img_size = $_FILES['emp_file']['size'];
    $img_type = $_FILES['emp_file']['type'];
    $img_tmp_name = $_FILES['emp_file']['tmp_name'];
    #substr display part after specific point
    #strrpos - finds the position numbers of the last occurrence
    $ext = substr($img_name, strrpos($img_name, "."));
    # $ext is file extenstion
    # convert to lower case
    $txt = strtolower($ext);

    if($img_name== ""){
        echo (",Please Select the image");
        exit;
    }
    if($img_size>5242880|| $img_size==0){
        echo("0,Image size must be less than 5MB");
        exit;
    }
    if($ext!=".jpg" && $ext!=".png" && $ext!=".gif"){
        echo("0,Image file size should be either jpg png or gif");
        exit;
    }
    $cat_path = "../../resources/img/profile";
   
    if(!file_exists($cat_path)){
        mkdir($cat_path);
    }
    
     
     $fname = $emp_id."_".time().$ext;
     $fpath = $cat_path."/".$fname;

     if(move_uploaded_file($img_tmp_name, $fpath)){
        $dbobj = DB::connect();
       /* $sql = "INSERT INTO tbl_users(emp_id,emp_fname,emp_email,emp_role,emp_img) VALUES(?,?,?,?,?);";*/
       $sql ="INSERT INTO tbl_users (`emp_id`,`emp_fname`,`emp_lname`,`emp_email`,`emp_address`,`emp_mobile`,`emp_gender`,`emp_nic`,`emp_birth`,`emp_join`,`emp_img`,`emp_status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
        
        $stmt = $dbobj->prepare($sql);
        $stmt->bind_param("ssssssissssi",$emp_id,$emp_fname,$emp_lname,$emp_email,$address,$connum,$gender,$nic,$bdate,$jdate,$fname,$status);
        if(!$stmt->execute()){
            unlink($fpath);
            echo("0,SQL Error, Please try again:".$stmt->error);
        }else{
            $emp_pass = md5($nic);
            $sql2 ="INSERT INTO tbl_ulogin (user_name,user_pass,user_type) VALUES (?,?,?);";

            $stmt2 = $dbobj->prepare($sql2);
            $stmt2->bind_param("ssi",$emp_email,$emp_pass,$emp_role);
           if (!$stmt2->execute()){
               echo("0,SQL Error, Please try again:".$stmt2->error);
           }else{
               echo ("1,Successfully added a User");
           }
           $stmt2->close();
        }
        $stmt->close();
        $dbobj->close();
     }else{
        echo("0,Image Uploading Error");
     }

    

} 

function viewEmpProfile(){
    
    $empid = $_POST["empid"];
    $dbobj = DB::connect();

    $sql = "SELECT * FROM tbl_users WHERE emp_id='$empid';";

    $result= $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    
    $rec = $result->fetch_assoc();
    echo(json_encode($rec));
    $dbobj->close();


}

function updateEmployee(){
    $emp_id = $_POST['emp_id'];
    $emp_fname = $_POST['fname'];
    $emp_lname = $_POST['lname'];
    $emp_email = $_POST['emp_email'];
    $emp_address = $_POST['emp_address'];
    $emp_mobile = $_POST['emp_mobile'];
    $emp_gender = $_POST['emp_gender'];
    $emp_nic = $_POST['emp_nic'];
    $bdate = $_POST['bdate'];
    $img_name = 1;
    if(!file_exists($_FILES['emp_img']['tmp_name'])) {
        $dbobj = DB::connect();

        $sql ="UPDATE tbl_users SET emp_fname='$emp_fname',emp_lname='$emp_lname',emp_address='$emp_address',
 emp_mobile='$emp_mobile',emp_gender='$emp_gender',emp_nic='$emp_nic',emp_birth='$bdate'  WHERE emp_id='$emp_id';";

        $stmt = $dbobj->prepare($sql);

        if(!$stmt->execute()){

            echo("0,SQL Error, Please try again:".$stmt->error);
        }else{
            
                echo ("1,User Updated successfully");
            

        }
    } else {
        $img_name = $_FILES['emp_img']['name'];
        $img_size = $_FILES['emp_img']['size'];
        $img_type = $_FILES['emp_img']['type'];
        $img_tmp_name = $_FILES['emp_img']['tmp_name'];
        $ext = substr($img_name, strrpos($img_name, "."));
        if($img_name== ""){
            echo (",Please Select the image");
            exit;
        }
        if($img_size>2097152 || $img_size==0){
            echo("0,Image size must be less than 2MB");
            exit;
        }
        if($ext!=".jpg" && $ext!=".png" && $ext!=".gif"){
            echo("0,Image file size should be either jpg png or gif");
            exit;
        }
        $img_path = "../../resources/img/profile";

        if(!file_exists($img_path)){
            mkdir($img_path);
        }

        $emp_img = $emp_id."_".time().$ext;
        $file_path = $img_path."/".$emp_img;


        if(move_uploaded_file($img_tmp_name, $file_path)){

            $dbobj = DB::connect();
            $sql ="UPDATE tbl_users SET emp_fname='$emp_fname',emp_lname='$emp_lname',emp_address='$emp_address',
 emp_mobile='$emp_mobile',emp_gender='$emp_gender',emp_nic='$emp_nic',emp_birth='$bdate',emp_img='$emp_img'  WHERE emp_id='$emp_id';";
            $stmt = $dbobj->prepare($sql);

            if(!$stmt->execute()){
                unlink($img_path);
                echo("0,SQL Error, Please try again:".$stmt->error);
            }else{
                echo ("1,User Updated successfully");
               
            }
            

        }
    }

    $stmt->close();
    $dbobj->close();
}
function changeStatus(){
     $eid = $_POST['eid'];

     $dbobj = DB::connect();
     $sql = "UPDATE tbl_users SET emp_status =(CASE WHEN emp_status=1 THEN 0 WHEN emp_status=0 THEN 1 END) WHERE emp_id = '$eid';";
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


function resetPassword(){
     $eid = $_POST['eid'];
     $email = $_POST['email'];
     $name = $_POST['name'];
     $pwd = md5($eid);
     $reset = 1;

     $dbobj = DB::connect();
     $sql = "UPDATE tbl_ulogin SET pwd_reset='$reset', user_pass ='$pwd'  WHERE user_name ='$email' ";
     $stmt = $dbobj->prepare($sql);

     if(!$stmt->execute()){
         echo("0,SQL Error : ".$stmt->error);
     }
     else{
        require_once('../../resources/plugin/phpmailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;

        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                          // TCP port to connect to

        $mail->setFrom('contactnesmo@gmail.com', 'Nesmo Contact');
        $mail->addReplyTo('contactnesmo@gmail.com', 'Nesmo Contact');
        $mail->addAddress($email, 'Password Reset'); 

        $mail->isHTML(true);  // Set email format to HTML
        $email= md5($email);
        $link = "http://localhost/nesmo/admin/reset/reset.php?u=$email&e=$pwd"; //password reset link

        $bodyContent = "<div style='width:600px; background-color: #E8E8E7;'>
                            <div style=' background-color: #FD0404; padding:2px'>
                                <p style='font-size:22px'>Password Request</p>
                            </div>
                            <div style='padding-left: 40px; padding-bottom:20px'>
                                <p style='font-size:16px'>Password Request Message</p>
                                <p>HI $name ,</p>
                                <p>We received an account Password request </p>
                                <p><a href='$link' target='_blank'>Reset Password using This Linnk</a> </p>
                                <p>User name : Your email <br>
                                password : Employee ID</p>
                                <p>* If not request please contact admin immidiatly.</p>
                                <p>Administration Team,<br> NESMO International.</p>
                            </div>
                        </div>";

        $mail->Subject = "Reset Password In NESMO ";  // email header
        $mail->Body    = $bodyContent;

        
         if($mail->send()){
             echo("1,Successfully Updated!");
         }else{
             echo ('0,Message could not be sent.');
         }
         


     }
     $stmt->close();
     $dbobj->close();
}
function getUserRole(){
     $dbobj = DB::connect();
     $sql= "SELECT * FROM tbl_role";

     $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $output ="";
    while ($rec= $result->fetch_assoc()){
        $output .= "<option value='".$rec['rol_id']."'>".$rec['role_name']."</option>";
    }
    echo ($output);
    $dbobj->close();


}

function changeRole(){

    $email = $_POST['email'];
    $role = $_POST['user_role'];



    $dbobj = DB::connect();
    $sql = "UPDATE tbl_ulogin SET user_type ='$role' WHERE user_name = '$email';";
    $stmt = $dbobj->prepare($sql);

    if(!$stmt->execute()){
        echo("0,SQL Error : ".$stmt->error);
    }
    else{
        sleep(1);
        echo("1,Successfully Changed!");
    }
    $stmt->close();
    $dbobj->close();
}
function changeEmail(){
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $emp_email = $_POST['emp_email'];
    $old_email = $_POST['old_email'];

    $dbobj = DB::connect();
    $sql_email ="UPDATE tbl_users SET emp_email='$emp_email' WHERE emp_id ='$emp_id'";
    $stmt_email =$dbobj->prepare($sql_email);

    if(!$stmt_email->execute()){
        echo("0,SQL Error : ".$stmt_email->error);
    }
    else{
        $sql = "UPDATE tbl_ulogin SET user_name ='$emp_email' WHERE user_name = '$old_email';";
        $stmt = $dbobj->prepare($sql);

        if(!$stmt->execute()){
            echo("0,SQL Error : ".$stmt->error);
        }
        else{
            sleep(1);
            echo("1,Email has been changed!");
        }
        $stmt->close();
    }
    $stmt_email->close();

    $dbobj->close();
}
?>