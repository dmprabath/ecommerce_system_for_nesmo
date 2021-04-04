<?php
require_once("config.php");


$msg_title = $_POST['msg-title']; 	// customer message
$cusmsg = $_POST['message']; 	// customer message
$cusname = $_POST['name'];		// customer name
$cusemail = $_POST['email'];	//customer Email
$cusphone = $_POST['phone'];	//customer contact No

require '../resources/plugin/phpmailer/PHPMailerAutoload.php';
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
$bodyContent =	"<div style='border:1px solid; width:600px; background-color:#F2F1F1 ;'>
				<div style='background-color:#3E9BEE; padding-top:20px; padding-bottom:20px;'>
					<p style='font-size:18px; font-weight: bold; text-align: center;'>Contact Message From nesmo From</p>
				</div>
				<p style='padding-left:10px;'>Customer Name : ".$cusname."<br>
				Customer Email : ".$cusemail."<br>
				Customer Phone : ".$cusphone."<br>
				
				</p>
				<p style='padding-left:10px;'>".$msg_title."</p>
				<p style='padding-left:10px;'>".$cusmsg."</p>

</div>";


$mail->Subject = "Contact Message From : ".$cusname;  // email header
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
	$cdate = date("Y-m-d");
	$ctime = date("H:m:s");
	$dbobj = DB::connect();
	$parent ="0";
	$status = "0";
	$sql_insert = "INSERT INTO tbl_messages (name,msg_email,msg_contact,msg_title, msg_message, msg_date,msg_time,parent_id,msg_status) VALUES (?,?,?,?,?,?,?,?,?)";
	$stmt = $dbobj->prepare($sql_insert);
	$stmt->bind_param("sssssssii",$cusname,$cusemail,$cusphone,$msg_title,$cusmsg,$cdate,$ctime,$parent,$status);

	if(!$stmt->execute()){
		echo '0,Message could not be sent.';
	}else{
		echo '1,Message Was Sent.';
	}
	$stmt->close();
	$dbobj->close();

    //echo 'Message has been sent';
}



?>