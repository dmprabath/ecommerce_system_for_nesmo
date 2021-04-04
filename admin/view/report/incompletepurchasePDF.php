<?php
session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];
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

$output .="<h3 class='text-center'>Incomplete Perchase</h3>";
$output .="<table class='mb-3' width='30%'>";

            $dbobj  =DB::connect();
            $sql = "SELECT inv.inv_id,cus.cus_fname,inv.inv_total,inv.inv_paid,pay.pay_date FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id = cus.cus_id LEFT JOIN tbl_payment pay ON inv.inv_id = (SELECT pays.inv_id FROM tbl_payment pays WHERE pays.inv_id= inv.inv_id  ORDER BY pays.pay_date DESC LIMIT 1 ) WHERE inv_total > inv_paid AND inv_status !='0' GROUP BY inv.inv_id";
            $result = $dbobj->query($sql);
            $no =0;
            
                 $total = 0;
                 $paid = 0;
                 
            while ($rec = $result->fetch_assoc()) {
                 $total = $total + floatval($rec['inv_total']);
                 $paid = $paid +  floatval($rec['inv_paid']);
               
                
                 
                 
                
                 $no++;
            }
            $remain = $total - $paid;
            $remain = number_format($remain,2);
            $total = number_format($total,2);
            $paid = number_format($paid,2);
$output .= "<tr><td>Total Orders  </td><td>- ".$no."</td></tr>";
$output .= "<tr><td>Total   </td><td>- Rs. ".$total."</td></tr>";
$output .= "<tr><td>Paid   </td><td>- Rs. ".$paid."</td></tr>";
$output .= "<tr><td>Remaining   </td><td>- Rs. ".$remain."</td></tr>";
$output .="</table>";

$output .="<table class='table small' >
            <thead>
                <tr>
                    <th></th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Contact No</th>
                    <th>Total(Rs) </th>
                    <th>Paid(Rs) </th>
                    <th>Remaining(Rs) </th>                    
                    <th>Last payment Date</th>
                </tr>
            </thead><tbody>";
            $sql2 = "SELECT inv.inv_id,cus.cus_fname,cus.cus_lname,cus.cus_mobile,cus.cus_email,inv.inv_total,inv.inv_paid,pay.pay_date FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id = cus.cus_id LEFT JOIN tbl_payment pay ON inv.inv_id = (SELECT pays.inv_id FROM tbl_payment pays WHERE pays.inv_id= inv.inv_id  ORDER BY pays.pay_date DESC LIMIT 1 ) WHERE inv_total > inv_paid AND inv_status !='0' GROUP BY inv.inv_id";
            $result2 = $dbobj->query($sql2);
            
             $i=1;    
            while ($row = $result2->fetch_assoc()) {
                $output .="<tr><td>".$i."</td>";  
                $output .="<td>".$row['inv_id']."</td>";  
                 $output .="<td>" .$row['cus_fname']." ".$row['cus_lname']."</td>";
                 $output .="<td>" .$row['cus_mobile']."</td>";
                 $output .="<td>".$row['inv_total'] ."</td>";
                 $output .="<td>".$row['inv_paid'] ."</td>";
                 $intot =$row['inv_total'];
                 $inpaid = $row['inv_paid'];
                 $status = $intot +  $inpaid ;
                 $status = number_format($status,2) ;

                 $output .="<td>" .$status."</td>";
                 $output .="<td>" .$row['pay_date']."</td></tr>";
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