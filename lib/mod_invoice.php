<?php 
require("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();
}
function getProduct(){
	$prod_id =$_POST['prod_id'];

	$dbobj = DB::connect();
	$sql_product =  "SELECT * FROM tbl_products pro JOIN tbl_prod_desc des ON des.desc_id = pro.prod_id INNER JOIN tbl_batch bat ON bat.bat_id =( SELECT b.bat_id FROM tbl_batch b WHERE pro.prod_id = b.prod_id AND b.bat_status='1' ORDER BY b.bat_id ASC LIMIT 1) JOIN tbl_category cat ON cat.cat_id= pro.cat_id JOIN tbl_prod_warr warr ON des.warr_id= warr.id WHERE pro.prod_id='$prod_id'";
	$result_details = $dbobj->query($sql_product);
    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $rec_details = $result_details->fetch_assoc();
    echo(json_encode($rec_details));
    $dbobj->close();
}

function getCustomerDetails(){
    $cusid =$_POST['cusid'];

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


function addNewInv(){  

    $cus_id = $_POST['cus_id']; //customer id
    $inv_id = $_POST['inv_id']; //invoice id
    $pay_id = $_POST['pay_id']; //payment id 
    $prod_id = $_POST['prod_id'];
    $bat_id = $_POST['bat_id'];
    $prod_cprice = $_POST['prod_cprice']; //product cost price
    $prod_price = $_POST['prod_price']; //product Sell price
    $ord_qty = $_POST['ord_qty']; //total  order quantity
    $total_price = $_POST['total_price']; //total  order price
    $paid_amount = $_POST['amount']; //total  order price


    $inv_discount = "0.00";     // discount

    $inv_date = date("Y-m-d");  
    $inv_time = date("H:m:s");

    $nodays= $_POST['warr'];    //warrenty
    $nodays = $nodays." days";
    $warrenty =date("Y-m-d", strtotime($inv_date. $nodays)); //warrenty expire date  
   
    $inv_type = "online";
    $status ="1";



    $dbobj= DB::connect();
    //Invoice created
    $sql_inv = "INSERT INTO tbl_invoice (inv_id,cus_id,inv_date,inv_qty,inv_discount,inv_total,inv_paid,pay_id,inv_type,inv_status) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt_inv =$dbobj->prepare($sql_inv);
    $stmt_inv->bind_param("sssidddisi",$inv_id,$cus_id,$inv_date,$ord_qty,$inv_discount,$total_price,$paid_amount,$pay_id,$inv_type,$status);
    if(!$stmt_inv->execute()){
        echo ("0,SQL Error ".$stmt_inv->error);
    }else{
        // Invoice table created
        $sql_prod = "INSERT INTO tbl_inv_prod (inv_id,prod_id,prod_cprice,prod_qty,prod_sprice,warr_expire) VALUES (?,?,?,?,?,?)";
        $stmt_prod =$dbobj->prepare($sql_prod);
        $stmt_prod->bind_param("ssdids",$inv_id,$prod_id,$prod_cprice,$ord_qty,$prod_price,$warrenty);
        if(!$stmt_prod->execute()){
            echo ("0,SQL Error ".$stmt_prod->error);
        }else{
            $res = updateStock($dbobj,$bat_id,$prod_id,$ord_qty);
            if ($res=="0"){
                echo("0,Error on Batch update");
                exit;
            }else{
               
                $sql_pay = "INSERT INTO tbl_payment (pay_id,inv_id,pay_amount,pay_date,pay_time,pay_type) VALUES (?,?,?,?,?,?)";
                $stmt_pay = $dbobj->prepare($sql_pay);
                $stmt_pay->bind_param("isdsss",$pay_id,$inv_id,$paid_amount,$inv_date,$inv_time,$inv_type);
                     if(!$stmt_pay->execute()){
                        echo ("0,SQL Error ".$stmt_pay->error);
                    }else{
                       echo("1,Invoice created");
                        sendInvoicEmail($cus_id,$inv_id,$inv_date,$total_price,$paid_amount);
                        sendNotification($cus_id,$Inv_id);
                    }
            }
        }
        


    }

    $stmt_pay->close();
    $dbobj->close();  

} 


/*----------------------Update Stock with invoice  --------------------------   */

function updateStock($dbobj,$bat_id,$prod_id,$ord_qty){
    $sql_batch = "UPDATE tbl_batch SET bat_rem=bat_rem-$ord_qty WHERE bat_id='$bat_id';";
    $dbobj->query($sql_batch);
    if($dbobj->errno){
        return "0";
    }
    else{
        $sql_status = "UPDATE tbl_batch SET bat_status=0 WHERE bat_id='$bat_id' AND bat_rem=0;";
        $dbobj->query($sql_status);

        $sql_prod = "UPDATE tbl_products SET prod_qty=prod_qty-$ord_qty WHERE prod_id='$prod_id';";
        $dbobj->query($sql_prod);
        if($dbobj->errno)
            return "0";
        else
            return "1";
    }

}

/*----------------------add customer details  --------------------------   */

function add_cart(){
    $cus_id = $_POST['cus_id'];
    $cus_fname = $_POST['cus_fname'];
    $cus_lname = $_POST['cus_lname'];
    $cus_email = $_POST['cus_email'];
    $cus_number = $_POST['cus_number'];
    $add_line1 = $_POST['add_line1'];
    $add_line2 = $_POST['add_line2'];
    $cus_city = $_POST['cus_city'];
    $cus_district = $_POST['cus_district'];
    $cus_province = $_POST['cus_province'];


    $dbobj = DB::connect();
    $sql = "UPDATE tbl_customers SET cus_fname='$cus_fname',cus_lname='$cus_lname',cus_email='$cus_email', cus_mobile='$cus_number' WHERE cus_id='$cus_id'";

    $result = $dbobj->prepare($sql);
    if($result->execute()){
        $sql_check ="SELECT cus_id FROM tbl_cus_address WHERE cus_id='$cus_id' ";
        $result_check = $dbobj->query($sql_check);
        $row = $result_check->num_rows;
        if($row=="0"){
            $sql_add ="INSERT INTO tbl_cus_address (cus_id, line1, line2, city, district, province) VALUES ('$cus_id','$add_line1','$add_line2','$cus_city','$cus_district','$cus_province')";
            $result_add = $dbobj->prepare($sql_add);
            if($result_add->execute()){
                echo ("1,address addedd");
            }else{
                echo ("0,Not success added");
            }
        }else{
            $sql_update ="UPDATE tbl_cus_address ca SET ca.line1='$add_line1', ca.line2='$add_line2', ca.city='$cus_city', ca.district='$cus_district', ca.province='$cus_province' WHERE ca.cus_id='$cus_id'";
            $result_update = $dbobj->prepare($sql_update);
            if($result_update->execute()){
                echo ("1,address updated");
            }else{
                echo ("0,Not success ");
            }
        }


    }else{
        echo ("0,Somthing Missing");
    }

}

function sendInvoicEmail($cus_id,$inv_id,$inv_date,$total_price,$paid_amount){
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


    $dbobj = DB::connect();
    $sql_customer = "SELECT * FROM tbl_customers WHERE cus_id='$cus_id'";
    $cus = $dbobj->query($sql_customer);
    $cusdetail = $cus->fetch_assoc();

    $bodyContent =  '';
    $bodyContent .=  "<div style='border: 1px solid black; width:800px; padding:5px'>
                            <p style='font-size:24px; text-align:center; font-weight:bold; '><u>INVOICE</u></p>
                            <p style='font-size:16px; '>Invoice ID : ".$inv_id."<br>
                                Invoice Date : ".$inv_date."<br>
                                Customer Name : ".$cusdetail['cus_fname']."<br>
                                Customer Email : ".$cusdetail['cus_email']."<br>
                             </p>
                             <table width='95%' align='center' style='border:1px solid black'>
                                <thead>
                                    <tr style='border:1px solid black '>
                                        <th width='5%'>No </th>
                                        <th width='20%'>Product Name </th>
                                        <th width='20%'>Warrenty Period </th>
                                        <th width='20%'>Unit Price (Rs)</th>
                                        <th width='10%'>Qty </th>
                                        <th width='25%'>Total(Rs)</th>
                                    </tr>
                                </thead>
                                <tbody>";
             $sql_Invoice = "SELECT pro.prod_name,warr.warrenty,invp.prod_sprice,invp.prod_qty, invp.prod_qty*invp.prod_sprice AS total FROM  tbl_inv_prod invp JOIN tbl_products pro ON pro.prod_id = invp.prod_id JOIN tbl_prod_desc des ON pro.prod_id=des.desc_id JOIN tbl_prod_warr warr ON des.warr_id = warr.id WHERE invp.inv_id='$inv_id'";
            $invoice = $dbobj->query($sql_Invoice);
            $i=1;
                while($inv=$invoice->fetch_assoc()){
                    
     $bodyContent .= "<tr>
                        <td width='5%' style='text-align: center;  '>".$i."</td>
                        <td width='20%' style='text-align: left;  '>".$inv['prod_name']."</td>
                        <td width='20%' style='text-align: left;  '>".$inv['warrenty']."</td>
                        <td width='20%' style='text-align: right;  '>".$inv['prod_sprice']."</td>
                        <td width='10%' style='text-align: center;  '>".$inv['prod_qty']."</td>
                        <td width='25%' style='text-align: right;  '>".$inv['total']."</td>
                    </tr>"; 
                    $i++;               
                }                   



     $bodyContent .=   "<tr><td width='10%' colspan='4'></td>
                        <td width='25%' style='text-align: left;  '> Total </td>
                        <td width='25%' style='text-align: right;  '>". $total_price."</td></tr>";

     $bodyContent .=   "<tr><td width='10%' colspan='4'></td>
                        <td width='25%' style='text-align: left;  '> Paid  </td> 
                        <td width='25%' style='text-align: right;  '>". $paid_amount."</td></tr>";
                        $rem = $total_price -  $paid_amount;

     $bodyContent .=   "<tr><td width='10%' colspan='4'></td>
                        <td width='25%' style='text-align: left;  '> Remainig  </td>
                        <td width='25%' style='text-align: right;  '>". $rem.".00</td></tr>";


     $bodyContent .=            "</tbody>
                             </table>

                             <p style='padding-left:50px'>Nesmo International Pvt ltd <br>
                             No.103,<br>
                            Highlevel Road,<br>
                            Pannipitiya,<br>
                            Srilanka.<br>

                            info@nesmo.lk<br>
                            070 366 5500<br>
                            www.nesmo.lk<br>
                             </p>
                             <p style='padding-left:50px'>* This is a auto generated invoice</p>


                      </div>";


    $mail->Subject = "Nesmo Order Invoice ";  // email header
    $mail->Body    = $bodyContent;
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }else{

    }
    $dbobj->close();
}

function sendNotification($cus_id,$Inv_id){
    $dbobj = DB::connect();
    $title = "Order Success";
    $message = "Your order ".$Inv_id." has been paid successfully. needs several days to process your order Thank You";
    $date = date("Y-m-d");
    $time = date("H:m:s");
    $status = "0"; 

    $getnotId = "SELECT * FROM tbl_notification";
    $getid = $dbobj->query($getnotId);
    $count = $getid->num_rows;
    $count++;


    $sqlnewnotification = "INSERT INTO tbl_notification (not_id,not_title,not_msg,not_date,not_time,not_status) VALUES('$count','$title','$message','$date','$time','$status')";
    $stmt = $dbobj->prepare($sqlnewnotification);
    if(!$stmt->execute()){
        return 0;
    }else{
        $sql_usernot ="INSERT INTO tbl_cus_notification (cus_id,notif_id) VALUES ('$cus_id','$count')";
        $stmt2 = $dbobj->prepare($sql_usernot);
        if(!$stmt2->execute()){
            return 0;
        }else{
            return 1;
        }
        $stmt2->close();
    }
    $stmt->close();
    $dbobj->close();
}

?>