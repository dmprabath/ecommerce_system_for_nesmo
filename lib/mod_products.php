<?php require("config.php");
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type();
}

                           /*   ------------------------- Shop page---------------------- */


/*   ----------Products in stock---------------------- */
function getProductBox(){
    if(!isset($cat)){
        $cat = $_POST['cat'];
    } 
    $dbobj = DB::connect();
    if($cat == "0"){  // default products box
        $sql = "SELECT pro.*,bat.*,cat_name FROM tbl_products pro INNER JOIN tbl_batch bat ON bat.bat_id =( SELECT b.bat_id FROM tbl_batch b WHERE pro.prod_id = b.prod_id AND b.bat_status='1' ORDER BY b.bat_id ASC LIMIT 1) JOIN tbl_category cat ON cat.cat_id= pro.cat_id  ORDER BY bat.bat_id "; 
        // out of stock
        $sql_out  = "SELECT pro.*,cat_name FROM tbl_products pro JOIN tbl_category cat ON cat.cat_id = pro.cat_id  WHERE pro.prod_qty= '0'"; 
        

    }else{ // according to category
        $sql = "SELECT pro.*,bat.*,cat_name FROM tbl_products pro INNER JOIN tbl_batch bat ON bat.bat_id =( SELECT b.bat_id FROM tbl_batch b WHERE pro.prod_id = b.prod_id AND b.bat_status='1' ORDER BY b.bat_id ASC LIMIT 1) JOIN tbl_category cat ON cat.cat_id= pro.cat_id  WHERE cat_name='$cat' ORDER BY bat.bat_id  ";

        $sql_out  = "SELECT pro.*,cat_name FROM tbl_products pro JOIN tbl_category cat ON cat.cat_id = pro.cat_id  WHERE pro.prod_qty= '0' AND cat_name='$cat'"; 
    }

    $result = $dbobj->query($sql);
   
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }



    $output ="";
    while($rec= $result->fetch_assoc()){
        $output .="<div class='col-lg-3 col-sm-5 my-2 ' >";
        $output .= "<a href='".$rec['cat_name'].".php?id=".$rec['prod_id']."' class='text-decoration-none ' > <div class='card prod-box  h-100 '  >";
        $output .= " <div style='height: 210px'  >";
        $output .= " <input type='hidden' name='prod_id' value='".$rec['prod_id']."' >";
        $output .= "<img name='prod_img' src='resources/img/products/".$rec['prod_img']."' class='p-2 h-100    '  >";
        $output .="</div>";
        $output .= " <h5 class='m-auto text-secondary text-center ' name='prod_name'>". $rec['prod_name']." </h5>";
        $output .= "<div >";
        if($rec['prod_dprice']=="0.00"){
            $output .= "<div class=' text-center text-success  h5 px-4' name='prod_price'>Rs.".number_format($rec['prod_price'],2)."</div>";
            
        }else{
            $output .="<div class='justify-content-center'>";
            $output .= "<div class='text-center text-muted  h5 px-4' name='prod_price'><del>Rs.".number_format($rec['bat_sprice'],2)."</del></div>";
            $output .= "<div class='text-center text-danger  h5 '>Rs.".number_format($rec['prod_dprice'],2)."</div>";
            
         
            $output .="</div>";

        }
        $output .= "<div class='text-center text-white bg-primary  h5 '> View Details</div>";
        $output .= "</div>";
        $output .= "</div> </a>";
        $output .= "</div>";
    }


        /*   ----------Products Not in stock---------------------- */


    $result_out = $dbobj->query($sql_out);

    $output_out ="";
    while($rec_out= $result_out->fetch_assoc()){
        $output_out .="<div class='col-lg-3 col-sm-5 my-2 ' >";
        $output_out .= "<a href='".$rec_out['cat_name'].".php?id=".$rec_out['prod_id']."' class='text-decoration-none ' > <div class='card prod-box h-100 '  >";
        $output_out .= " <div style='height: 210px' class='text-center' >";
        $output_out .= " <input type='hidden' name='prod_id' value='".$rec_out['prod_id']."' >";
        $output_out .= "<img name='prod_img' src='resources/img/products/".$rec_out['prod_img']."' class='p-2 h-100 w-100 text-center'  style='verticl-align:middle' >";
        $output_out .="</div>";
        $output_out .= " <h5 class='m-auto text-secondary ' name='prod_name'>". $rec_out['prod_name']." </h5>";
        $output_out .= "<div >";
        if($rec_out['prod_dprice']=="0.00"){
            $output_out .= "<div class=' text-center text-success  h5 px-4' name='prod_price'>Rs.".number_format($rec_out['prod_price'],2)."</div>";
        }else{
            $output_out .="<div class='justify-content-center'>";
            $output_out .= "<div class='text-center text-muted  h5 px-4' name='prod_price'><del>Rs.".number_format($rec_out['prod_price'],2)."</del></div>";
            $output_out .= "<div class='text-center text-danger  h5 '>Rs.".number_format($rec_out['prod_dprice'],2)."</div>";
            
         
            $output_out .="</div>";

        }
        $output_out .= "<div class='text-center text-white bg-primary  h5 '> View Details</div>";
        $output_out .= "</div>";
        $output_out .= "</div> </a>";
        $output_out .= "</div>";
    }
    echo ($output.$output_out);
    $dbobj->close();
}






/*--------------Retrive product's details for single product page ----------------*/
function getProductDetails(){

     $prodid = $_POST['prodid'];

    $dbobj = DB::connect();
    // stock or not
    $sql = "SELECT prod_qty FROM tbl_products pro WHERE pro.prod_id='$prodid'";
    $result = $dbobj->query($sql);
    $rec= $result->fetch_assoc();

    if($rec['prod_qty']=="0"){  
        //out of stock
         $sql_details = "SELECT * FROM tbl_products pro JOIN tbl_prod_desc des ON des.desc_id = pro.prod_id JOIN tbl_category cat ON cat.cat_id= pro.cat_id JOIN tbl_prod_warr warr ON des.warr_id= warr.id WHERE pro.prod_id='$prodid' ";
    }else{
        //in stock
        $sql_details = "SELECT * FROM tbl_products pro JOIN tbl_prod_desc des ON des.desc_id = pro.prod_id INNER JOIN tbl_batch bat ON bat.bat_id =( SELECT b.bat_id FROM tbl_batch b WHERE pro.prod_id = b.prod_id AND b.bat_status='1' ORDER BY b.bat_id ASC LIMIT 1) JOIN tbl_category cat ON cat.cat_id= pro.cat_id JOIN tbl_prod_warr warr ON des.warr_id= warr.id WHERE pro.prod_id='$prodid'";
    }

    $result_details = $dbobj->query($sql_details);
    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $rec_details = $result_details->fetch_assoc();
    echo(json_encode($rec_details));
    $dbobj->close();


}
/* ----------------Get other product images -------------- */

function getProductImage()
{
    $prod_id = $_POST["prod_id"];
    $dbobj = DB::connect();
    $sql = "SELECT cat_id, tbl_products.prod_id, image_name FROM tbl_prod_img JOIN tbl_products ON tbl_prod_img.prod_id = tbl_products.prod_id WHERE tbl_products.prod_id='$prod_id'";
    $result = $dbobj->query($sql);
    if ($dbobj->errno) {
        echo("SQL Error: " . $dbobj->error);
        exit;
    }
    $output = "";
    $i = 0;
    while ($rec = $result->fetch_assoc()) {
        $output .="<div class='carousel-item ";
        if($i =="0"){
            $output .= "active'>";
        }else{
            $output .= " '>";
        }
        $output .="<img class='d-block mx-auto w-100' src='resources/img/products/".$rec['image_name']."'>";
      
        $output .= "</div>";
        $i++;
    }
    echo($output);
    $dbobj->close();
}
                    /*   ----------------- for add product in information  page -----------------*/



 /*   ----------------- Product Search -----------------*/

function searchProduct(){
    $searchKey = $_POST['searchKey'];

    $dbobj = DB::connect();
    
    $sql = "SELECT pro.*,bat.*,cat_name FROM tbl_products pro INNER JOIN tbl_batch bat ON bat.bat_id =( SELECT b.bat_id FROM tbl_batch b WHERE pro.prod_id = b.prod_id AND b.bat_status='1' ORDER BY b.bat_id ASC LIMIT 1) JOIN tbl_category cat ON cat.cat_id= pro.cat_id  WHERE prod_name LIKE '%$searchKey%' ORDER BY bat.bat_id  ";

    $sql_out  = "SELECT pro.*,cat_name FROM tbl_products pro JOIN tbl_category cat ON cat.cat_id = pro.cat_id  WHERE pro.prod_qty= '0' AND prod_name LIKE '%$searchKey%'"; 
    

    $result = $dbobj->query($sql);
   
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }



    $output ="";
    while($rec= $result->fetch_assoc()){
        $output .="<div class='col-lg-3 col-sm-5 my-2 ' >";
        $output .= "<a href='".$rec['cat_name'].".php?id=".$rec['prod_id']."' class='text-decoration-none ' > <div class='card prod-box  h-100 '  >";
        $output .= " <div style='height: 210px'  >";
        $output .= " <input type='hidden' name='prod_id' value='".$rec['prod_id']."' >";
        $output .= "<img name='prod_img' src='resources/img/products/".$rec['prod_img']."' class='p-2 h-100    '  >";
        $output .="</div>";
        $output .= " <h5 class='m-auto text-secondary text-center ' name='prod_name'>". $rec['prod_name']." </h5>";
        $output .= "<div >";
        if($rec['prod_dprice']=="0.00"){
            $output .= "<div class=' text-center text-success  h5 px-4' name='prod_price'>Rs.".number_format($rec['prod_price'],2)."</div>";
            
        }else{
            $output .="<div class='justify-content-center'>";
            $output .= "<div class='text-center text-muted  h5 px-4' name='prod_price'><del>Rs.".number_format($rec['bat_sprice'],2)."</del></div>";
            $output .= "<div class='text-center text-danger  h5 '>Rs.".number_format($rec['prod_dprice'],2)."</div>";
            
         
            $output .="</div>";

        }
        $output .= "<div class='text-center text-white bg-primary  h5 '> View Details</div>";
        $output .= "</div>";
        $output .= "</div> </a>";
        $output .= "</div>";
    }


        /*   ----------Products Not in stock---------------------- */


    $result_out = $dbobj->query($sql_out);

    $output_out ="";
    while($rec_out= $result_out->fetch_assoc()){
        $output_out .="<div class='col-lg-3 col-sm-5 my-2 ' >";
        $output_out .= "<a href='".$rec_out['cat_name'].".php?id=".$rec_out['prod_id']."' class='text-decoration-none ' > <div class='card prod-box h-100 '  >";
        $output_out .= " <div style='height: 210px' class='text-center' >";
        $output_out .= " <input type='hidden' name='prod_id' value='".$rec_out['prod_id']."' >";
        $output_out .= "<img name='prod_img' src='resources/img/products/".$rec_out['prod_img']."' class='p-2 h-100 w-100 text-center'  style='verticl-align:middle' >";
        $output_out .="</div>";
        $output_out .= " <h5 class='m-auto text-secondary ' name='prod_name'>". $rec_out['prod_name']." </h5>";
        $output_out .= "<div >";
        if($rec_out['prod_dprice']=="0.00"){
            $output_out .= "<div class=' text-center text-success  h5 px-4' name='prod_price'>Rs.".number_format($rec_out['prod_price'],2)."</div>";
        }else{
            $output_out .="<div class='justify-content-center'>";
            $output_out .= "<div class='text-center text-muted  h5 px-4' name='prod_price'><del>Rs.".number_format($rec_out['prod_price'],2)."</del></div>";
            $output_out .= "<div class='text-center text-danger  h5 '>Rs.".number_format($rec_out['prod_dprice'],2)."</div>";
            
         
            $output_out .="</div>";

        }
        $output_out .= "<div class='text-center text-white bg-primary  h5 '> View Details</div>";
        $output_out .= "</div>";
        $output_out .= "</div> </a>";
        $output_out .= "</div>";
    }
    echo ($output.$output_out);
    $dbobj->close();

}


?>