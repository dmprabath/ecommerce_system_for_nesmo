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

$output .="<h3 class='text-center'>Incomplete Warranty Summery Report</h3>";
$output .="<table class='mb-3' width='20%'>";

            $dbobj  =DB::connect();
            $sql = "SELECT warr_id, inv_id,cus_fname,cus_lname,warr_date,complete_date,warr_claim, description, status FROM tbl_warrenty warr JOIN tbl_customers cus ON warr.cus_id = cus.cus_id  WHERE status !=2 ORDER BY warr_date ";
            $result = $dbobj->query($sql);
            $no =0;
            $pending = 0;
            $working = 0;
            $finished = 0;
                 
            while ($rec = $result->fetch_assoc()) {
               
                $type = $rec['status'];
                if($type=="0"){
                     $pending =  $pending +1;
                }else if($type=="1"){
                     $working  =  $working  +1;
                }else if($type=="2"){
                    $finished  =  $finished  +1;
                }
                            
                 $no++;
            }
            
$output .= "<tr><td>No of warranty  </td><td>: ".$no."</td></tr>";
$output .= "<tr><td>Pending  </td><td>: ".$pending."</td></tr>";
$output .= "<tr><td>Working  </td><td>: ". $working."</td></tr>";
$output .= "<tr><td>Finished  </td><td>: ". $finished."</td></tr>";
$output .="</table>";

$output .="<table class='table small' >
            <thead>
                <tr>
                    <th>warranty Id</th>
                    <th>Invoice Id</th>
                    <th>Customer Name</th>
                    <th>Warranty Date</th>
                    <th>Complete Date</th>
                    <th>Probleme</th>
                    <th>Solution</th>
                    <th>Status</th>
                </tr>
            </thead><tbody>";
            $sql2 = "SELECT warr_id, inv_id,cus_fname,cus_lname,warr_date,complete_date,warr_claim, description, status FROM tbl_warrenty warr JOIN tbl_customers cus ON warr.cus_id = cus.cus_id  WHERE status !=2 ORDER BY warr_date";
            $result2 = $dbobj->query($sql2);
            
             $i=1;    
            while ($row = $result2->fetch_assoc()) {
                $output .="<tr><td>".$row['warr_id']."</td>";  
                $output .="<td>".$row['inv_id']."</td>";  
                 $output .="<td>" .$row['cus_fname']." ".$row['cus_lname']."</td>";
                 $output .="<td>" .$row['warr_date']."</td>";
                 $output .="<td>".$row['complete_date'] ."</td>";
                 $output .="<td>".$row['warr_claim'] ."</td>";
                 $output .="<td>".$row['description'] ."</td>";
                        $status = $rec['status'];

                        if($status == "0") {
                            $status = "Pending";
                        }else if($status =="1"){
                            $status = "Confirm";
                        } else {
                            $status = "Deliverd";
                        }  

                 $output .="<td>".$status."</td></tr>";
                 
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