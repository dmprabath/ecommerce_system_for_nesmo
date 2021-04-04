<?php
require_once('../../../resources/plugin/phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;

if(isset($_GET['type'])){
	$type = $_GET['type'];
	$type();
}


function passSend(){
	$cusmsg = $_POST['message'];
	$cusname = $_POST['name'];
	$cusemail = $_POST['email'];
	$cusphone = $_POST['phone'];
	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = 'contactnesmo@gmail.com';          // SMTP username
	$mail->Password = 'nesmo1234'; // SMTP password
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                          // TCP port to connect to

	$mail->setFrom('contactnesmo@gmail.com', 'Nesmo Contact');
	$mail->addReplyTo('contactnesmo@gmail.com', 'CodexWorld');
	$mail->addAddress('contactnesmo@gmail.com');   // Add a recipient
	$mail->addCC($cusemail);
	$mail->addBCC('contactnesmo@gmail.com');

	$mail->isHTML(true);  // Set email format to HTML

	$bodyContent = '<h3>This is Message From Contact Form in Nesmo.lk</h3>'; // email Message Content
	$bodyContent .= '<p>Cus Name : '.$cusname.'<br>';
	$bodyContent .= 'Cus Email : '.$cusemail.'<br>';
	$bodyContent .= 'Cus Phone : '.$cusphone.'</p>';

	$mail->Subject = "Message From : ".$cusname;  // email header
	$mail->Body    = $bodyContent;

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';
	}

}



?>