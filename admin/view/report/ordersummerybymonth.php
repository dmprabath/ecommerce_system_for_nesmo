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
        <a  class="text-primary"> Order Report</a> </li>
</div>
<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>
<div>

<div class="card mt-3" >
    <h4 class="text-center h4 font-weight-bold text-dark">Order Summery Report By Month </h4>
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
                    $sql = "SELECT count(inv_id), sum(inv_total), sum(inv_paid) FROM tbl_invoice WHERE MONTH(inv_date)= '$month' AND YEAR(inv_date) = '$year' ";
                    $result = $dbobj->query($sql);
                    /*$rec = $result->num_rows;
                    echo("Orders : ".$rec);*/
                    $rec = $result->fetch_assoc();

                    echo("<p> Month and Year : ".$monthname." ".$year."</p>");
                    echo("<p> No of Orders : ".$rec['count(inv_id)']."<br/>");
                    echo(" Total cost (Rs.) : ".$rec['sum(inv_total)']."<br/>");
                    echo(" Total Paid (Rs.) : ".$rec['sum(inv_paid)']."</p>");


        ?>
         
     </div>

    
    
     
    <div class="m-3">
        <table id="ls_report" class="table responsive table-bordered">
            <thead class="thead-light">
                <th>Order Id</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Order Type</th>
                <th>Status</th>
            </thead>
            <tbody id="sum_data">
                <?php 
                    
                    $sql_data = "SELECT * FROM tbl_invoice inv JOIN tbl_customers cus ON inv.cus_id = cus.cus_id WHERE MONTH(inv_date)= '$month' AND YEAR(inv_date) = '$year'";
                    $result_data = $dbobj->query($sql_data);
                    

                    while ($row = $result_data->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo ($row['inv_id']) ?> </td>
                                <td><?php echo ( $row['cus_fname'])  ?> </td>
                                <td><?php echo ( $row['inv_date'] ) ?> </td>
                                <td><?php echo ( $row['inv_type'] ) ?> </td>
                                <?php $status = $row['inv_status'];
                                        if($status == "0") {
                                            $status = "canceled";
                                        }else if($status =="1"){
                                            $status = "Not Confirm";
                                        } else if($status =="2"){
                                            $status = "Confirmed";
                                        } else if($status =="3"){
                                            $status = "Deliverd";
                                        }  
                                        ?>
                                <td><?php echo ( $status) ?> </td>
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

    $("#btn-export").click(function(){
        var category =$("#rep_cat").val();        
        window.open('report/inventry.php?category='+category,'_blank');

    });
        
        
        
});
</script>   

