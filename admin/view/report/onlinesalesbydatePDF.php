<?php
session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];
}
if(isset($_GET['sdate'])){
    $sdate =$_GET['sdate'];
    $edate =$_GET['edate'];
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

$output .="<h3 class='text-center'>Online Order Analysis By Date</h3>";
$output .="<p class='text-center'>From".$sdate." To ".$edate." </p>";
$output .="<table class='mb-3' width='30%'>";

            $dbobj  =DB::connect();
            $sql = "SELECT * FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id = cus.cus_id WHERE inv_type = 'online' AND inv_date BETWEEN '$sdate' AND '$edate' ORDER BY inv_id ";
            $result = $dbobj->query($sql);
            $no =0;
            $countCancel = 0;
                 $countNconfirm = 0;
                 $countConfirm = 0;
                 $countDili = 0;
                 $total = 0;
                 $paid = 0;
            while ($rec = $result->fetch_assoc()) {
                $ord = $rec['inv_status'];
                $total = $total +  $rec['inv_total'];
                $paid = $paid +  $rec['inv_paid'];
                
                 
                 if($ord == "0") {
                     $countCancel = $countCancel+1;
                 }else if($ord =="1"){
                     $countNconfirm = $countNconfirm +1;
                 } else if($ord =="2"){
                     $countConfirm = $countConfirm +1;
                 } else if($ord =="3"){
                     $countDili = $countDili+1;
                 } 
                
                 $no++;
            }
            $total = number_format($total,2);
            $paid = number_format($paid,2);
$output .= "<tr><td>Total Orders  </td><td>- ".$no."</td></tr>";
$output .= "<tr><td>Cancel Orders  </td><td>- ".$countCancel."</td></tr>";
$output .= "<tr><td>Not confirm Orders  </td><td> - ".$countNconfirm."</td></tr>";
$output .= "<tr><td>Confirm Orders  </td><td>- ".$countConfirm."</td></tr>";
$output .= "<tr><td>Deliverd Orders  </td><td>- ".$countDili."</td></tr>";
$output .= "<tr><td>Total   </td><td>- (Rs) ".$total."</td></tr>";
$output .= "<tr><td>Paid   </td><td>- (Rs) ".$paid."</td></tr>";
$output .="</table>";

$output .="<table class='table small' >
            <thead>
                <tr>
                    <th></th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Contact No</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
            </thead><tbody>";
            $sql2 = "SELECT * FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id = cus.cus_id WHERE inv_type = 'online' AND inv_date BETWEEN '$sdate' AND '$edate' ORDER BY inv_id ";
            $result2 = $dbobj->query($sql2);
            
             $i=1;    
            while ($row = $result2->fetch_assoc()) {
                $output .="<tr><td>".$i."</td>";  
                $output .="<td>".$row['inv_id']."</td>";  
                 $output .="<td>" .$row['cus_fname']."</td>";
                 $output .="<td>" .$row['cus_mobile']."</td>";
                 $output .="<td>".$row['inv_date'] ."</td>";
                 $status = $row['inv_status'];
                
                 if($status == "0") {
                     $status = "canceled";
                 }else if($status =="1"){
                     $status = "Not Confirm";
                 } else if($status =="2"){
                     $status = "Confirmed";
                 } else if($status =="3"){
                     $status = "Deliverd";
                 } 
                 $output .="<td>" .$status."</td></tr>";
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