<?php
require_once("config.php");
date_default_timezone_set("Asia/Colombo");

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

    
    return $count;
    $dbobj->close();
}

/*----------------------check customer  --------------------------   */

function checkCustomer(){
    $email = $_POST['email'];
    $dbobj = DB::connect();
    $sql = "SELECT cus.cus_id,cus.cus_fname,cus.cus_mobile FROM tbl_customers cus WHERE cus.cus_email='$email';";
    $result =  $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $row = $result->fetch_assoc();
    if($row==""){
        echo ("1");
    }else{
        echo (json_encode($row));
    }
    $dbobj->close();
}


function viewInvoice(){
    $table = <<<EOT
    ( SELECT inv.*, cus.cus_fname FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id= cus.cus_id ORDER BY inv_date ASC
        ) temp
EOT;

    $primary_key ="inv_id" ;

    $columns = array(
        array( 'db' => 'inv_id', 'dt' => 0 ),
        array( 'db' => 'cus_fname',  'dt' => 1 ),
        array( 'db' => 'inv_date',  'dt' => 2 ),
        array( 'db' => 'inv_qty',   'dt' => 3 ),
        array( 'db' => 'inv_total',   'dt' => 4 ),
        array( 'db' => 'inv_paid',   'dt' => 5 ),
        array( 'db' => 'inv_type',   'dt' => 6 )
    );
    require_once("config.php");
    $host = Config::$host;
    $user = Config::$db_uname;
    $pass = Config::$db_upass;
    $db = Config::$db_name;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
        SSP::complex($_POST, $sql_details, $table, $primary_key, $columns)
    );
}


function viewInvDetails(){
   $inv_id = $_GET['inv_id'];

    $table = <<<EOT
    (SELECT inv.*,pro.prod_modal FROM tbl_inv_prod inv JOIN tbl_products pro ON inv.prod_id=pro.prod_id WHERE inv.inv_id="$inv_id"
    )temp

EOT;

    $primaryKey ='inv_id';

    $columns = array(
        array( 'db' => 'prod_id', 'dt'=> 0),
        array( 'db' => 'prod_modal', 'dt'=> 1),
        array( 'db' => 'prod_cprice', 'dt'=> 2),
        array( 'db' => 'prod_qty', 'dt'=> 3),
        array( 'db' => 'prod_sprice', 'dt'=> 4)

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

function viewConfirmdInvoice(){
    $table = <<<EOT
    ( SELECT inv.*, cus.cus_fname, cus.cus_mobile FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id= cus.cus_id WHERE inv_status='2' OR inv_status ='3'
        ) temp
EOT;

    $primary_key ="inv_id" ;

    $columns = array(
        array( 'db' => 'inv_date', 'dt' => 0 ),
        array( 'db' => 'inv_id',  'dt' => 1 ),
        array( 'db' => 'cus_fname',  'dt' => 2 ),
        array( 'db' => 'cus_mobile',   'dt' => 3 ),
        array( 'db' => 'inv_qty',   'dt' => 4 ),
        array( 'db' => 'inv_type',   'dt' => 5 ),
        array( 'db' => 'inv_status',   'dt' => 6 )
    );
    require_once("config.php");
    $host = Config::$host;
    $user = Config::$db_uname;
    $pass = Config::$db_upass;
    $db = Config::$db_name;

    $sql_details = array(
        'user' => $user, 
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
        SSP::complex($_POST, $sql_details, $table, $primary_key, $columns)
    );
}

/*----------------------To get New Orders  --------------------------   */

function viewNotconfirmInvoice(){


    $table = <<<EOT
    (SELECT inv.*,cus.cus_fname,cus.cus_mobile FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id= cus.cus_id WHERE inv_status ='1' ORDER BY inv_status AND inv_date 
    )temp

EOT;

    $primaryKey ='inv_id';

    $columns = array(
        array( 'db' => 'inv_date', 'dt'=> 0),
        array( 'db' => 'inv_id', 'dt'=> 1),
        array( 'db' => 'cus_fname', 'dt'=> 2),
        array( 'db' => 'cus_mobile', 'dt'=> 3),
        array( 'db' => 'inv_qty', 'dt'=> 4),
        array( 'db' => 'inv_type', 'dt'=> 5),
        array( 'db' => 'inv_status', 'dt'=> 6)

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

/*----------------------Confirmed New orders  --------------------------   */

function orderConfirmation(){
    $dbobj = DB::connect();
    $inv_id = $_POST['invid'];     
    
    $sql  = "UPDATE tbl_invoice SET inv_status ='2' WHERE inv_id='$inv_id'";
    $dbobj->query($sql);

    if($dbobj->errno){
        echo("0,Not success try again");
    }else{
        $title = "Order Confirm";
        $message = "".$inv_id." This order has Confirmed, we are preparing your order";
        sendNotification($inv_id,$title,$message);
        echo("1,Succcess");
    }
    $dbobj->close();

}

/*----------------------Deliverd New orders  --------------------------   */

function orderDeliverd(){
    $dbobj = DB::connect();
    $inv_id = $_POST['invid'];     
    
    $sql  = "UPDATE tbl_invoice SET inv_status ='3' WHERE inv_id='$inv_id'";
    $dbobj->query($sql);

    if($dbobj->errno){
        echo("0,Not success try again");
    }else{
        $title = "Order was deliverd";
        $message = " ".$inv_id." This order has Deliverd, Thank you deal with us";
        sendNotification($inv_id,$title,$message);
        echo("1,Succcess");
    }
    $dbobj->close();

}



/*----------------------Add new customer  --------------------------   */

function addNewCustomer(){

    $ncus_id = $_POST['ncus_id'];
    $ncus_email = $_POST['ncus_email'];
    $ncus_fname = $_POST['ncus_fname'];
    $ncus_lname = $_POST['ncus_lname'];
    $ncus_mobile = $_POST['ncus_mobile'];
    $ncus_gender = $_POST['gender'];
    $date = date("Y-m-d");
    $status = 1;

    $dbobj= DB::connect();
    $sql = "INSERT INTO `tbl_customers` (`cus_id`,`cus_fname`,`cus_lname`,`cus_email`,`cus_gender`,`cus_mobile`,`cus_jdate`,`cus_status`)
 VALUES ('$ncus_id','$ncus_fname','$ncus_lname','$ncus_email',$ncus_gender,'$ncus_mobile','$date','$status' );";

    $stmt =$dbobj->prepare($sql);
    if(!$stmt->execute()){
        echo ("0,SQL Error ".$stmt->error);
    }else{
        echo("1,Created successfully ");
    }
    $stmt->close();
    $dbobj->close();
}

/*----------------------get product details  --------------------------   */
function getProducts(){
    $prodid = $_POST['prodid'];
    $dbobj = DB::connect();
    $sql = "SELECT pro.prod_id,pro.prod_modal,pro.prod_qty,bat.bat_cprice,bat.bat_sprice,bat.bat_id,war.nodate FROM tbl_products pro INNER JOIN tbl_batch bat ON bat.bat_id =( SELECT b.bat_id FROM tbl_batch b WHERE pro.prod_id = b.prod_id AND b.bat_status='1' ORDER BY b.bat_id ASC LIMIT 1) JOIN tbl_prod_desc des ON des.desc_id= pro.prod_id JOIN tbl_prod_warr war ON des.warr_id = war.id WHERE pro.prod_id='$prodid';";
    $result =  $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $row = $result->fetch_assoc();
    if($row==""){
        echo ("1");
    }else{
        echo (json_encode($row));
    }
    $dbobj->close();
}


/*----------------------Add New Invoice --------------------------   */
function addNewInv(){

    $log_user = $_POST['log_user'];


    $inv_id = $_POST['inv_id']; 
    $inv_date = $_POST['inv_date'];
    
    $cus_id = $_POST['cus_id']; //customer ID
    $cus_mobile = $_POST['cus_mobile'];

    /*---------------------product Details------------*/

    $prod_id = $_POST['tbl_id'];   //product id
    $batch_id = $_POST['bat_id'];
    $prod_cprice = $_POST['tbl_cprice']; //product cost price    

    $nodays= $_POST['warrdate'];    //no of days
    

    $tbl_sprice = $_POST['tbl_sprice']; // selling price
    $tbl_qty = $_POST['tbl_qty'];  // product quantuty  
    
    $totqty = $_POST['totqty']; // invoice total quantati
    $txtdis = $_POST['txtdis']; // invoice discount

    $txtntot = $_POST['txtntot']; // invoice total
    $inv_type = "offline";
    $status ="1";
    
     $payid = getPayId();
     $paydate = date("Y-m-d");
     $inv_time = date("H:m:s");

    $dbobj= DB::connect();

    
    
    
    $sql_inv = "INSERT INTO tbl_invoice (inv_id,cus_id,inv_date,inv_qty,inv_discount,inv_total,inv_paid, pay_id, inv_user,inv_type, inv_status ) VALUES (
    '$inv_id','$cus_id','$inv_date','$totqty','$txtdis','$txtntot','$txtntot','$payid','$log_user','$inv_type','$status')";

    $stmt_inv =$dbobj->prepare($sql_inv);
    if(!$stmt_inv->execute()){
        echo ("0,SQL Error ".$stmt_inv->error);
    }else{
        $row = count($tbl_id = $_POST['tbl_id']);
        for($i=0; $i<$row; $i++){

            $nodays = $nodays[$i]." days";
            $warrenty =date("Y-m-d", strtotime($inv_date. $nodays)); //warrenty expire date

            $sql_prod = "INSERT INTO tbl_inv_prod (inv_id,prod_id,prod_cprice,prod_qty,prod_sprice,warr_expire) VALUES (
            '$inv_id','$tbl_id[$i]','$prod_cprice[$i]','$tbl_qty[$i]','$tbl_sprice[$i]','$warrenty')";
            $stmt_prod =$dbobj->prepare($sql_prod);
            if(!$stmt_prod->execute()){
                 echo ("0,SQL Error ".$stmt_prod->error);
             }else{
                $res = updateStock($dbobj,$batch_id[$i],$tbl_id[$i],$tbl_qty[$i]);
                if ($res=="0"){
                    echo("0,Error on Batch update");
                    exit;
                }

             }

        }
        $sql_pay ="INSERT INTO tbl_payment (pay_id,inv_id,pay_amount,pay_date,pay_time,pay_type) VALUES ('$payid','$inv_id','$txtntot','$paydate','$inv_time','$inv_type')";
                $result_pay = $dbobj->prepare($sql_pay);
                if(!$result_pay->execute()){
                    echo ("0,SQL Error ".$result_pay->error);
                    exit;    
                }
        echo("1,Invoice created");

    }
    $stmt_inv->close();
    $dbobj->close(); 

}


/*----------------------Update Stock with invoice  --------------------------   */

function updateStock($dbobj,$batch_id,$tbl_id,$tbl_qty){
    $sql_batch = "UPDATE tbl_batch SET bat_rem=bat_rem-$tbl_qty WHERE bat_id='$batch_id';";
    $dbobj->query($sql_batch);
    if($dbobj->errno){
        return "0";
    }
    else{
        $sql_status = "UPDATE tbl_batch SET bat_status=0 WHERE bat_id='$batch_id' AND bat_rem=0;";
        $dbobj->query($sql_status);

        $sql_prod = "UPDATE tbl_products SET prod_qty=prod_qty-$tbl_qty WHERE prod_id='$tbl_id';";
        $dbobj->query($sql_prod);
        if($dbobj->errno)
            return "0";
        else
            return "1";
    }
}



/* --------------  add new Payments --------------*/
function addPayments(){
    $invid = $_POST['inv_id'];
    $cdate = $_POST['cdate'];
    $ctime =date('H:m:s');
    $amount = $_POST['pay_amount'];
    $type = "offline";
    

    $dbobj = DB::connect();
    $sql = "INSERT INTO tbl_payment (inv_id,pay_amount,pay_date,pay_time,pay_type) VALUES('$invid','$amount','$cdate','$amount','$type')";
    $stmt = $dbobj->prepare($sql);
    if($dbobj->errno){
         echo("SQL Error : ".$dbobj->error );
         exit;
     }

    if(!$stmt->execute()){
        echo("0,Payment was not success");
    }else{
               
        $sql_inv = "UPDATE tbl_invoice SET inv_paid=inv_paid+$amount WHERE inv_id = '$invid';";
       
        $dbobj->query($sql_inv);

        if($dbobj->errno){
            echo("0,Payment was not success");
        }else{
            echo("1,Payment Is successfully added");
        }
    }
    $dbobj->close();
}

function sendNotification($inv_id,$title,$message){
    $dbobj = DB::connect();
    
    $date = date("Y-m-d");
    $time = date("H:m:s");
    $status = "0";
    // get notification id
    $getnotId = "SELECT * FROM tbl_notification";
    $getid = $dbobj->query($getnotId);
    $count = $getid->num_rows;
    $count++;
    //customer id
    $getcusId = "SELECT cus_id FROM tbl_invoice WHERE inv_id='$inv_id'";
    $getcus = $dbobj->query($getcusId);
    $cus = $getcus->fetch_assoc();
    $cus_id = $cus['cus_id'];

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