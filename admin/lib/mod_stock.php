<?php

require_once("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();

}

function viewStock(){
    
     /*$table = "tbl_products";*/

    $table ="tbl_products";

    $primaryKey ='prod_id';
    
    $columns = array(

        array( 'db' => 'prod_id', 'dt'=> 0),
        array( 'db' => 'prod_modal', 'dt'=> 1),
        array( 'db' => 'prod_qty', 'dt'=> 2),
        array( 'db' => 'prod_rlevel', 'dt'=> 3),

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


function viewBatch(){
    $prod_id = $_GET['prod_id'];

    $table = <<<EOT
    (SELECT bat_id,prod_modal,bat_cprice,bat_sprice,bat_qty,bat_rem,bat_rdate,bat_status 
    FROM tbl_batch JOIN tbl_products 
    ON tbl_batch.prod_id=tbl_products.prod_id 
    WHERE tbl_batch.prod_id='$prod_id'
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

function changerlevel(){

    $prodid = $_POST['prodid'];
    $newlevel = $_POST['newlevel'];
    $dbobj = DB::connect();

    $sql_update ="UPDATE tbl_products SET prod_rlevel ='$newlevel' WHERE prod_id='$prodid'";
    $stmt_update = $dbobj->prepare($sql_update);
    
    if(!$stmt_update->execute()){
        echo("0,Not Success");
    }else{
        echo("1,Reorder level change successfully");
           
    }
    
    $dbobj->close();
}




?>