<?php  
    require_once("../../lib/common.php") ;
    require_once("../../lib/mod_report.php") ;

    
?>
<div class="breadcrumb  bg-gray-200 ">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i><a  href='#' class="text-dark" onclick="funViewRep()"> Reports Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <a  class="text-primary"> Purchase Report</a> </li>


</div>
<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>
<div>

<div class="card mt-3" >
    <h4 class="text-center h4 font-weight-bold text-dark">Incompete Purchase </h4>

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
                <th>Order Id</th>
                <th>Customer Name</th>
                <th>Total (Rs)</th>
                <th>Paid (Rs)</th>
                <th>Last Payment Date</th>
            </thead>
            <tbody id="sum_data">
                <?php 
                    $dbobj  =DB::connect();
                    $sql = "SELECT inv.inv_id,cus.cus_fname,inv.inv_total,inv.inv_paid,pay.pay_date FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id = cus.cus_id LEFT JOIN tbl_payment pay ON inv.inv_id = (SELECT pays.inv_id FROM tbl_payment pays WHERE pays.inv_id= inv.inv_id  ORDER BY pays.pay_date DESC LIMIT 1 ) WHERE inv_total > inv_paid AND inv_status !='0' GROUP BY inv.inv_id ";
                    $result = $dbobj->query($sql);
                    $rec = $result->num_rows;
                    echo("Orders : ".$rec);

                    while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo ($row['inv_id']) ?> </td>
                                <td><?php echo ( $row['cus_fname'] ) ?> </td>
                                <td class="text-right"><?php echo ( $row['inv_total'] ) ?> </td>
                                <td class="text-right"><?php echo ( $row['inv_paid'] ) ?> </td>
                                <td><?php echo ( $row['pay_date'] ) ?> </td>
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
       
            
        window.open('view/report/incompletepurchasePDF.php','_blank');

    });
        
        
        
});
</script>   

