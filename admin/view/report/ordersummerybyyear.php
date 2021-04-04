<?php  
    require_once("../../lib/common.php") ; 
    require_once("../../lib/mod_report.php") ;

    if(isset($_GET['year'])){
        $year = $_GET['year'];        

    } 
?>
<div class="breadcrumb  bg-gray-200 ">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i><a  href='#' class="text-dark" onclick="funViewRep()"> Reports Management</a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <a  class="text-primary"> Order Report</a> </li>
</div>
<div class="d-flex justify-content-between">
      <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button>
</div>
<div>
  <input type="hidden" name="syear" id="syear" value="<?php echo $year ?>">

<div class="card mt-3" >
   <h4 class="text-center h4 font-weight-bold text-dark">Order Summery Report By Year </h4>
    <p class="text-center h5  text-dark"><?php echo $year;  ?> </p>
    <div class="d-flex justify-content-between ">      
          <div class="col-sm-3">
            
          </div>
          <div class="col-sm-2 mt-2">              
            
          </div> 
    </div>
     <div class="row mt-5">
     
      <div id="annual_report" class="col text-center">
        
      </div>
     
      <div id="annual_report_income" class="col text-center">
        
      </div>
         
     </div>


     <div class="ml-3">         
     </div>

    
    
     
    <div class="m-3">

    </div>
    
</div>

<script>
$(document).ready(function(){
  var year = $("#syear").val();
  /* ------------------- Chart for Order Annalyze ------------------*/

    $.ajax({
      data:{year:year},
      url: "lib/mod_report.php?type=numberorderbyyear",
      type: "GET",
        success: function(data) {
          chartData = data;
            var chartProperties = {
            "theme": "fusion",
            "caption": "No of Orders",
            "legendPosition" :"RIGHT",            
            "showPercentValues": "0",
            "exportEnabled" :"1",
            "subCaption": year,
            },
            apiChart = new FusionCharts({
              type: "pie2d",
              width : "500",
              height : "400",
              renderAt: "annual_report",
              dataFormat: "json",
              dataSource: {
                 chart: chartProperties,
                  data: chartData
              }
            });
                apiChart.render();
        }
    });

    /* ------------------- Chart for income Annalyze ------------------*/
    $.ajax({
      data:{year:year},
      url: "lib/mod_report.php?type=ordersummerybyyear",
      type: "GET",
      dataType:"json",
        success: function(data) {
          

            apiChart = new FusionCharts({
              type: "mscolumn2d",
              width : "500",
              height : "400",
              renderAt: "annual_report_income",
              dataFormat: "json",
              dataSource: data,
            });
                apiChart.render();
        }
    });

    $("#btn-export").click(function(){
        var category =$("#rep_cat").val();        
        window.open('report/inventry.php?category='+category,'_blank');

    });
        
        
        
});
</script>   

