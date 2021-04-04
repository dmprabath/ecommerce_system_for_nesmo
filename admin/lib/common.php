<?php
require_once("config.php");

if(isset($_GET["type"])){
    $type = $_GET["type"]; 
    $type();
}
/*------------------------get Category List----------------------*/
function getCategory(){
    $dbobj = DB::connect();

    $sql = "SELECT cat_id, cat_name FROM tbl_category";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    $output .="<option value=''>  All</option>";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
    }

    echo($output);
    $dbobj->close();
}

/*------------------------get Supplier List----------------------*/
function getSuplier(){
    $dbobj = DB::connect();

    $sql = "SELECT sup_id, sup_name FROM tbl_suppliers";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['sup_id']."'>".$row['sup_name']."</option>";
    }

    echo($output);
    $dbobj->close();
}

/*------------------------get Supplier Role----------------------*/
function getSupRole(){
    $dbobj = DB::connect();

    $sql = "SELECT * FROM `tbl_role`";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['role_id']."'>".$row['role_name']."</option>";
    }

    echo($output);
    $dbobj->close();
}

/*------------------------get Warrenty----------------------*/
function getWarranty(){
    $dbobj = DB::connect();

    $sql = "SELECT * FROM `tbl_prod_warr`";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['id']."'>".$row['warrenty']."</option>";
    }

    echo($output);
    $dbobj->close();
}

/*------------------------Send notification about product level----------------------*/

function getProductLevel(){
    $dbobj = DB::connect();
    $sql = "SELECT count(*) prod_id FROM tbl_products WHERE prod_qty <= prod_rlevel;";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo ($dbobj->errno);
        exit;
    }
    $rec = $result->fetch_array();
    $dbobj->close();
    return $rec[0];


}

/*------------------------Send notification about out of stock----------------------*/

function getProductOutStock(){
    $dbobj = DB::connect();
    $sql = "SELECT count(*) prod_id FROM tbl_products WHERE prod_qty ='0';";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo ($dbobj->errno);
        exit;
    }
    $rec = $result->fetch_array();
    $dbobj->close();
    return $rec[0];


}

/*------------------------Send notification about product count----------------------*/
function productCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(prod_id) FROM tbl_products ";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $cusCount = $result->fetch_array();


    $dbobj->close();
    return $cusCount[0];
}

/*------------------------Display unread messages count----------------------*/
function getUnreadMsgCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(*) FROM tbl_messages WHERE msg_status ='0'";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $rec = $result->fetch_array();
    echo ($rec[0]);

    $dbobj->close();
}


/*------------------------Display unread messages List----------------------*/
function getUnreadMessages($uid){
    $dbobj = DB::connect();
    $sql = "SELECT msg_title, msg_from FROM tbl_messages WHERE msg_to = '$uid' AND msg_status ='1'";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    while($rec= $result->fetch_assoc()){
        echo ("<a class='dropdown-item d-flex align-items-center' > <div class='font-weight-bold'><div class='text-truncate'>".$rec['msg_title']."</div><div class='small text-gray-500'>".$rec['msg_from']."</div></div> </a>");
    }

    $dbobj->close();
}

/*------------------------Display register customer count----------------------*/
function customerCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(cus_id) FROM tbl_customers ";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $cusCount = $result->fetch_array();

    echo($cusCount[0]);
    $dbobj->close();
}
function newOrderCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(inv_id) FROM tbl_invoice where inv_status ='1'";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $ordCount = $result->fetch_array();

    echo($ordCount[0]);
    $dbobj->close();
}
function orderCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(inv_id) FROM tbl_invoice ";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $ordCount = $result->fetch_array();

    echo($ordCount[0]);
    $dbobj->close();
}

function newWarrentyCount(){

    $dbobj = DB::connect();
    $sql = "SELECT count(warr_id) FROM tbl_warrenty WHERE status ='1' ";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $ordCount = $result->fetch_array();

    echo($ordCount[0]);
    $dbobj->close();
}

function yourPerformance(){
    $user = $_SESSION["user"]["uid"];

    $dbobj = DB::connect();
    $cdate = date("Y-m-d");
    $bdate = date("Y-m-d",strtotime("-1 months"));
    //$sql = "SELECT count(inv_id) FROM tbl_warrenty WHERE status ='1' ";
    $sql = "SELECT count(inv_id) FROM tbl_invoice WHERE inv_status ='1' AND inv_user='$user' AND inv_date BETWEEN ' $bdate' AND ' $cdate' ";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $ordCount = $result->fetch_array();

    echo( $ordCount[0]);
    $dbobj->close();
}
//          Chart in admin dhashboard
function prodRemCount(){
    $dbobj = DB::connect();
    $sql = "SELECT prod_modal,prod_qty FROM tbl_products";

    $result = $dbobj->query($sql);
    $data_point=array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['prod_modal'];
        $point['value'] = $row['prod_qty'];

        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();
}


function cusRegCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(cus_fname),cus_jdate FROM tbl_customers GROUP BY cus_jdate";

    $result = $dbobj->query($sql);
    $data_point=array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['cus_jdate'];
        $point['value'] = $row['count(cus_fname)'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();
}

function employeeList($log_id){
    $dbobj = DB::connect();
    $sql ="SELECT emp_id, emp_fname,emp_lname FROM tbl_users WHERE emp_id != '$log_id' and emp_status='1'";

    $result = $dbobj->query($sql);
    $output ="";
    while($rec=$result->fetch_assoc()){
        $output .= "<option value='".$rec['emp_id']."'>".$rec['emp_fname']." ".$rec['emp_lname']."</option>";
    }
    echo($output);
    $dbobj->close();
}



?>