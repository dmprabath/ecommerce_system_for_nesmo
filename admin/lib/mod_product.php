<?php
/*Password should contain atleast six characters with one number, special character and a capital letter*/
 require_once("config.php"); 
 if(isset($_GET["type"])){
    $type = $_GET["type"];
     $type();

}
     $uploadDir = 'picture/';
    $response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
    




 function getProdId(){
     $dbobj = DB::connect();
     $sql = "SELECT prod_id FROM tbl_products ORDER BY prod_id DESC LIMIT 1;"  ;
     $result = $dbobj->query($sql);

     if($dbobj->errno){
         echo("SQL Error : ".$dbobj->error );
         exit;
     }
     $nor = $result->num_rows;

     if($nor == 0){
         $newid = "PRO00001";
     }else{
         $rec = $result->fetch_assoc();
         $lastid =$rec["prod_id"];
         $num = substr($lastid,3);
         $num++;
         $newid="PRO".str_pad($num,5,"0",STR_PAD_LEFT);
     }
     $dbobj->close();
     $newid = str_replace(' ', '', $newid);
    return $newid;
 }

 function viewProduct(){

    $table =<<<EOT
	( SELECT prod_id,prod_img,prod_name,prod_modal,prod_color,prod_qty,cat.cat_id,
	cat_name FROM tbl_products pro JOIN tbl_category cat ON pro.cat_id = 
	cat.cat_id 
		) temp
EOT;

    $primaryKey ='prod_id';

    $columns = array(

        array( 'db' => 'prod_id', 'dt'=> 0),
        array( 'db' => 'prod_img', 'dt'=> 1),
        array( 'db' => 'prod_name', 'dt'=> 2),
        array( 'db' => 'prod_modal', 'dt'=> 3),
        array( 'db' => 'prod_qty', 'dt'=> 4),
        array( 'db' => 'cat_name', 'dt'=> 5),
        array( 'db' => 'cat_id', 'dt'=> 6),



    );
    require_once('config.php');
    $host = Config::$host ; 
    $user = Config::$db_uname ;
    $pass = Config::$db_upass ;
    $db = Config::$db_name ;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null )
    );
 }

function viewProdProfile(){

    $prodid = $_POST["prodid"];
    $dbobj = DB::connect();

    $sql = "SELECT * FROM tbl_products pro LEFT OUTER JOIN tbl_prod_desc des ON pro.desc_id = des.desc_id JOIN tbl_category cat ON pro.cat_id = cat.cat_id JOIN tbl_prod_warr warr ON des.warr_id=warr.id where prod_id='$prodid'";

    $result= $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }
    $output ="";
    $rec = $result->fetch_assoc();
    $output .="<div class='col-lg-6 col-sm-10'>
                    <div class='form-group' id='image'>
                        <img src='../resources/img/products/".$rec['prod_img']."' id='imageEmp' alt='' width='200px' >
                    </div>
                    <div class='form-group' >
                        <input type='file' class='form-control-file d-none' id='prod_img' name='prod_img' >
                    </div>";

    $output .="  <div class='form-group row  '>
                  <label class='col-form-label-sm col-3'>Product name</label>:
                  <div class='  col'>
                    <input type='text' disabled class=' emp-select  form-control bg-transparent  form-control-plaintext form-control-sm' name='prod_name' id='prod_name' value='".$rec['prod_name']."'>
                  </div>
                </div>";

    $output.="   <div class='form-group row  '>
                  <label class='col-form-label-sm col-3'>Product modal</label>:
                  <div class='  col'>
                    <input type='text' disabled  class=' emp-select form-control bg-transparent form-control-plaintext form-control-sm ' name='prod_modal' id='prod_modal' value='".$rec['prod_modal']."'>
                   </div>
                </div>";

    $output.="   <div class='form-group row  '>
                  <label class='col-form-label-sm col-3'>Product color</label>:
                  <div class='  col'>
                    <input type='text' disabled class=' emp-select form-control bg-transparent form-control-plaintext form-control-sm' name='prod_color' id='prod_color' value='".$rec['prod_color']."'>
                  </div>
                </div>";

    $output.="   <div class='form-group row'>
                   <label for='staticEmail' class=' col-3 col-sm-3  col-form-label-sm'>Category</label>:
                   <div >
                     <input  class='col  form-control-plaintext  custom-select-sm'  value='".$rec['cat_name']."'>
                     <input type='hidden'  class='col  form-control-plaintext  custom-select-sm' id='prod_cat' name='prod_cat' value='".$rec['cat_id']."'>
                   </div>
                </div>";

    $output.="   <div class=' form-group row '>
                   <label class='col-form-label-sm col-3'>Selling price</label>:
                   <div class=' col'>
                       <input type='text' disabled class='emp-select form-control bg-transparent form-control-plaintext form-control-sm' name='prod_sprice' id='prod_sprice' value='".$rec['prod_price']."'>
                   </div>
                </div>";

    $output.="   <div class=' form-group row '>
                  <label class='col-form-label-sm col-3'>Special price</label>:
                  <div class=' col'>
                  <input type='text' disabled class='emp-select form-control bg-transparent form-control-plaintext form-control-sm' name='prod_dprice' id='prod_dprice' value='".$rec['prod_dprice']."'>
                  </div>
                </div>";

    $output.="   <div class=' row'>
                  <label class='col-form-label-sm col-3' for='prod_desc'>Discription </label>:
                  <div class='form-group col'>
                  <textarea disabled class='form-control-plaintext bg-transparent emp-select form-control text-left' name='prod_desc' id='prod_desc' rows='3'>".$rec['prod_desc']."
                  </textarea>
                  </div>
                </div>                    
            </div>";

    $output.="<div class='col-lg-6 col-sm-10 '>
                <div class='row '>
                  <label class='col-form-label-sm col-3'>Product ID </label>:
                  <div class='form-group col'>
                  <input type='text'  readonly class='form-control-plaintext bg-transparent form-control-sm  ' name='prod_id' id='prod_id' value='".$rec['prod_id']."'>
                  </div>                        
                </div>";

    $output .=" <div class=' row'>
                  <label class='col-form-label-sm col-3'>Quantity </label>:
                  <div class='form-group col'>
                    <input type='text' disabled class='form-control bg-transparent form-control-plaintext form-control-sm  ' name='prod_qty' id='prod_qty' value='".$rec['prod_qty']."'>
                  </div>
                </div>";

    $output.="   <div class=' row'>
                  <label class='col-form-label-sm col-3'>Reach Level </label>:
                  <div class='form-group col'>
                    <input type='text' disabled class='emp-select bg-transparent form-control-plaintext form-control form-control-sm' name='prod_rlevel' id='prod_rlevel' value='".$rec['prod_rlevel']."'>
                  </div>
                </div>";

if($rec['capacity'] !=""){
    $output.="  <div class=' row'>
                  <label class='col-form-label-sm col-3'>Capacity </label>:
                  <div class='form-group col'>
                    <input type='text' disabled class='emp-select bg-transparent form-control form-control-plaintext form-control-sm' name='prod_capacity' id='prod_capacity' value='".$rec['capacity']."'>
                  </div>
                </div>";
}
if($rec['tank_capacity'] !=""){
    $output.="  <div class=' row'>
                  <label class='col-form-label-sm col-3'>Tank Capacity </label>:
                  <div class='form-group col'>
                    <input type='text' disabled class='emp-select bg-transparent form-control form-control-plaintext form-control-sm' name='tank_capacity' id='tank_capacity' value='".$rec['tank_capacity']."'>
                  </div>
                </div>";
}

if($rec['voltage'] !=""){
    $output.="  <div class=' row'>
                  <label class='col-form-label-sm col-3'>Voltage </label>:
                  <div class='form-group col'>
                    <input type='text' disabled class='emp-select form-control bg-transparent form-control-plaintext form-control-sm' name='prod_voltage' id='prod_voltage' value='".$rec['voltage']."'>
                  </div>
                </div>";
}

if($rec['power'] !=""){
    $output.="  <div class=' row'>
                  <label class='col-form-label-sm col-3'>Power </label>:
                  <div class='form-group col'>
                  <input type='text' disabled class='emp-select form-control bg-transparent form-control-plaintext form-control-sm' name='prod_power' id='prod_power' value='".$rec['power']."'>
                  </div>
                </div>";
}

if($rec['material'] !=""){
    $output.="  <div class=' row'>
                  <label class='col-form-label-sm col-3'> Material </label>:
                  <div class='form-group col'>
                    <input type='text' disabled class='emp-select form-control bg-transparent form-control-plaintext form-control-sm' name='prod_material' id='prod_material' value='".$rec['material']."'>
                  </div>
                </div>";
}

if($rec['dimension'] !=""){
    $output.="  <div class=' row'>
                  <label class='col-form-label-sm col-3'> Dimension </label>:
                  <div class='form-group col'>
                  <input type='text' disabled class='emp-select form-control bg-transparent form-control-plaintext form-control-sm' name='prod_dimension' id='prod_dimension' value='".$rec['dimension']."'>
                  </div>
                </div>";
}

if($rec['contains']!=""){
    $output.="  <div class=' row'>
                  <label class='col-form-label-sm col-3'> Contains </label>:
                  <div class='form-group col'>
                    <input type='text' disabled class='emp-select form-control bg-transparent form-control-plaintext form-control-sm' name='prod_contains' id='prod_contains' value='".$rec['contains']."'>
                  </div>
                </div>";
}
    $output.="  <div class=' row'>
                  <label class='col-form-label-sm col-3'> Warranty Type </label>:
                  <div class='form-group col-7'>";
                    
    
    $sql_warr = "SELECT * FROM tbl_prod_warr ORDER BY FIELD(warrenty,'".$rec['warrenty']."')DESC";
    $result_warr = $dbobj->query($sql_warr);
    $output.="<select disabled class='custom-select emp-select bg-transparent custom-select-sm' name='prod_warr' id='prod_warr' value='".$rec['warrenty']."' >";
    while($row =$result_warr->fetch_assoc()){
        $output .="<option value='".$row['id']."'>".$row['warrenty']."</option>";
    }

    $output.="</select>";
                    
    $output .="   </div>
                </div>
              </div>";

    echo($output);

    $dbobj->close();


}


 function addNewProd(){
     $prod_id = $_POST["prod_id"];
     $prod_name = $_POST["prod_name"];
     $prod_modal = $_POST["prod_modal"];
     $prod_color = $_POST["prod_color"];
     $cat_id =  $_POST["prod_cat"];
     
     $prod_price = $_POST["prod_price"];
     $discount_price = $_POST["prod_dprice"];
     $prod_desc = $_POST["prod_desc"];

     $prod_rlevel = $_POST["prod_rlevel"];
     $prod_capacity = $_POST["prod_capacity"];
     $prod_voltage = $_POST["prod_voltage"];
     $prod_power = $_POST["prod_power"];
     $prod_tank = $_POST["prod_tank"];
     $prod_material = $_POST["prod_material"];
     $prod_dimension = $_POST["prod_dimension"];
     $prod_contains = $_POST["prod_contains"];
     $warranty_type = $_POST["prod_warr"];

     

     //product stages

     if(isset($_POST['pp'])){
         $pp="1";
     }else{
         $pp="0";
     }
     if(isset($_POST['cto'])){
         $cto="1";
     }else{
         $cto="0";
     }
     if(isset($_POST['post'])){
         $post="1";
     }else{
         $post="0";
     }
     if(isset($_POST['ro'])){
         $ro="1";
     }else{
         $ro="0";
     }
     if(isset($_POST['udf'])){
         $udf="1";
     }else{
         $udf="0";
     } 
     if(isset($_POST['mineral'])){
         $mineral="1";
     }else{
         $mineral="0";
     }

/**/

     $img_name = $_FILES['prod_img']['name'];
     $img_size = $_FILES['prod_img']['size'];
     $img_type = $_FILES['prod_img']['type'];
     $img_tmp_name = $_FILES['prod_img']['tmp_name'];
     #substr display part after specific point
     #strrpos - finds the position numbers of the last occurrence
     $ext = substr($img_name, strrpos($img_name, "."));
     # $ext is file extenstion
     # convert to lower case
     $txt = strtolower($ext);

     if($img_name== ""){
         echo (",Please Select the image");
         exit;
     }
     if($img_size>2097152 || $img_size==0){
         echo("0,Image size must be less than 2MB");
         exit;
     }
     if($ext!=".jpg" && $ext!=".png" && $ext!=".gif" & $ext!=".JPG"){
         echo("0,Image file size should be either jpg png or gif");
         exit;
     }
     $cat_path = "../../resources/img/products/$cat_id";
     $prod_path = "../../resources/img/products/$cat_id/$prod_id";
     if(!file_exists($cat_path)){
         mkdir($cat_path);
     }
     if(!file_exists($prod_path)){
         mkdir($prod_path);
     }

     $fname = $cat_id."_".$prod_id."_".time().$ext;
     $fpath = $prod_path."/".$fname;
     $imgpath = $cat_id."/".$prod_id."/".$fname;

     if(move_uploaded_file($img_tmp_name, $fpath)){
         $dbobj = DB::connect();
         $sql = "INSERT INTO tbl_products (prod_id,prod_name,prod_modal,prod_color,desc_id,prod_price ,prod_dprice,prod_rlevel,prod_img,cat_id) VALUES('$prod_id','$prod_name','$prod_modal','$prod_color','$prod_id','$prod_price', '$discount_price','$prod_rlevel','$imgpath','$cat_id');";


         $stmt = $dbobj->prepare($sql);
         if(!$stmt->execute()){
             unlink($fpath);
             echo("0,SQL Error, Please try again:".$stmt->error);
         }else{
             $sql2 = "INSERT INTO tbl_prod_desc(desc_id,prod_desc,capacity,voltage,power,tank_capacity,material,dimension,contains,stage_pp,stage_cto,stage_post,stage_ro,stage_udf,stage_min,warr_id) VALUES('$prod_id','$prod_desc','$prod_capacity','$prod_voltage','$prod_power','$prod_tank' ,'$prod_material','$prod_dimension','$prod_contains','$pp','$cto','$post','$ro','$udf','$mineral','$warranty_type');";

             $stmt2 = $dbobj->prepare($sql2);

             if (!$stmt2->execute()){
                 echo("0,SQL Error, Please try again:".$stmt2->error);
             }else{
                 echo ("1,Successfully Saved!");
             }
            $stmt2->close();

         }
         $stmt->close();
         $dbobj->close();
     }else{
         echo("0,Image Uploading Error");
     }
 }


function addNewItem(){
    $cat_id =  $_POST["prod_cat"];
     $prod_id = $_POST["prod_id"];
     
     $prod_name = $_POST["prod_name"];
     $prod_modal = $_POST["prod_modal"];
     $prod_desc = $_POST["prod_desc"];
     $prod_color = $_POST["prod_color"];
     $discount_price = $_POST["prod_dprice"];
     $prod_rlevel = $_POST["prod_rlevel"];     
     $warranty_type = $_POST["prod_warr"];
     //product stages

     

     $img_name = $_FILES['prod_img']['name'];
     $img_size = $_FILES['prod_img']['size'];
     $img_type = $_FILES['prod_img']['type'];
     $img_tmp_name = $_FILES['prod_img']['tmp_name'];
     #substr display part after specific point
     #strrpos - finds the position numbers of the last occurrence
     $ext = substr($img_name, strrpos($img_name, "."));
     # $ext is file extenstion
     # convert to lower case
     $txt = strtolower($ext);

     if($img_name== ""){
         echo ("0,Please Select the image");
         exit;
     }

     $cat_path = "../../resources/img/products/$cat_id";
     $prod_path = "../../resources/img/products/$cat_id/$prod_id";
     if(!file_exists($cat_path)){
         mkdir($cat_path);
     }
     if(!file_exists($prod_path)){
         mkdir($prod_path);
     }

     $fname = $cat_id."_".$prod_id."_".time().$ext;
     $fpath = $prod_path."/".$fname;
     $imgpath = $cat_id."/".$prod_id."/".$fname;

     if(move_uploaded_file($img_tmp_name, $fpath)){
         $dbobj = DB::connect();
         $sql = "INSERT INTO tbl_products (prod_id,prod_name,prod_modal,prod_color,desc_id,prod_dprice,prod_rlevel,prod_img,cat_id) VALUES('$prod_id','$prod_name','$prod_modal','$prod_color','$prod_id', '$discount_price','$prod_rlevel','$imgpath','$cat_id');";


         $stmt = $dbobj->prepare($sql);
         if(!$stmt->execute()){
             unlink($fpath);
             echo("0,SQL Error, Please try again:".$stmt->error);
         }else{
             $sql2 = "INSERT INTO tbl_prod_desc(desc_id,prod_desc,warr_id) VALUES('$prod_id','$prod_desc','$warranty_type');";

             $stmt2 = $dbobj->prepare($sql2);

             if (!$stmt2->execute()){
                 echo("0,SQL Error, Please try again:".$stmt2->error);
             }else{
                 echo ("1,Product Added Successfully!");
             }
            $stmt2->close();

         }
         $stmt->close();
         $dbobj->close();
     }else{
         echo("0,Image Uploading Error");
     }
 }

 function updateProduct(){
     $prod_id = $_POST['prod_id'];
     $prod_name = $_POST['prod_name'];
     $prod_modal = $_POST['prod_modal'];
     $prod_color = $_POST['prod_color'];     
     $prod_sprice = $_POST['prod_sprice'];
     $prod_dprice = $_POST['prod_dprice'];
     $prod_desc = $_POST['prod_desc'];
     $prod_rlevel = $_POST['prod_rlevel'];
     $cat_id  =$_POST['prod_cat'];


     if(isset($_POST['prod_capacity'])){
        $prod_capacity = $_POST['prod_capacity'];
     }else{
        $prod_capacity="";
     }
     
     if(isset($_POST['tank_capacity'])){
        $tank_capacity = $_POST['tank_capacity'];
     }else{
        $tank_capacity="";
     }
     if(isset($_POST['prod_voltage'])){
         $prod_voltage = $_POST['prod_voltage'];
     }else{
        $prod_voltage ="";
     }
     if(isset($_POST['prod_power'])){
         $prod_power = $_POST['prod_power'];
     }else{
        $prod_power ="";
     }
     if(isset($_POST['prod_material'])){
         $prod_material = $_POST['prod_material'];
     }else{
        $prod_material="";
     }
     if(isset($_POST['prod_dimension'])){
         $prod_dimension = $_POST['prod_dimension'];
     }else{
        $prod_dimension="";
     }
     if(isset($_POST['prod_contains'])){
         $prod_contains = $_POST['prod_contains'];
     }else{
        $prod_contains="";
     }

     $prod_warr = $_POST['prod_warr'];

     if($_FILES['prod_img']['name'] !=""){
        $img_name = $_FILES['prod_img']['name'];
         $img_size = $_FILES['prod_img']['size'];
         $img_type = $_FILES['prod_img']['type'];
         $img_tmp_name = $_FILES['prod_img']['tmp_name'];
         #substr display part after specific point
         #strrpos - finds the position numbers of the last occurrence
         $ext = substr($img_name, strrpos($img_name, "."));
         # $ext is file extenstion
         # convert to lower case
         $txt = strtolower($ext);

         if($img_name== ""){
             echo (",Please Select the image");
             exit;
         }
         if($img_size>2097152 || $img_size==0){
             echo("0,Image size must be less than 2MB");
             exit;
         }
         if($ext!=".jpg" && $ext!=".png" && $ext!=".gif"){
             echo("0,Image file size should be either jpg png or gif");
             exit;
         }
         $cat_path = "../../resources/img/products/$cat_id";
         $prod_path = "../../resources/img/products/$cat_id/$prod_id";
         if(!file_exists($cat_path)){
             mkdir($cat_path);
         }
         if(!file_exists($prod_path)){
             mkdir($prod_path);
         }

         $fname = $cat_id."_".$prod_id."_".time().$ext;
         $fpath = $prod_path."/".$fname;
         $imgpath = $cat_id."/".$prod_id."/".$fname;

         if(move_uploaded_file($img_tmp_name, $fpath)){
             $dbobj = DB::connect();
                 $sql = "UPDATE tbl_products SET prod_name ='$prod_name',
                 prod_modal='$prod_modal',prod_color='$prod_color',
                 desc_id='$prod_id',prod_price='$prod_sprice',
                 prod_dprice='$prod_dprice',
                 prod_rlevel='$prod_rlevel',
                 prod_img = '$imgpath'
                 WHERE prod_id ='$prod_id'";

                 $stmt= $dbobj->prepare($sql);
                 if(!$stmt->execute()){
                     echo("0,SQL Error, Please try again:".$stmt->error);
                     exit;

                 }else{
                     $sql_details = "UPDATE tbl_prod_desc SET prod_desc=?,
             capacity=?,voltage=?,
             power=?, tank_capacity=?, material=?,
             dimension=?,contains=?,
             warr_id=? WHERE desc_id=?";
             $stmt_details = $dbobj->prepare($sql_details);
             $stmt_details->bind_param("ssssssssss",$prod_desc,$prod_capacity,$prod_voltage,$prod_power,$tank_capacity,$prod_material,$prod_dimension,$prod_contains,$prod_warr,$prod_id);
                     
                     if(!$stmt_details->execute()){
                         echo("0,Details SQL Error, Please try again:".$stmt->error);
                         exit;

                     }else{
                         echo("1,Product Successfully Updated");
                     }

                 }
            }else{
                echo("0,Image Not Uploaded");
            }
     }else{
       $dbobj = DB::connect();
         $sql = "UPDATE tbl_products SET prod_name ='$prod_name',
         prod_modal='$prod_modal',prod_color='$prod_color',
         desc_id='$prod_id',prod_price='$prod_sprice',
         prod_dprice='$prod_dprice',
         prod_rlevel='$prod_rlevel' 
         WHERE prod_id ='$prod_id'";

         $stmt= $dbobj->prepare($sql);
         if(!$stmt->execute()){
             echo("0,SQL Error, Please try again:".$stmt->error);
             exit;

         }else{
             $sql_details = "UPDATE tbl_prod_desc SET prod_desc=?,
             capacity=?,voltage=?,
             power=?, tank_capacity=?, material=?,
             dimension=?,contains=?,
             warr_id=? WHERE desc_id=?";
             $stmt_details = $dbobj->prepare($sql_details);
             $stmt_details->bind_param("ssssssssss",$prod_desc,$prod_capacity,$prod_voltage,$prod_power,$tank_capacity,$prod_material,$prod_dimension,$prod_contains,$prod_warr,$prod_id);
             
             if(!$stmt_details->execute()){
                 echo("0,Details SQL Error, Please try again:".$stmt->error);
                 exit;

             }else{
                 echo("1,Product Successfully Updated");
             }

         }

     }     
     $stmt->close();
     $dbobj->close();
 }



 function addImages(){
     $prod_id = $_POST['prod_id'];
     $cat_id = $_POST['cat_id'];

     $img_name = $_FILES['prod_img']['name'];
     $img_size = $_FILES['prod_img']['size'];
     $img_type = $_FILES['prod_img']['type'];
     $img_tmp_name = $_FILES['prod_img']['tmp_name'];

     if($img_name== ""){
         echo (",Please Select the image");
         exit;
     }
     /*if($img_size>10485700 || $img_size==0){
         echo("0,Image size must be less than 2MB");
         exit;
     }*/




     $dbobj = DB::connect();
     $rows = count($_FILES['prod_img']['name']);
     $output ="";
     for($i=0; $i<$rows; $i++ ){
         $ext = substr($img_name[$i], strrpos($img_name[$i], "."));
         # $ext is file extenstion
         # convert to lower case
         $txt = strtolower($ext);
         $cat_path = "../../resources/img/products/$cat_id";
         $prod_path = "../../resources/img/products/$cat_id/$prod_id";
         if(!file_exists($cat_path)){
             mkdir($cat_path);
         }
         if(!file_exists($prod_path)){
             mkdir($prod_path);
         }
         $fname[$i] = $cat_id."_".$prod_id."_".time()."_".$i.$ext;
         $fpath[$i] = $prod_path."/".$fname[$i];
         $imgpath[$i] = $cat_id."/".$prod_id."/".$fname[$i];
         if(move_uploaded_file($img_tmp_name[$i], $fpath[$i])){

             $sql_Image = "INSERT INTO tbl_prod_img (prod_id,prod_image) VALUES (?,?)";

             $stmt_image = $dbobj->prepare($sql_Image);
             $stmt_image->bind_param("ss", $prod_id, $imgpath[$i]);
             if (!$stmt_image->execute()) {
                 $output .=" Batch SQL Error: " . $stmt_image->error;
                 exit;
             }
         }else{
             $output .= "0,Image not Upload";
         }

         $stmt_image->close();
     }
     $output .= "1,Image Upload Successfully";
     echo ($output);
     $dbobj->close();
 }


        // view Products ALL Images
 function viewImages(){
     $prodid = $_POST["prodid"];
     $dbobj = DB::connect();
     $sql = "SELECT prod_image FROM tbl_prod_img WHERE prod_id='$prodid'";
     $result = $dbobj->query($sql);
     if ($dbobj->errno) {
         echo("SQL Error: " . $dbobj->error);
         exit;
     }
     $output = "";
     if($result->num_rows==""){
         $output = "<h4 class='text-warning text-center'>No Other Images</h4>";
     }else{
         while ($rec = $result->fetch_assoc()) {
             $output .="<div class='col-4 oimage_box'>";
             $output .="<img src='../resources/img/products/".$rec['prod_image']."' class='w-100 other_img' >";
             $output .="<span class='img_rem_btn' title='remove' id='".$rec['prod_image']." ".$prodid."'><i class='fas fa-1x fa-times'></i></span>";

             /*$output .="<span class='overflow-auto position-fixed text-danger ' title='remove' id='".$rec['prod_image']." ".$prodid."'><i class='fas fa-1x fa-times'></i></span>";*/
             $output .="</div>";

         }
     }

     echo($output);
     $dbobj->close();
 }
 function removeImages(){
     $prodid = $_POST['prodid'];
     $imagename = $_POST['imagename'];
     $dbobj = DB::connect();
     $sql = "DELETE FROM tbl_prod_img WHERE prod_image='$imagename';";
     $result = $dbobj->prepare($sql);
     if ($dbobj->errno) {
         echo("SQL Error: " . $dbobj->error);
         exit;
     }
     if(!$result->execute()){
         echo ("0,Image not removed");
     }else{
         echo ("1,Image Successfully Removed");
     }
     $dbobj->close();

 }

 /* ------------------------- Product Discount Handdling  ------------------------*/
 function viewProdDiscount(){

    $table =<<<EOT
    ( SELECT prod_img,prod_id,prod_name,prod_modal,prod_price,prod_dprice,cat_id FROM tbl_products
        ) temp
EOT;

    $primaryKey ='prod_id';

    $columns = array(

        array( 'db' => 'prod_img', 'dt'=> 0),
        array( 'db' => 'prod_id', 'dt'=> 1),
        array( 'db' => 'prod_name', 'dt'=> 2),
        array( 'db' => 'prod_modal', 'dt'=> 3),
        array( 'db' => 'prod_price', 'dt'=> 4),
        array( 'db' => 'prod_dprice', 'dt'=> 5),
        array( 'db' => 'cat_id', 'dt'=> 6)


    );
    require_once('config.php');
    $host = Config::$host ; 
    $user = Config::$db_uname ;
    $pass = Config::$db_upass ;
    $db = Config::$db_name ;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null )
    );
 }

function changePrice(){
    $prod_id = $_POST["prod_id"];
    $prod_price = $_POST["prod_nprice"];

    $dbobj = DB::connect();
    $sql = "UPDATE tbl_products SET prod_price= '$prod_price' WHERE prod_id = '$prod_id'";

    $stmt = $dbobj->prepare($sql);

    if (!$stmt->execute()){
        echo ("0,Not Updated Try again later");
    }else{
        echo ("1,Successfully Updatated");
    }
    $stmt->close();
    $dbobj->close();

}

function changeDiscount(){
    $prod_id = $_POST["prod_oid"];
    $prod_dprice = $_POST["prod_dprice"];

    $dbobj = DB::connect();
    $sql = "UPDATE tbl_products SET prod_dprice= '$prod_dprice' WHERE prod_id = '$prod_id'";

    $stmt = $dbobj->prepare($sql);

    if (!$stmt->execute()){
        echo ("0,Not Updated Try again later");
    }else{
        echo ("1,Successfully Updatated");
    }
    $stmt->close();
    $dbobj->close();

}


?>