<?php
require_once("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type(); 
}

/*---------------------------------Inventry Reports-----------------------------------------*/
function stockSummery(){
    $table = "tbl_products";

    $primary_key ="prod_id" ;

    $columns = array(
        array( 'db' => 'prod_id', 'dt' => 0 ),
        array( 'db' => 'prod_modal',  'dt' => 1 ),
        array( 'db' => 'prod_qty',   'dt' => 2 ),
        array( 'db' => 'prod_rlevel',   'dt' => 3 ),
        array( 'db' => 'cat_id',   'dt' => 4 ),
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

function lowStockSummery(){
    $table = "tbl_products";

    $primary_key ="prod_id" ;

    $columns = array(
        array( 'db' => 'prod_id', 'dt' => 0 ),
        array( 'db' => 'prod_modal',  'dt' => 1 ),
        array( 'db' => 'prod_qty',   'dt' => 2 ),
        array( 'db' => 'prod_rlevel',   'dt' => 3 ),
        array( 'db' => 'cat_id',   'dt' => 4 ),
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
        SSP::complex($_POST, $sql_details, $table, $primary_key, $columns,"prod_qty < prod_rlevel")
    );
}


        
        /*---------------------------------Income Inventory------------------------------*/

function incomeInventory($sdate, $edate){

    $dbobj = DB::connect();
    $sql = "SELECT bat.* , pro.prod_modal FROM tbl_batch bat JOIN tbl_products pro ON pro.prod_id = bat.prod_id WHERE bat_rdate BETWEEN '$sdate' AND '$edate' ORDER BY bat_rdate ";

    $result = $dbobj->query($sql);

    $output = "";
    $i=1;
    if($result->num_rows =="0"){
        $output .="<tr><td>No data<td></tr>";
    }else{
        while ($rec = $result->fetch_assoc()) {
            $output .= "<tr>
                            <td>".$i."</td>
                            <td>".$rec['bat_rdate']."</td>
                            <td>".$rec['prod_modal']."</td>
                            <td>".$rec['bat_qty']."</td>
                            <td>".$rec['bat_rem']."</td>

                        </tr>";
                        $i++;
        }
    }
    

    echo $output;
    $dbobj->close();
}

/*---------------------------------Expenses Reports-----------------------------------------*/
function numberorderbyyear(){

    $year = $_GET['year'];

    

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), count(inv_id) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['MONTHNAME(inv_date)'];
        $point['value'] = $row['count(inv_id)'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}

/*---------------------------------Expenses Reports-----------------------------------------*/

function ordersummerybyyear(){

    $year = $_GET['year'];

    

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), sum(inv_total), sum(inv_paid) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);

    $dataArray = array(
        "chart" => array(
            "theme" => "fusion",
            "caption" => "Total Revenue",
            "exportEnabled" => "1",
            "subCaption" => $year,
        )
    );

    $categoryArray = array();
    $dataserios1 = array();
    $dataserios2 = array(); 

    while($row= $result->fetch_assoc()){
        array_push($categoryArray,array("label"=> $row['MONTHNAME(inv_date)']));

        array_push($dataserios1,array("value"=> $row['sum(inv_total)']));
        array_push($dataserios2,array("value"=> $row['sum(inv_paid)']));

    }
    $dataArray["categories"] = array(array("category"=>$categoryArray));

    $dataArray["dataset"] = array(array("seriesName"=>'invoice Total',"data"=>$dataserios1),array("seriesName"=>'invoice Paid',"data"=>$dataserios2));
     echo json_encode($dataArray);

    //header('Content-type: application/json');
   
    $dbobj->close();

}

/*---------------------------------Expenses Reports-----------------------------------------*/
function numberonlinesalesbyyear(){

    $year = $_GET['year'];

    

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), count(inv_id) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' AND inv_type='online' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['MONTHNAME(inv_date)'];
        $point['value'] = $row['count(inv_id)'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}



/*---------------------------------Expenses Reports-----------------------------------------*/

function orderonlinebyyear(){

    $year = $_GET['year'];

    

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), sum(inv_total), sum(inv_paid) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' AND inv_type='online' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);

    $dataArray = array(
        "chart" => array(
            "theme" => "fusion",
            "caption" => "Total Revenue",
            "exportEnabled" => "1",
            "subCaption" => $year,
        )
    );

    $categoryArray = array();
    $dataserios1 = array();
    $dataserios2 = array(); 

    while($row= $result->fetch_assoc()){
        array_push($categoryArray,array("label"=> $row['MONTHNAME(inv_date)']));

        array_push($dataserios1,array("value"=> $row['sum(inv_total)']));
        array_push($dataserios2,array("value"=> $row['sum(inv_paid)']));

    }
    $dataArray["categories"] = array(array("category"=>$categoryArray));

    $dataArray["dataset"] = array(array("seriesName"=>'invoice Total',"data"=>$dataserios1),array("seriesName"=>'invoice Paid',"data"=>$dataserios2));
     echo json_encode($dataArray);

    //header('Content-type: application/json');
   
    $dbobj->close();

}

/*---------------------------------Expenses Reports-----------------------------------------*/
function numberoflinesalesbyyear(){

    $year = $_GET['year'];

    

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), count(inv_id) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' AND inv_type='offline' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['MONTHNAME(inv_date)'];
        $point['value'] = $row['count(inv_id)'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}



/*---------------------------------Expenses Reports-----------------------------------------*/

function orderoflinebyyear(){
    $year = $_GET['year'];   

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), sum(inv_total), sum(inv_paid) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' AND inv_type='offline' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);

    $dataArray = array(
        "chart" => array(
            "theme" => "fusion",
            "caption" => "Total Revenue",
            "exportEnabled" => "1",
            "subCaption" => $year,
        )
    );

    $categoryArray = array();
    $dataserios1 = array();
    $dataserios2 = array(); 

    while($row= $result->fetch_assoc()){
        array_push($categoryArray,array("label"=> $row['MONTHNAME(inv_date)']));

        array_push($dataserios1,array("value"=> $row['sum(inv_total)']));
        array_push($dataserios2,array("value"=> $row['sum(inv_paid)']));

    }
    $dataArray["categories"] = array(array("category"=>$categoryArray));

    $dataArray["dataset"] = array(array("seriesName"=>'invoice Total',"data"=>$dataserios1),array("seriesName"=>'invoice Paid',"data"=>$dataserios2));
     echo json_encode($dataArray);

    //header('Content-type: application/json');
   
    $dbobj->close();

}


/*---------------------------------Product Sales-----------------------------------------*/
function prouductsalesbyyear(){

    $year = $_GET['year'];   

    $dbobj =DB::connect();
    $sql ="SELECT prod_modal, MONTHNAME(inv_date), sum(invp.prod_qty) FROM tbl_invoice inv JOIN tbl_inv_prod invp ON inv.inv_id = invp.inv_id JOIN tbl_products pro ON pro.prod_id = invp.prod_id WHERE YEAR(inv_date) = '$year'  GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);

    $dataArray = array(
        "chart" => array(
            "theme" => "fusion",
            "caption" => "Total Revenue",
            "exportEnabled" => "1",
            "subCaption" => $year,
        )
    );

    $categoryArray = array();
    $dataserios1 = array();
    $seriasname = array(); 

    while($row= $result->fetch_assoc()){
        array_push($seriasname,array($row['prod_modal']));
        array_push($categoryArray,array("label"=> $row['MONTHNAME(inv_date)']));

        array_push($dataserios1,array("value"=> $row['sum(invp.prod_qty)']));
        
        

    }
    $dataArray["categories"] = array(array("category"=>$categoryArray));

    $dataArray["dataset"] = array(array("seriesName"=>$seriasname,"data"=>$dataserios1));
     echo json_encode($dataArray);

    //header('Content-type: application/json');
   
    $dbobj->close();

}



?>