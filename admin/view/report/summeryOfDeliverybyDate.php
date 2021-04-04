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
        <a  class="text-primary"> Delivery Report</a> </li>
</div>
<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>
<div>

<div class="card mt-3" >
    <h4 class="text-center h4 font-weight-bold text-dark">Delivery Report </h4>
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
                <th>GRN Id</th>
                <th>Supplier Name</th>
                <th>GRN Date</th>
                <th>Order Cost (Rs)</th>
            </thead>
            <tbody id="sum_data">
                <?php 
                    $dbobj  =DB::connect();
                    $sql = "SELECT grn_id , sup_name, grn_rdate,grn_total FROM tbl_grn grn JOIN tbl_suppliers sup ON grn.sup_id = sup.sup_id WHERE grn_rdate BETWEEN '$sdate' AND '$edate' ORDER BY grn_rdate ";
                    $result = $dbobj->query($sql);
                    $rec = $result->num_rows;
                    $total =0;
                    echo("Orders : ".$rec."<br/>");

                    while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo ($row['grn_id']) ?> </td>
                                <td><?php echo ( $row['sup_name'])  ?> </td>
                                <td><?php echo ( $row['grn_rdate'] ) ?> </td>
                                <td class="text-right"><?php echo ( number_format($row['grn_total'],2) ) ?> </td>
                                <?php $total =$total+$row['grn_total']  ?>
                                
                            </tr>
                        <?php
                    }
                    $total = number_format($total,2);
                    echo("Total Purchase (Rs) : ".$total);
                 ?>
                
            </tbody>
        </table>
    </div>
    
</div>

<script>
$(document).ready(function(){

    $("#btn-export").click(function(){
        var category =$("#rep_cat").val();        
        window.open('report/inventry.php?category='+category,'_blank');

    });
        
        
        
});
</script>   

