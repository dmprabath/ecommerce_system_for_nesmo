<?php
session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];
 

}
if(isset($_GET['grnid'])){
    $grn_id =$_GET['grnid'];
 
}

//Include autoloader

require_once("../../../resources/plugin/dompdf/autoload.inc.php");
require_once ("../../lib/config.php");
//reference the dompdf namespace
use Dompdf\Dompdf;
$dompdf  = new Dompdf();


// Load html content 
$output ="";
/*$output .= '<style type="text/css">'.file_get_contents('rep_style.css').'</style>';*/
$output .= '<style type="text/css">'.file_get_contents('../../../resources/bootstrap/css/bootstrap.css').'</style>';
$output .= '<script type="text/javascript">'.file_get_contents('../../../resources/bootstrap/js/bootstrap.js').'</script>';

// Pdf Header  Start---------------------
$output  .= "<img src='nesmo header.png'class='w-100' style='padding-bottom: 25px;'>"; ;

$output .= "<h3 class='text-center'>GOOD RECEIVED NOTE</h3>";
// Pdf Header End ---------------------
// connect Database
$dbobj = DB::connect();
$sql = "SELECT * FROM tbl_grn JOIN tbl_suppliers ON tbl_grn.sup_id = tbl_suppliers.sup_id WHERE grn_id ='$grn_id'";
$result = $dbobj->query($sql);
$row = $result->fetch_assoc();
$output .="<p> GRN Number   - ".$grn_id."</p>";
$output .="<p> Recivede Date - ".$row['grn_rdate']."</p>";
$output .="<p>Supplier Details :<br>";

$output .="".$row['sup_name']."<br>";
$output .="".$row['sup_address']."<br>";
$output .="".$row['sup_email']."<br>";
$output .="".$row['sup_contact']."</p>";


$sql2 = "SELECT bat_id,prod_modal,bat_cprice,bat_sprice,bat_qty,bat_rem,bat_rdate,bat_status,total_price
    FROM tbl_batch JOIN tbl_products 
    ON tbl_batch.prod_id=tbl_products.prod_id 
    WHERE tbl_batch.grn_id='$grn_id'";
$result2 = $dbobj->query($sql2);

$output .="<table class='table small table-bordered'>";
$output .="<tr><th >Batch ID</th>";
$output .="<th >Prod Modal</th>";
$output .="<th >Cost Price</th>";
$output .="<th >Selling Price</th>";
$output .="<th >Quantity</th>";
$output .="<th >Total Price</th></tr>";

while($row2= $result2->fetch_assoc()){
    $output .="<tr>";
    $output .="<td class='col' >".$row2['bat_id']."</td>";
    $output .="<td class='col'>".$row2['prod_modal']."</td>";
    $output .="<td class='col' >".$row2['bat_cprice']."</td>";
    $output .="<td class='col' >".$row2['bat_sprice']."</td>";
    $output .="<td class='col'>".$row2['bat_qty']."</td>";
    $output .="<td class='col text-right'>".$row2['total_price']."</td>";
    $output .="</tr>";
}

$output .="<tr ><td colspan='4'></td><td >".$row['total_qty']."</td><td class='text-right'>".$row['grn_total']."</td></tr>";


$output .="</table>";

$output .="<table style='margin-top:50px'><tr>";
    $output .="<td class='text-center'>";
    $output .="<p>....................................<br/> Authorized Person</p>";
    $output .="</td >";
    $output .="<td class='text-center' style='padding-left:100px'>";
    $output .="<p>....................................<br/>Supplier</p>";
    $output .="</td>";
$output .="</tr></table>";




// Pdf Footer Start ---------------------
$output .= "<footer style='position: fixed; bottom: -30px; left: 0px; right: 0px;  height: 75px;  '>
<p class='text-left fixed-bottom ' >Print By : ".$oper." </p>
<p class='text-right fixed-bottom ' >Print Date : ".date("Y-m-d")." /  ".date("h:i:sa")."</p>
<img src='nesmo footer.png'class='w-100' style='padding-bottom: 25px;'>
</footer>";
// Pdf Footer End ---------------------
$output .= "";



$dompdf->loadHtml($output);
//setup papaer size

$dompdf->setPaper('A4','portrait');
//render the html as PDF
$dompdf->render();


//output the generated Pdf
$dompdf->stream("Sample",array("Attachment"=>0));

?>