<?php  
    require_once("../../lib/common.php") ;
    require_once("../../lib/mod_report.php") ;

    if(isset($_GET['sdate'])){
        $sdate = $_GET['sdate'];
        $edate = $_GET['edate'];        

    } 
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
    <h4 class="text-center h4 font-weight-bold text-dark">Purchase Report </h4>
    <p class="text-center h5  text-dark">Form <?php echo $sdate;  ?> TO <?php echo $edate;  ?> </p>

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
                <th>Payment Id</th>
                <th>Order Id</th>
                <th>Customer Name</th>
                <th>Purchase Date and Time</th>
                <th>Amount(Rs) </th>
                <th>Payment Method</th>
            </thead>
            <tbody id="sum_data">
                <?php 
                    $dbobj  =DB::connect();
                    $sql = "SELECT  pay.pay_id,pay.inv_id,cus.cus_fname,pay.pay_date,pay.pay_time,pay.pay_amount,pay.pay_type FROM tbl_payment pay LEFT JOIN tbl_invoice inv  ON pay.inv_id = inv.inv_id JOIN tbl_customers cus ON inv.cus_id = cus.cus_id WHERE pay.pay_date BETWEEN '$sdate' AND '$edate' ORDER BY inv_id ";
                    $result = $dbobj->query($sql);
                    $rec = $result->num_rows;
                    echo("Orders : ".$rec);

                    while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo ($row['pay_id']) ?> </td>
                                <td><?php echo ( $row['inv_id'])  ?> </td>
                                <td><?php echo ( $row['cus_fname'] ) ?> </td>
                                <td><?php echo ( $row['pay_date']." - ". $row['pay_time'] ) ?> </td>
                                <td class="text-right"><?php echo ( $row['pay_amount'] ) ?> </td>
                                
                                <td><?php echo ( $row['pay_type']) ?> </td>
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
        var sdate = "<?php echo $sdate ?>";
        var edate = "<?php echo $edate ?>";
        var category =$("#rep_cat").val();        
        window.open('view/report/purchasesummerybydatePDF.php?sdate='+sdate+'&edate='+edate,'_blank');

    });
        
        
        
});
</script>   

