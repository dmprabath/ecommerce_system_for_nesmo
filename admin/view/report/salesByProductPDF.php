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

$output .="<h3 class='text-center'>Sales By Product</h3>";
$output .="<p class='text-center'>From".$sdate." To ".$edate." </p>";
$output .="<table class='mb-3' width='20%'>";

            $dbobj  =DB::connect();
            $sql = "SELECT pro.prod_name, pro.prod_modal,cat.cat_name, SUM(invp.prod_qty)  FROM tbl_invoice inv JOIN tbl_inv_prod invp On inv.inv_id= invp.inv_id JOIN tbl_products pro ON invp.prod_id = pro.prod_id JOIN tbl_category cat ON pro.cat_id = cat.cat_id WHERE inv_date BETWEEN '$sdate' AND '$edate' GROUP BY prod_name ORDER BY invp.inv_id  ";
            $result = $dbobj->query($sql);
            $no =0;
                $quantity = 0;
                 
            while ($rec = $result->fetch_assoc()) {
               
                $quantity =$quantity+$rec['SUM(invp.prod_qty)'];
                            
                 $no++;
            }
            
$output .= "<tr><td>No of Products  </td><td>: ".$no."</td></tr>";
$output .= "<tr><td>Quantity  </td><td>: ".$quantity."</td></tr>";
$output .="</table>";

$output .="<table class='table small' >
            <thead>
                <tr>
                    <th></th>
                    <th>Product Modal</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                </tr>
            </thead><tbody>";
            $sql2 = "SELECT pro.prod_name, pro.prod_modal,cat.cat_name, SUM(invp.prod_qty)  FROM tbl_invoice inv JOIN tbl_inv_prod invp On inv.inv_id= invp.inv_id JOIN tbl_products pro ON invp.prod_id = pro.prod_id JOIN tbl_category cat ON pro.cat_id = cat.cat_id WHERE inv_date BETWEEN '$sdate' AND '$edate' GROUP BY prod_name ORDER BY invp.inv_id ";
            $result2 = $dbobj->query($sql2);
            
             $i=1;    
            while ($row = $result2->fetch_assoc()) {
                $output .="<tr><td>".$i."</td>";  
                $output .="<td>".$row['prod_modal']."</td>";  
                 $output .="<td>" .$row['prod_name']."</td>";
                 $output .="<td>" .$row['cat_name']."</td>";
                 $output .="<td>".$row['SUM(invp.prod_qty)'] ."</td>";
                 
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