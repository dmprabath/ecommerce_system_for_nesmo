<?php  

	require_once("../../lib/common.php") ;
	require_once("../../lib/mod_report.php") ;
    if(isset($_GET['sdate'])){
        $sdate = $_GET['sdate'];
        $edate = $_GET['edate'];        

    }
 
?>
<div class="breadcrumb  bg-gray-200 ">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i><a  class="text-primary" onclick="funViewRep()"> Reports Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <a  class="text-primary"> Income Inventory Report</a> </li>


 </div>

 <div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>
    
    

<div class="card mt-3" >
	<h4 class="text-center h4 font-weight-bold text-primary">Income Products From <?php echo($sdate) ?> To <?php echo($edate) ?> </h4>
	<p class="text-center text-primary">This will provide summury of received products</p>
	<div class="d-flex justify-content-between">
      <div class="col-lg-4">
        
     </div>
     <div class="col-lg-3">
         
     </div>

    </div>
	<div class="m-3">
		<table id="sm_report" class="table responsive">
			<thead>
				<th>No</th>
                <th>Received Date</th>
				<th>product_model</th>
				<th>Quantity</th>
                <th>Available</th>
			</thead>
			<tbody id="sum_data">
				<?php incomeInventory($sdate,$edate) ?>
			</tbody>
		</table>
	</div>
	
</div>
<script>
$(document).ready(function(){
    $("#btn-export").click(function(){
       var sdate = "<?php echo $sdate ?>";
       var edate = "<?php echo $edate ?>";
            
        window.open('view/report/incomeInventoryPDF.php?sdate='+sdate+'&edate='+edate,'_blank');

    });  
        
        
});
</script> 


