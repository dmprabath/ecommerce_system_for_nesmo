<?php

require_once("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();

} 
function allMessage(){

    $table = <<<EOT
	( SELECT * FROM tbl_messages WHERE parent_id ='0' 
		) temp
EOT;

    $primaryKey ='msg_id';
    $columns = array(    
        array( 'db' => 'msg_date', 'dt'=> 0),
        array( 'db' => 'name', 'dt'=> 1),        
        array( 'db' => 'msg_title', 'dt'=> 2),
        array( 'db' => 'msg_email', 'dt'=> 3),
        array( 'db' => 'msg_status', 'dt'=> 4),
        array( 'db' => 'msg_id', 'dt'=> 5),

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
        SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null)
    );
}



function viewMessage(){
    $msg_id = $_POST['msgid'];

    $dbobj = DB::connect();

    $sql = "SELECT * FROM tbl_messages WHERE msg_id='$msg_id'";

    $result = $dbobj->query($sql);
    $rec = $result->fetch_assoc();

    $output ="";
    $output .="<div class='modal-header'>
                    <h5>View Message</h5>
                </div>";
    $output .="<div class=' px-4'>
                        <p for='' class='col-lg-8'>Date :".$rec['msg_date']." ".$rec['msg_time']."</br>";
    $output .="Name : ".$rec['name']." </br> ";
    $output .="Email : ".$rec['msg_email']." </br> ";
    $output .="Phone : ".$rec['msg_contact']."  ";
    $output .="</p>";

    $output .="<p class='text-center'> ".$rec['msg_title']." </p> ";
    $output .="<p class='text-justify'> ".$rec['msg_message']." </p> ";

     $output .="</div>";
    echo $output;

    $dbobj->close();   
    
}

function viewReply(){
    $msg_id = $_POST['msgid'];

    $dbobj = DB::connect();

    $sql = "SELECT * FROM tbl_messages WHERE parent_id='$msg_id'";

    $result = $dbobj->query($sql);
    $rec = $result->fetch_assoc();

    $output ="";
    $output .="<div class='modal-header'>
                    <h5>View Message</h5>
                </div>";
    $output .="<div class=' px-4'>
                        <p for='' class='col-lg-8'>Date :".$rec['msg_date']." ".$rec['msg_time']."</br>";
    $output .="Name : ".$rec['name']." </br> ";
    $output .="Email : ".$rec['msg_email']." </br> ";
    $output .="Phone : ".$rec['msg_contact']."  ";
    $output .="</p>";

    $output .="<p class='text-center'> ".$rec['msg_title']." </p> ";
    $output .="<p class='text-justify'> ".$rec['msg_message']." </p> ";

     $output .="</div>";
    echo $output;

    $dbobj->close();   
    
}


function sendReply(){
    $parent =$_POST['id'];
    $name =$_POST['send_name'];
    $email =$_POST['send_mail'];
    $title =$_POST['send_title'];
    $message =$_POST['send_msg'];
    $date = date("Y-m-d");
    $time= date("H:i:s");
    $status = 1;

    
    $dbobj = DB::connect();
    $sql = "INSERT INTO tbl_messages (name,msg_email,msg_title,msg_message, msg_date, msg_time, parent_id,msg_status ) VALUES (?,?,?,?,?,?,?,? ) ";

    $stmt = $dbobj->prepare($sql);
    $stmt -> bind_param("ssssssii",$name,$email,$title,$message,$date,$time,$parent,$status);

    if(!$stmt->execute()){
        echo("0,Message Not Send");
    }else{
        $sql_update ="UPDATE tbl_messages SET msg_status ='$status' WHERE msg_id='$parent'";
        $stmt_update = $dbobj->prepare($sql_update);
        if(!$stmt_update->execute()){
            echo("0,Message Not Send");
        }else{
            echo("1,Message sended Successfully");
            mailsend($name,$email,$title,$message,$date,$time);
        }
        

        $stmt_update->close();
    }
    $stmt->close();
    $dbobj->close();
}

function mailsend($name,$email,$title,$message,$date,$time){

    require '../../resources/plugin/phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;

    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                     // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                          // TCP port to connect to

    $mail->setFrom('contactnesmo@gmail.com', 'Nesmo Contact'); //email sender
    $mail->addReplyTo('contactnesmo@gmail.com', 'Nesmo'); // reply email
    $mail->addAddress('contactnesmo@gmail.com');   // Add a recipient
    //$mail->addCC($cusemail);
    //$mail->addBCC('contactnesmo@gmail.com');

    $mail->isHTML(true);  // Set email format to HTML
    $bodyContent =  "<div style='border:1px solid; width:600px; background-color:#F2F1F1 ;'>
                    <div style='background-color:#3E9BEE; padding-top:20px; padding-bottom:20px;'>
                        <p style='font-size:18px; font-weight: bold; text-align: center;'>
                        ".$title." 
                        </p>
                    </div>
                    <p style='padding-left:10px;'> HI  ".$name." ,<br>
                    We have recived Your Email<br>
                    <br>
                    
                    </p>
                    <p style='padding-left:10px;'>".$message."</p>

                    <p style='padding-left:10px;'>This email From nesmo international(pvt)ltd </br>
                        Sales Team,<br>
                        Nesmo International (pvt)ltd,<br>
                        103, <br>
                        Highlevel Road,<br>
                        Pannipitiya.<br>
                        070 366 5500<br>
                        info@nesmo.lk<br>
                    </p>

    </div>";


    $mail->Subject = $title;  // email header
    $mail->Body    = $bodyContent;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }else{
        return;
    }
}


?>