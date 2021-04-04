<?php

 require_once('config.php'); 
 if(isset($_GET["type"])){
    $type = $_GET["type"];
     $type();

}

/* ------------------------- Warrnty Handdling  ------------------------*/
 function viewWarrenty(){

    $table =<<<EOT
    ( SELECT warr_id,warr_date,inv_id,cus_fname,warr_claim,status FROM tbl_warrenty warr JOIN tbl_customers cus ON warr.cus_id= cus.cus_id 
        ) temp
EOT;

    $primaryKey ='warr_id';

    $columns = array(

        array( 'db' => 'warr_id', 'dt'=> 0),
        array( 'db' => 'warr_date', 'dt'=> 1),
        array( 'db' => 'inv_id', 'dt'=> 2),
        array( 'db' => 'cus_fname', 'dt'=> 3),
        array( 'db' => 'warr_claim', 'dt'=> 4),
        array( 'db' => 'status', 'dt'=> 5)


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

 function warrDetails(){
    $warrid= $_POST['warrid'];
    $dbobj =DB::connect();
    $sql = "SELECT warr.*,cus.cus_fname,cus.cus_lname FROM tbl_warrenty warr JOIN tbl_warr_prod wp ON warr.warr_id=wp.warr_id JOIN tbl_customers cus ON warr.cus_id = cus.cus_id WHERE warr.warr_id='$warrid'";
    $result = $dbobj->query($sql);
    $rec= $result->fetch_assoc();

    if($dbobj->errno){
        echo("SQL Error : ".$dbobj->error);
        exit;
    }

    $output = "";
    $output .= "<div class='col-lg-6'>
                    <div class=' form-group row '>
                        <label class='col-form-label-sm col-4'>Warrenty ID</label>:
                        <div class=' col-5'>
                            <p>".$rec['warr_id']."</p>
                        </div>
                    </div>";
    $output .="     <div class=' form-group row '>
                        <label class='col-form-label-sm col-4'>Customer Name</label>:
                        <div class=' col-5'>
                            <p>".$rec['cus_fname']." ".$rec['cus_lname'] ."</p>
                                    
                        </div>
                    </div>";

    $output .="     <div class=' form-group row '>
                        <label class='col-form-label-sm col-4'>Request Date</label>:
                        <div class=' col-5'><p>".$rec['warr_date']."</p>
                        </div>
                    </div>

                </div>";

    $output .="<div class='col-lg-6'>
                    <div class=' form-group row '>
                        <label class='col-form-label-sm col-4'>Order ID</label>:
                        <div class=' col-5'>
                            <p>".$rec['inv_id']."</p>
                        </div>
                    </div>";



        if($rec['complete_date']=='0000-00-00'){

    $output .="     <div class=' form-group row '>
                        <label class='col-form-label-sm col-4'>Complete Date</label>:
                        <div class=' col-5'>
                           <p class='text-danger'>Not Complete</p>
                        </div>
                    </div>
                    <div class=' form-group row '>
                        <label class='col-form-label-sm col-4'>Checked By</label>:
                        <div class=' col-5'><p class='text-danger '>Not Complete</p></div>
                    </div>";
        }else{
    $output .="     <div class=' form-group row '>
                        <label class='col-form-label-sm col-4'>Complete Date</label>:
                        <div class=' col-5'>
                           <p>".$rec['complete_date']."</p>
                        </div>
                    </div>
                    <div class=' form-group row '>
                        <label class='col-form-label-sm col-4'>Checked By</label>:
                        <div class=' col-5'><p>".$rec['operator']."</p></div>
                    </div>";
        }
        
    

    $output .="</div>

                        <div class='col-lg-12'>
                        <div class=' form-group row '>
                            <label class='col-form-label-sm col-2'>Status </label>:
                            <div class=' col-10'>
                                ";
               if($rec['status']=="0"){
                    $output .="<p class='text-warning'>Waiting</p>";
                                                    }else if($rec['status']=="1"){
                    $output .="<p class='text-success'>Complete</p>";
                                                    }else{
                     $output .="<p  class='text-danger'>canceled</p>";
                }


             $output .=" </div>
                        </div><div class=' form-group row '>
                            <label class='col-form-label-sm col-2'>Description </label>:
                            <div class=' col-10'>
                                <p>".$rec['description']."</p>
                            </div>
                        </div>
                            <table class='table '>
                                <thead>
                                    <tr>
                                        <td>Product ID</td>
                                        <td>Product Model</td>
                                        <td>Problem</td>
                                        <td>Solutions</td>
                                    </tr>
                                </thead>
                                <tbody>";
                                $sql_prod = "SELECT pp.*,pro.prod_modal FROM tbl_warr_prod pp JOIN tbl_products pro ON pro.prod_id = pp.prod_id WHERE warr_id='".$rec['warr_id']."'";
                                $res_prod = $dbobj->query($sql_prod);
                                while ($rpro=$res_prod->fetch_assoc()) {
                                    $output .= "<tr>
                                                    <td>".$rpro['prod_id']."</td>
                                                    <td>".$rpro['prod_modal']."</td>
                                                    <td>".$rpro['warr_probleme']."</td>
                                                    <td>".$rpro['solution']."</td></tr>";
                                                    
                                                    
                                    
                                }
                                    
    $output .= "                </tbody>
                            </table>
                            
                        </div>'";

    echo ($output);
    $dbobj->close();
 }

 function UpdateWarrenty(){
    $warrid =$_POST['uwarr_id'];
    $solution =$_POST['usolution'];
    $discrip =$_POST['udisc'];
    $operator =$_POST['op_id'];
    $date =date("Y-m-d");

    //echo($warrid." ".$solution." ".$discrip." ".$operator." ".$date);

    $dbobj = DB::connect();

    $sql ="UPDATE tbl_warr_prod SET solution='$solution' WHERE warr_id='$warrid'";

    $result = $dbobj->prepare($sql);
    if(!$result->execute()){
        echo ("0,Not Updated");
    }else{
        $sql_w ="UPDATE tbl_warrenty SET description='$discrip', operator='$operator', complete_date='$date', status='1' WHERE warr_id='$warrid'";

        $result_w = $dbobj->prepare($sql_w);
        if(!$result_w->execute()){
            echo ("0,Not Updated");
        }else{
            echo ("1,Updated Successfully");
        }
    }
    $result_w->close();
    $dbobj->close();
 }

 function confirmWarrent(){
    $warrid =$_POST['warrid'];

    $dbobj = DB::connect();

    $sql ="UPDATE tbl_warrenty SET status='1' WHERE warr_id='$warrid'";

    $result = $dbobj->prepare($sql);
    if(!$result->execute()){
        echo "0,warrenty not confirmed";
    }else{
        echo "1,warrenty has been confirmed";
    }
    $result->close();
    $dbobj->close();
 }

 function cancelWarrenty(){
    $warrid = $_POST['warrid'];
    $dbobj =DB::connect();
    $sql = "UPDATE tbl_warrenty SET status='3' WHERE warr_id ='$warrid'";
    $result = $dbobj->prepare($sql);
    if(!$result->execute()){
        echo "0,warrenty not canceled";
    }else{
        echo "1,warrenty has been Canceled";
    }
    $result->close();
    $dbobj->close();
 }


?>