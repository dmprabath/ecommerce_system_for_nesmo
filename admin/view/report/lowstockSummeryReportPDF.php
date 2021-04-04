<?php
session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];
}
if(isset($_GET['category'])){
    $category = $_GET['category'];
}


require_once("../../../resources/plugin/dompdf/autoload.inc.php");
require_once ("../../lib/config.php");

//reference the dompdf namespace
use Dompdf\Dompdf;
$dompdf  = new Dompdf();
;


// Load html content
$output ="";
/*$output .= '<style type="text/css">'.file_get_contents('rep_style.css').'</style>';*/
$output .= '<style type="text/css">'.file_get_contents('../../../resources/bootstrap/css/bootstrap.css').'</style>';
$output .= '<script type="text/javascript">'.file_get_contents('../../../resources/bootstrap/js/bootstrap.js').'</script>';

$output  .= "<img src='nesmo header.png'class='w-100' style='padding-bottom: 25px;'>"; 

$date = date("Y-m-d");
$dbobj = DB::connect();
if($category==""){
    $sql = "SELECT prod_id,prod_modal,cat_name,prod_qty,prod_rlevel FROM tbl_products pro JOIN tbl_category cat ON pro.cat_id = cat.cat_id AND pro.prod_qty < pro.prod_rlevel  ";
    $output .= "<h4 class='text-center'>Low Stock Report of ".$date ." </h4>";
}else{
    $sql = "SELECT * FROM tbl_products pro JOIN tbl_category cat ON pro.cat_id = cat.cat_id AND pro.cat_id='$category' AND pro.prod_qty < pro.prod_rlevel ";
   $output .= "<h4 class='text-center'> Low Stock Report of ".$date ." </h4>";
}



$result = $dbobj->query($sql);

$output .="<table class='table table-borderless table-sm pt-2'>";
$output .="<thead class='thead-dark'><tr><th></th>";
$output .="<th>Product ID</th>";
$output .="<th >Modal</th>";
$output .="<th >Category</th>";
$output .="<th >Quantity</th>";
$output .="<th >Reach Level</th></tr></thead><tbody>";
$i = 0;
$stock= 0;
$outstock= 0;
$totqty = 0;
while($row = $result->fetch_assoc()){
      $i++;
    $output .="<tr >";
   
    $output .="<td >".$i."</td>";
  
    $output .="<td >".$row['prod_id']."</td>";
    $output .="<td >".$row['prod_modal']."</td>";
    $output .="<td >".$row['cat_name']."</td>";
    $output .="<td >".$row['prod_qty']."</td>";
    $output .="<td >".$row['prod_rlevel']."</td>";
    $output .="</tr>";
    $totqty = $totqty +$row['prod_qty'];
    if($row['prod_qty']=="0"){
        $stock++;
    }else{
        $outstock++;
    }
}



$output .="</tbody>";
$output .="</table>";


$output .="</div>";
$output .="";
$output .= "<p class='py-2'> No of Total Products In Stock : ".$i."<br>";
$output .= " No of In Low : ".$outstock."<br>";
$output .= " No of out of stock : ".$stock."</p>";
$output .="No of Total Items: ".$totqty."";

// Pdf Footer Start ---------------------
/*$output .= ;
$output .="</p>" ;*/
$output .= "<footer style='position: fixed; bottom: -30px; left: 0px; right: 0px;  height: 85px;  '>
<p class='text-left fixed-bottom ' >Print By : ".$oper." </p>
<p class='text-right fixed-bottom ' >Print Date : ".date("Y-m-d")." /  ".date("h:i:sa")."</p>
<img src='nesmo footer.jpg'class='w-100' style='padding-bottom: 25px;'>
</footer>";
// Pdf Footer End ---------------------
$output .= "";



$dompdf->loadHtml($output);
//setup papaer size

$dompdf->setPaper('A4','portrait');
//render the html as PDF
$dompdf->render();


//output the generated Pdf
$dompdf->stream("Nesmo product",array("Attachment"=>0));

?>