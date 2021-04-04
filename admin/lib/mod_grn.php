<?php
require_once("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();
}

function viewGrn(){

    $table = <<<EOT
	( SELECT grn_id, sup_name, grn_rdate, grn_total, total_qty FROM tbl_grn JOIN tbl_suppliers ON tbl_grn.sup_id = tbl_suppliers.sup_id ORDER BY tbl_grn.grn_id ASC
		) temp
EOT;

    $primary_key ="grn_id" ;

    $columns = array(
        array( 'db' => 'grn_id', 'dt' => 0 ),
        array( 'db' => 'sup_name',  'dt' => 1 ),
        array( 'db' => 'grn_rdate',   'dt' => 2 ),
        array( 'db' => 'total_qty',   'dt' => 3 ),
        array( 'db' => 'grn_total',   'dt' => 4 )
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

function getProuducts(){
    $cat_id = $_POST["cat_id"];
    $dbobj = DB::connect();

    $sql = "SELECT prod_id, prod_modal FROM tbl_products WHERE cat_id='$cat_id'";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['prod_id']."'>".$row['prod_modal']."</option>";
    }
    $out="<option value=''>Select Product</option>";
    echo($out.$output);
    $dbobj->close();
}

function getProudImage(){
    $cat_id = $_POST["cat_id"];
    $prod_id = $_POST["prod_id"];
    $dbobj = DB::connect();

    $sql = "SELECT prod_img FROM tbl_products WHERE prod_id='$prod_id'";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<img src=../resources/img/products/".$row['prod_img']." width='50%' >";
    }
    echo($output);
    $dbobj->close();
}
function getGrnNo(){
    $dbobj = DB::connect();

    $sql = "SELECT grn_id FROM tbl_grn ORDER BY grn_id DESC LIMIT 1";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo ("SQL ERROR : ". $result->error);
        exit;
    }

    $nor = $result->num_rows;
    $grnId = "";
    if($nor=="0"){
        $grnId = "1";
    }else{
        $rec = $result->fetch_array();
        $grnId= $rec[0];
        $grnId= $grnId+1;
    }
    echo ($grnId);
    $dbobj->close();

}

function addNewGrn(){
    $grn_id = $_POST["grnid"];
    $rdate = $_POST["rdate"];
    $grn_sup = $_POST["selectSup"];
    $tbl_cat = $_POST["tbl_cat"];
    $tbl_prod = $_POST["tbl_prod"];
    $tbl_qty = $_POST["tbl_qty"];
    $tbl_cprice = $_POST["tbl_cprice"];
    $tbl_sprice = $_POST["tbl_sprice"];
    $bat_price = $_POST["bat_price"];
    $gtot = $_POST["txtgtot"];
    $ntot = $_POST["txtntot"];
    $totqty =$_POST['totqty'];
    $status = 1;



    $dbobj = DB::connect();

    $sql = "INSERT INTO tbl_grn (grn_id,sup_id,grn_rdate,grn_total,total_qty,grn_status) VALUES ('$grn_id','$grn_sup','$rdate','$ntot','$totqty','$status')";
    $stmt = $dbobj->prepare($sql);

    if(!$stmt->execute()){
        echo(" GRN SQL Error: ".$stmt->error);
        exit;
    }else {
        $rows = count($_POST['tbl_prod']);
        for($i=0; $i<$rows; $i++ ){
            $bat_id = getBatchNo();
            $sql_batch = "INSERT INTO tbl_batch (bat_id,grn_id,prod_id,bat_cprice,bat_sprice,bat_qty,bat_rem,bat_rdate,total_price,bat_status) VALUES (?,?,?,?,?,?,?,?,?,?)";

            $stmt_batch= $dbobj->prepare($sql_batch);
            $stmt_batch->bind_param("sisddiisdi",$bat_id,$grn_id,$tbl_prod[$i],$tbl_cprice[$i],$tbl_sprice[$i],$tbl_qty[$i],$tbl_qty[$i],$rdate,$bat_price[$i],$status);
            if(!$stmt_batch->execute()){
                echo(" Batch SQL Error: ".$stmt_batch->error);
                exit;
            }else{
                $sql_prod_upd ="UPDATE tbl_products SET prod_qty=prod_qty+? WHERE prod_id=?" ;
                $stmt_prod = $dbobj->prepare($sql_prod_upd);
                $stmt_prod->bind_param("is",$tbl_qty[$i],$tbl_prod[$i]);
                if(!$stmt_prod->execute()){
                    echo(" Prod SQL Error: ".$stmt_prod->error);
                    exit;
                }
                $stmt_prod->close();
            }
            $stmt_batch->close();
        }
        echo("1,GRN Successfully added");
        $stmt->close();
        $dbobj->close();

    }

}
function getBatchNo(){
    $dbobj = DB::connect();

    $sql = "SELECT bat_id FROM tbl_batch ORDER BY bat_id DESC LIMIT 1";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo ("SQL ERROR : ".$result->error);
        exit;
    }

    $nor = $result->num_rows;

    if($nor=="0"){
        $batId = "BAT00001";
    }else{
        $rec = $result->fetch_assoc();
        $lastId= $rec["bat_id"];
        $num = substr($lastId,3);
        $num++;
        $batId= "BAT".str_pad($num,5,"0",STR_PAD_LEFT);
    }

    $dbobj->close();
    return $batId;
}

function viewGrnDetail(){
    $grn_id = $_POST["grn_id"];
     $dbobj= DB::connect();
     $sql = "SELECT grn.grn_id,grn.grn_rdate,sup.sup_name FROM tbl_grn grn JOIN tbl_suppliers sup ON grn.sup_id = sup.sup_id WHERE grn_id='$grn_id'  ;";
     
     $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $rec = $result->fetch_assoc();
    echo(json_encode($rec));
    $dbobj->close();

}


function viewDetails(){
    $grn_id = $_GET['grn_id'];

    $table = <<<EOT
    (SELECT bat_id,prod_modal,bat_cprice,bat_sprice,bat_qty,bat_rem,bat_rdate,bat_status 
    FROM tbl_batch JOIN tbl_products 
    ON tbl_batch.prod_id=tbl_products.prod_id 
    WHERE tbl_batch.grn_id='$grn_id'
    )temp

EOT;

    $primaryKey ='bat_id';

    $columns = array(
        array( 'db' => 'bat_id', 'dt'=> 0),
        array( 'db' => 'prod_modal', 'dt'=> 1),
        array( 'db' => 'bat_cprice', 'dt'=> 2),
        array( 'db' => 'bat_sprice', 'dt'=> 3),
        array( 'db' => 'bat_qty', 'dt'=> 4),
        array( 'db' => 'bat_rem', 'dt'=> 5),
        array( 'db' => 'bat_rdate', 'dt'=> 6),
        array( 'db' => 'bat_status', 'dt'=> 7)

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
?>