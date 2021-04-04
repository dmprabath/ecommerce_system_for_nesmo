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
<div class="card mt-3" >
	<h4 class="text-center h4 font-weight-bold text-primary">Stock Summery Report</h4>
	<p class="text-center text-primary">This will provide summury of product Quantity</p>
	<div class="d-flex justify-content-between">
      <div class="col-lg-4">
        <div class="form-group row">
          <label class="col-lg-3 col-form-label" for="inlineFormInput">Category</label>
          <select name="rep_cat" id="rep_cat" class=" col-lg-8 custom-select  mb-2">
            <?php getCategory() ?>
          </select>
        </div>
     </div>
     

    </div>
	<div class="m-3">
		<table id="sm_report" class="table responsive">
			<thead>
				<th>Product ID</th>
				<th>Product Modal</th>
				<th>Available Quantity</th>
				<th>Reach Level</th>
				<th></th>
				<th>status</th>
			</thead>
			<tbody id="sum_data">
				
			</tbody>
		</table>
	</div>
	
</div>
<script>
$(document).ready(function(){
    var dataTable = $("#sm_report").DataTable({
        "processing": true,
        "serverSide" : true,
        "retrieve": true,
        "dom": 'Bfrtip',
        "ajax":{
            "url":"lib/mod_report.php?type=stockSummery",
            "type":"POST",
        },
        "columns":[
            {"data":"0"},
            {"data":"1"},
            {"data":"2"},
            {"data":"3"},
            {"data":"4"},
            {"data":"5"}

        ],
         "columnDefs":[
            {
                "targets": [4],
                "visible": false,
                "searchable": true
            },
            {
            	"targets" : [5],
            	"render" : function(data, type, row){
            		if(row[2]=="0"){
            			return "<p class='text-danger'>Out Of Stock</p>";
            		}else{
            			return "<p>Low Stock</p>";
            		}
            	}
            }
           
         ],
         "buttons":[
                'copy',
                'csv',
                'excel',
                'pdf',
                'print'
            ]
    });
    $("#rep_cat").on('change',function(){
    	var rep_cat =$(this).val() ;
    	dataTable.column(4).search( rep_cat).draw();
        	
    });

    

    $("#btn-export").click(function(){
    	var category =$("#rep_cat").val();
    	
    	window.open('view/report/stockSummeryReportPDF.php?category='+category,'_blank');

    });
});
</script>	

