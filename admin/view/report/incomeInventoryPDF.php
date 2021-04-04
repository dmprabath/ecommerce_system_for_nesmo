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
require_once ("../../../lib/config.php");

//reference the dompdf namespace
use Dompdf\Dompdf;
$dompdf  = new Dompdf();
;


// Load html content
$output ="";

$output .= '<style type="text/css">'.file_get_contents('../../../resources/bootstrap/css/bootstrap.css').'</style>';
$output .= '<script type="text/javascript">'.file_get_contents('../../../resources/bootstrap/js/bootstrap.js').'</script>';

$output .="<h3 class='text-center'>Recieved Products From ".$sdate." To ".$edate."</h3>";


$output .="<table class='table small' >
            <thead>
                <tr>
                    <th></th>
                    <th>Recieved ID</th>
                    <th>Product Modal</th>
                    <th>Quantity </th>
                    <th>Available </th>
                </tr>
            </thead><tbody>";
            $dbobj = DB::connect();
            $sql2 = "SELECT bat.* , pro.prod_modal FROM tbl_batch bat JOIN tbl_products pro ON pro.prod_id = bat.prod_id WHERE bat_rdate BETWEEN '$sdate' AND '$edate' ORDER BY bat_rdate ";
            $result2 = $dbobj->query($sql2);
            
             $i=0;
             $qty = 0;    
             $remqty = 0;    
            while ($row = $result2->fetch_assoc()) {
                $i++;
                $output .="<tr><td>".$i."</td>";  
                $output .="<td>".$row['bat_rdate']."</td>";  
                 $output .="<td>" .$row['prod_modal']." </td>";
                 $output .="<td>" .$row['bat_qty']."</td>";
                 $qty = $qty+$row['bat_qty'];
                 $output .="<td>" .$row['bat_rem']."</td></tr>";
                 $remqty = $remqty+$row['bat_rem'];
                 
            }


$output .="</tbody></table>";
            $output .="<p> ";
            $output .="No of Products : " .$i."<br> ";
            $output .="Total Quantity : " .$qty."<br> ";
            $output .="Availbale Quantity : " .$remqty." <br>";
            $output .="</p> ";
            $dbobj->close();


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