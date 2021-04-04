<?php
session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];
}
if(isset($_GET['month'])){
        $result= $_GET['month'];
        $res =explode("_",$result);
        $month = $res[0];
        $monthname = $res[1];

        $year = $_GET['year'];        
 
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

$output .="<h3 class='text-center'>Purchase to Supplier Report By Month</h3>";
$output .="<p class='text-center h5  text-dark'>".$monthname ." ". $year ." </p>";
$output .="<table class='mb-3' width='50%'>";

            $dbobj  =DB::connect();
            $sql = "SELECT count(grn_id) , sum(grn_total) FROM tbl_grn grn WHERE MONTH(grn_rdate)= '$month' AND YEAR(grn_rdate) = '$year'";
            $result = $dbobj->query($sql);
            $no =0;
            $countCancel = 0;
                 
                 $paid = 0;
           $rec = $result->fetch_assoc();
           
            $paid = number_format($paid,2);
$output .= "<tr><td>Month and Year  </td><td>: ".$monthname." ".$year."</td></tr>";
$output .= "<tr><td>No of Orders   </td><td>:  ".$rec['count(grn_id)']."</td></tr>";
$output .= "<tr><td>Total cost (Rs.)   </td><td>: Rs. ".number_format($rec['sum(grn_total)'],2)."</td></tr>";
$output .="</table>";

$output .="<table class='table ' >
            <thead>
                <tr>
                    <th></th>
                    <th>GRN Id</th>
                    <th>Supplier Name</th>
                    <th>GRN Date</th>
                    <th>Order Cost (Rs)</th>
                </tr>
            </thead><tbody>";
            $sql2 = "SELECT grn_id , sup_name, grn_rdate,grn_total FROM tbl_grn grn JOIN tbl_suppliers sup ON grn.sup_id = sup.sup_id WHERE MONTH(grn_rdate)= '$month' AND YEAR(grn_rdate) = '$year' ORDER BY grn_rdate ";
            $result2 = $dbobj->query($sql2);
            
             $i=1;    
            while ($row = $result2->fetch_assoc()) {
                $output .="<tr><td>".$i."</td>";  
                $output .="<td>".$row['grn_id']."</td>";  
                 $output .="<td>" .$row['sup_name']."</td>";
                 $output .="<td>" .$row['grn_rdate'] ."</td>";
                   
                 $output .="<td class='text-right pr-5'> ".number_format($row['grn_total'],2) ."</td></tr>";
                 $i++;
            }
            $dbobj->close();


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