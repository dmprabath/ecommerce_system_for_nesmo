<?php  
    require_once("../../lib/common.php") ;
    require_once("../../lib/mod_report.php") ;

    
?>
<div class="breadcrumb  bg-gray-200 ">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i><a  href='#' class="text-dark" onclick="funViewRep()"> Reports Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <a  class="text-primary"> Stock Report</a> </li>
</div>
<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>
<div>
   

<div class="card mt-3" >
    <h4 class="text-center h4 font-weight-bold text-dark">Out of Stock Report </h4>    
     
     
    <div class="m-3">
        <table id="ls_report" class="table responsive table-bordered">
            <thead class="thead-light">
                <th>Product Id</th>
                <th>Product Model</th>
                <th>Category</th>
                <th>Minimum Level</th>
            </thead>
            <tbody id="sum_data">
                <?php 
                    $dbobj  =DB::connect();
                    $sql = "SELECT prod_id,prod_modal,cat_name,prod_rlevel FROM tbl_products pro JOIN tbl_category cat ON pro.cat_id = cat.cat_id WHERE prod_qty='0' ";
                    $result = $dbobj->query($sql);
                    $rec = $result->num_rows;
                    $date = date("Y-m-d",time());
                    echo("Date : ".$date."<br/>");
                    echo("No of Products : ".$rec);

                    while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo ($row['prod_id']) ?> </td>
                                <td><?php echo ( $row['prod_modal'] ) ?> </td>
                                <td><?php echo ( $row['cat_name'] ) ?> </td>
                                <td><?php echo ( $row['prod_rlevel'] ) ?> </td>
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
                
        window.open('view/report/outstockSummeryReportPDF.php','_blank');

    });
        
        
        
});
</script>   

