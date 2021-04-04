<?php  
    require_once("../../lib/common.php") ;
    require_once("../../lib/mod_report.php") ;

    if(isset($_GET['month'])){
        $result= $_GET['month'];
        $res =explode("_",$result);
        $month = $res[0];
        $monthname = $res[1];

        $year = $_GET['year'];        
 
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
    <h4 class="text-center h4 font-weight-bold text-dark">Purchase to Supplier Report By Month </h4>
    <p class="text-center h5  text-dark"><?php echo $monthname;  ?>  <?php echo $year;  ?> </p>

    <div class="d-flex justify-content-between ">      
          <div class="col-sm-3">
            
          </div>
          <div class="col-sm-3">              
            
          </div> 
    </div>
     <div class="col-lg-3">
         
     </div>


     <div class="ml-3">
        <?php
        $dbobj  =DB::connect();
                    
                     $sql = "SELECT count(grn_id) , sum(grn_total) FROM tbl_grn grn WHERE MONTH(grn_rdate)= '$month' AND YEAR(grn_rdate) = '$year' ";
                    $result_data = $dbobj->query($sql);
                    /*$rec = $result->num_rows;
                    echo("Orders : ".$rec);*/
                    $rec = $result_data->fetch_assoc();

                    echo("<p> Month and Year : ".$monthname." ".$year."</p>");
                    echo("<p> No of Orders : ".$rec['count(grn_id)']."<br/>");
                    echo(" Total cost (Rs.) : ".number_format($rec['sum(grn_total)'],2)."<br/>");


        ?>
         
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
                    
                    
                     $sql_data = "SELECT grn_id , sup_name, grn_rdate,grn_total FROM tbl_grn grn JOIN tbl_suppliers sup ON grn.sup_id = sup.sup_id WHERE MONTH(grn_rdate)= '$month' AND YEAR(grn_rdate) = '$year' ORDER BY grn_rdate ";
                    $result_data = $dbobj->query($sql_data);
                    

                    while ($row = $result_data->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo ($row['grn_id']) ?> </td>
                                <td><?php echo ( $row['sup_name'])  ?> </td>
                                <td><?php echo ( $row['grn_rdate'] ) ?> </td>
                                <td class="text-right"><?php echo ( number_format($row['grn_total'],2) ) ?> </td>
                            </tr>
                        <?php
                    }

                    $dbobj->close();
                 ?> 
                
            </tbody>
        </table>
    </div>
    
</div>

<script>
$(document).ready(function(){
    $(this).scrollTop(0);
   

    $("#btn-export").click(function(){
        var month = "<?php echo $result ?>";
            var year = "<?php echo $year ?>";
       
        window.open('view/report/purchasetoSupplierbyMonthPDF.php?month='+month+'&year='+year,'_blank');

    });
        
        
        
});
</script>   

