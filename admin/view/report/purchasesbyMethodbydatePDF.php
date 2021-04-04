<?php
session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];
}
if(isset($_GET['sdate'])){
    $sdate =$_GET['sdate'];
    $edate =$_GET['edate'];
    $method =$_GET['method'];
}


require_once("../../../resources/plugin/dompdf/autoload.inc.php");
require_once ("../../lib/config.php");

//reference the dompdf namespace
use Dompdf\Dompdf;
$dompdf  = new Dompdf();
;


// Load html content
$output ="";

$output .= '<style type="text/css">'.file_get_contents('../../../resources/bootstrap/css/bootstrap.css').'</style>';
$output .= '<script type="text/javascript">'.file_get_contents('../../../resources/bootstrap/js/bootstrap.js').'</script>';

$output .="<h3 class='text-center text-capitalize'>".$method." Sales By Product</h3>";
$output .="<p class='text-center'>From".$sdate." To ".$edate." </p>";
$output .="<table class='mb-3' width='30%'>";

            $dbobj  =DB::connect();
            $sql = "SELECT  pay.pay_id,pay.inv_id,cus.cus_fname,pay.pay_date,pay.pay_time,pay.pay_amount,pay.pay_type FROM tbl_payment pay LEFT JOIN tbl_invoice inv  ON pay.inv_id = inv.inv_id JOIN tbl_customers cus ON inv.cus_id = cus.cus_id WHERE pay_type='$method' AND pay.pay_date BETWEEN '$sdate' AND '$edate' ORDER BY inv_id ";
            $result = $dbobj->query($sql);
            $no =0;
            $amount = 0;
                 
            while ($rec = $result->fetch_assoc()) {
               
                $amount =$amount+$rec['pay_amount'];
                            
                 $no++;
            }
         $amount = number_format($amount,2)  ; 
$output .= "<tr><td>No of payments  </td><td>: ".$no."</td></tr>";
$output .= "<tr><td>Total Amount  </td><td>: Rs. ".$amount."</td></tr>";
$output .="</table>";

$output .="<table class='table small' >
            <thead>
                <tr>
                    <th></th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Date and Time</th>
                    <th>Amount</th>
                    <th>Method</th>
                </tr>
            </thead><tbody>";
            $sql2 = "SELECT  pay.pay_id,pay.inv_id,cus.cus_fname,cus.cus_lname,pay.pay_date,pay.pay_time,pay.pay_amount,pay.pay_type FROM tbl_payment pay LEFT JOIN tbl_invoice inv  ON pay.inv_id = inv.inv_id JOIN tbl_customers cus ON inv.cus_id = cus.cus_id WHERE pay_type = '$method' AND pay.pay_date BETWEEN '$sdate' AND '$edate' ORDER BY inv_id";
            $result2 = $dbobj->query($sql2);
            
             $i=1;    
            while ($row = $result2->fetch_assoc()) {
                $output .="<tr><td>".$i."</td>";  
                $output .="<td>".$row['inv_id']."</td>";  
                 $output .="<td>" .$row['cus_fname']." ".$row['cus_lname']."</td>";
                 $output .="<td>" .$row['pay_date']." ".$row['pay_time']."</td>";
                 $output .="<td>".$row['pay_amount'] ."</td>";
                 $output .="<td>".$row['pay_type'] ."</td></tr>";
                 
                 $i++;
            }



$output .="</tbody></table>";



// Pdf Footer Start ---------------------
/*$output .= ;
$output .="</p>" ;*/
$output .= "<footer style='position: fixed; bottom: -30px; left: 0px; right: 0px;  height: 85px;  '>
<p class='text-left fixed-bottom ' >Print By : ".$oper." </p>
<p class='text-right fixed-bottom ' >Print Date : ".date("Y-m-d")." /  ".date("h:i:sa")."</p>

</footer>";
// Pdf Footer End ---------------------
$output .= "";



$dompdf->loadHtml($output);
//setup papaer size

$dompdf->setPaper('A4','landscape');
//render the html as PDF
$dompdf->render();


//output the generated Pdf
$dompdf->stream("Nesmo product",array("Attachment"=>0));

?>