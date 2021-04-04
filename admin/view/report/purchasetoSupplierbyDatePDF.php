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

$output .="<h3 class='text-center'>Paid To supplier(GRN)</h3>";
$output .="<p class='text-center'>From".$sdate." To ".$edate." </p>";
$output .="<table class='mb-3' width='30%'>";

            $dbobj  =DB::connect();
            $sql = "SELECT grn_id , sup_name, grn_rdate,grn_total FROM tbl_grn grn JOIN tbl_suppliers sup ON grn.sup_id = sup.sup_id WHERE grn_rdate BETWEEN '$sdate' AND '$edate' ORDER BY grn_rdate";
            $result = $dbobj->query($sql);
            $no =0;
            $countCancel = 0;
                 
                 $paid = 0;
            while ($rec = $result->fetch_assoc()) {
               
                $paid = $paid +  $rec['grn_total'];
                
                 
                 
                
                 $no++;
            }
           
            $paid = number_format($paid,2);
$output .= "<tr><td>Total Orders  </td><td>: ".$no."</td></tr>";
$output .= "<tr><td>Paid   </td><td>: Rs. ".$paid."</td></tr>";
$output .="</table>";

$output .="<table class='table ' >
            <thead>
                <tr>
                    <th></th>
                    <th>GRN ID</th>
                    <th>Supplier Name</th>
                    <th>Date</th>
                    <th>Paid (Rs.) </th>
                </tr>
            </thead><tbody>";
            $sql2 = "SELECT grn_id , sup_name, grn_rdate,grn_total FROM tbl_grn grn JOIN tbl_suppliers sup ON grn.sup_id = sup.sup_id WHERE grn_rdate BETWEEN '$sdate' AND '$edate' ORDER BY grn_rdate";
            $result2 = $dbobj->query($sql2);
            
             $i=1;    
            while ($row = $result2->fetch_assoc()) {
                $output .="<tr><td>".$i."</td>";  
                $output .="<td>".$row['grn_id']."</td>";  
                 $output .="<td>" .$row['sup_name']."</td>";
                 $output .="<td>" .$row['grn_rdate']."</td>";
                    $tot =$row['grn_total'] ;
                    $tot = number_format($tot,2);
                 $output .="<td class='text-right pr-5'> ".$tot."</td></tr>";
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