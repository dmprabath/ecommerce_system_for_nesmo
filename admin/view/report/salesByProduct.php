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
        <a  class="text-primary"> Sales Report</a> </li>
</div>
<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>
<div>

<div class="card mt-3" >
    <h4 class="text-center h4 font-weight-bold text-dark">Sales By Products </h4>
    <p class="text-center h5  text-dark">Form <?php echo $sdate;  ?> TO <?php echo $edate;  ?> </p>

    <div class="d-flex justify-content-between ">      
          <div class="col-sm-3">
            
          </div>
          <div class="col-sm-3">              
            <
          </div> 
    </div>
     <div class="col-lg-3">
         
     </div>

    
    
     
    <div class="m-3">
        <table id="ls_report" class="table responsive table-bordered">
            <thead class="thead-light">
                <th></th>
                <th>Product Model</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
            </thead>
            <tbody id="sum_data">
                <?php 
                    $dbobj  =DB::connect();
                    $sql = "SELECT pro.prod_name, pro.prod_modal,cat.cat_name, SUM(invp.prod_qty)  FROM tbl_invoice inv JOIN tbl_inv_prod invp On inv.inv_id= invp.inv_id JOIN tbl_products pro ON invp.prod_id = pro.prod_id JOIN tbl_category cat ON pro.cat_id = cat.cat_id WHERE inv_date BETWEEN '$sdate' AND '$edate' GROUP BY prod_name ORDER BY invp.inv_id ";
                    $result = $dbobj->query($sql);
                    $rec = $result->num_rows;
                    echo("Products : ".$rec);
                    $i = 1;

                    while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo ($i) ?> </td>
                                <td><?php echo ($row['prod_modal']) ?> </td>
                                <td><?php echo ( $row['prod_name'])  ?> </td>
                                <td><?php echo ( $row['cat_name'] ) ?> </td>
                                <td><?php echo ( $row['SUM(invp.prod_qty)'] ) ?> </td>
                            </tr>
                        <?php
                        $i++;
                    }
                 ?>
                
            </tbody>
        </table>
    </div>
    
</div>

<script>
$(document).ready(function(){

   $("#btn-export").click(function(){
        var sdate =" <?php echo $sdate  ?>";
        var edate =" <?php echo $edate  ?>";
            
        window.open('view/report/salesByProductPDF.php?sdate='+sdate+'&edate='+edate,'_blank');

    });
        
        
        
});
</script>   

