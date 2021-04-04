<?php
session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];
 

}
if(isset($_GET['invid'])){
    $invid =$_GET['invid'];
 
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

$output .= "<h3 class='text-center'>INVOICE</h3>";
// Pdf Header End ---------------------
// connect Database
$dbobj = DB::connect();
$sql = "SELECT * FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id = cus.cus_id WHERE inv.inv_id ='$invid'";
$result = $dbobj->query($sql);
$row = $result->fetch_assoc();
$output .="<p> Invoice Number   - ".$invid." <br>";
$output .=" Invoice Date - ".$row['inv_date']."<br>";
$output .=" Invoice Type - ".$row['inv_type']."</p>";
$output .="<p>Customer Details :  ";

$output .="".$row['cus_fname']." ".$row['cus_lname']." ";
$output .="".$row['cus_mobile']."</p>";


$sql2 = "SELECT pro.prod_name,warr.warrenty,invp.prod_sprice,invp.prod_qty, invp.prod_sprice*invp.prod_qty AS total FROM tbl_inv_prod invp JOIN tbl_products pro ON invp.prod_id = pro.prod_id JOIN tbl_prod_desc des ON des.desc_id=pro.prod_id JOIN tbl_prod_warr warr ON des.warr_id = warr.id WHERE invp.inv_id ='$invid'";
$result2 = $dbobj->query($sql2);

$output .="<table class='table small table-bordered' style='width:100%'>";
$output .="<tr><th ></th>";
$output .="<th >Prod Name</th>";
$output .="<th >warrenty</th>";
$output .="<th > Price (Rs)</th>";
$output .="<th >Quantity</th>";
$output .="<th >Total Price (Rs)</th></tr>";
$i ="0";
$total ="0";
while($row2= $result2->fetch_assoc()){
    $i++;
    $output .="<tr>";
    $output .="<td style='width:5%'>".$i."</td>";
    $output .="<td style='width:30%'>".$row2['prod_name']."</td>";
    $output .="<td style='width:20%'>".$row2['warrenty']."</td>";
    $output .="<td style='width:20%'>  ".$row2['prod_sprice']."</td>";
    $output .="<td style='width:5%' class='text-center'>".$row2['prod_qty']."</td>";
    $output .="<td style='width:20%' class='text-right'>  ".$row2['total']."</td>";
    $total = $total+$row2['total'];
    $output .="</tr>";
}
$total = number_format($total,2);
$output .="<tr ><td colspan='4'></td><td class='text-center' >".$row['inv_qty']."</td><td class='text-right'>  ".$total."</td></tr>";

$output .="<tr ><td colspan='3'></td><td class='text-center' colspan='2' >Discount</td><td class='text-right'>  ".$row['inv_discount']."%</td></tr>";
$output .="<tr ><td colspan='3'></td><td class='text-center' colspan='2' >Invoice Total</td><td class='text-right'>  ".number_format($row['inv_total'],2)."</td></tr>";
$output .="<tr ><td colspan='3'></td><td class='text-center' colspan='2' >Paid</td><td class='text-right'>  ".number_format($row['inv_paid'],2)."</td></tr>";


$output .="</table>";

$output .="<table style='margin-top:50px'><tr>";
    $output .="<td class='text-center'>";
    $output .="<p>....................................<br/> Authorized Person</p>";
    $output .="</td >";
    $output .="<td class='text-center' style='padding-left:100px'>";
    $output .="<p>....................................<br/>Customer</p>";
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