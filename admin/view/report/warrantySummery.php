<?php  
    require_once("../../lib/common.php") ;
    require_once("../../lib/mod_report.php") ;

    
?>
<div class="breadcrumb  bg-gray-200 ">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i><a  href='#' class="text-dark" onclick="funViewRep()"> Reports Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <a  class="text-primary"> Warranty Report</a> </li>
</div>
<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>
<div>

<div class="card mt-3" >
    <h4 class="text-center h4 font-weight-bold text-dark">Warranty Summery Report </h4>

    <div class="d-flex justify-content-between ">      
          <div class="col-sm-3">
            
          </div>
          <div class="col-sm-3">              
            
          </div> 
    </div>
     <div class="col-lg-3">
         
     </div>

    
    
     
    <div class="m-3">
        <table id="ls_report" class="table responsive table-bordered">
            <thead class="thead-light">
                <th>warranty Id</th>
                <th>Invoice Id</th>
                <th>Customer Name</th>
                <th>Warranty Date</th>
                <th>Complete Date</th>
                <th>Probleme</th>
                <th>Solution</th>
                <th>Status</th>
            </thead>
            <tbody id="sum_data">
                <?php 
                    $dbobj  =DB::connect();
                    $sql = "SELECT warr_id,inv_id,cus_fname,cus_lname,warr_date,complete_date,warr_claim,description,status FROM tbl_warrenty warr JOIN tbl_customers cus ON warr.cus_id = cus.cus_id ORDER BY warr_date ";
                    $result = $dbobj->query($sql);
                    $rec = $result->num_rows;
                    echo("Warranty : ".$rec);

                    while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo ($row['warr_id']) ?> </td>
                                <td><?php echo ( $row['inv_id'])  ?> </td>
                                <td><?php echo ( $row['cus_fname'] ) ?> <?php echo ( $row['cus_lname'] ) ?> </td>
                                <td><?php echo ( $row['warr_date'] ) ?> </td>
                                <td><?php echo ( $row['complete_date'] ) ?> </td>
                                <td><?php echo ( $row['warr_claim'] ) ?> </td>
                                <td><?php echo ( $row['description'] ) ?> </td>
                                <?php $status = $row['status'];
                                        if($status == "0") {
                                            $status = "Pending";
                                        }else if($status =="1"){
                                            $status = "Confirm";
                                        } else {
                                            $status = "Deliverd";
                                        }  
                                        ?>
                                <td><?php echo ( $status) ?> </td>
                            </tr>
                        <?php
                    }
                 ?>
                
            </tbody>
        </table>
    </div>
    
</div>

<script>
$(document).ready(function(){

    $("#btn-export").click(function(){
                    
        window.open('view/report/warrantySummeryPDF.php','_blank');

    });
        
        
        
});
</script>   

