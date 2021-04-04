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
        <a  class="text-primary"> Order Summery</a> </li>


</div>
<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>
<div>

<div class="card mt-3" >
    <h4 class="text-center h4 font-weight-bold text-primary">Order Summery Report</h4>
    <p class="text-center text-primary">This will provide summury of Orders</p>
    <div class="d-flex justify-content-between ">      
          <div class="col-sm-3">
            <form>
              <div class="form-group row">
                <label class="col col-form-label" for="inlineFormInput">Type</label>
                <select name="rep_type" id="rep_type" class=" col-sm-8 custom-select  mb-2">
                    <option value="">Select Type</option>
                    <option value="today">Today</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                    <option value="custom">Date Range</option>
                </select>                
              </div>
            </form>
          </div>
          <div class="col-sm-3">              
            
          </div> 
    </div>

    <div class="d-flex justify-content-between ">
        <form>
      <div class=" row ml-1">
        <div class="row mx-auto d-none" id="sdate-div">
            <label class="col col-form-label" for="inlineFormInput">Start Date</label>
            <input type="text" name="stdate" id="stdate" class="form-control form-control-sm col">
        </div>
        <div class="row mx-auto d-none" id="edate-div">
            <label class="col col-form-label" for="inlineFormInput">End Date</label>
            <input type="text" name="stdate" id="endate" class="form-control form-control-sm col">
        </div>
        <div class="ml-2 d-none" id="btn-div">
            <button type="button" class="btn  btn-primary" name="" id="generate">Generate</button>
        </div>
    </div>
       </form>
     <div class="col-lg-3">
         
     </div>

    </div>
    
     
    <div class="m-3">
        <table id="ls_report" class="table responsive">
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
    $("#stdate,#endate").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"0"
    });
    var dataTable = $("#ls_report").DataTable({
        "processing": true,
        "serverSide" : true,
        "retrieve": true,        
      "dom": 'Bfrtip',
        "ajax":{
            "url":"lib/mod_report.php?type=lowStockSummery",
            "type":"POST",
        },
        "columns":[
            {"data":"0"},
            {"data":"1"},
            {"data":"2"},
            {"data":"3"},
            {"data":"4"}

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
                        return "<p>Stock</p>";
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

    $("#rep_type").on('change',function(){
        var type =$(this).val() ;
        //alert(rep_type);
        if(type=="today"){
            $("#sdate-div").addClass('d-none');
            $("#edate-div").addClass('d-none');
            $("#generate").prop("name","today");
            $("#btn-div").removeClass('d-none');
        }else if(type=="month"){
            $("#sdate-div").addClass('d-none');
            $("#edate-div").addClass('d-none');
            $("#generate").prop("name","month");
            $("#btn-div").removeClass('d-none');

        }else if(type=="year"){
            $("#sdate-div").addClass('d-none');
            $("#edate-div").addClass('d-none');
            $("#generate").prop("name","year");
            $("#btn-div").removeClass('d-none');

        }else if(type=="custom"){
            $("#sdate-div").removeClass('d-none');
            $("#edate-div").removeClass('d-none');
            $("#generate").prop("name","custom");
            $("#btn-div").removeClass('d-none');

        }else{
            $("#sdate-div").addClass('d-none');
            $("#edate-div").addClass('d-none');
            $("#generate").prop("name","");
            $("#btn-div").addClass('d-none');
        }
            
    });   
    $("#generate").click(function(){
        var rep_type = $(this).prop('name');


    });

    $("#btn-export").click(function(){
        var category =$("#rep_cat").val();        
        window.open('report/inventry.php?category='+category,'_blank');

    });
        
        
        
});
</script>   

