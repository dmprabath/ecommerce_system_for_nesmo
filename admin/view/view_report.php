  
  <div class="breadcrumb  bg-gray-200 text-uppercase">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <li><a  class="text-primary"> Reports Management</a> </li>


    </div> 
  <div id='rport_page'>
      
  
<h4>Inventary</h4>
<div class="row">  
    <div class="col-lg-4 m-1 card rep_button">
        <a href="#" id="ssd" onclick="funStockSum()" class="card-link">
            <div class="row m-1">
                <div class="col-lg-3">
                <i class="fas fa-3x fa-chart-line text-success"></i>            
                </div>
                <div class="col">
                    <p class="text-success m-0">Stock Summery Report </p>
                    <small >This report will provide Summary of Current stock</small>   
                </div>
            </div>  
        </a>      
    </div> 
    <div class="col-lg-4 m-1 card rep_button">
         <a href="#" onclick="funStockLow()" class="card-link">
        <div class="row m-1">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-warning"></i>            
            </div>
            <div class="col">
                <p class="text-warning m-0">Low Stock Report </p>
                <small >This report will provide a summary of Low stock</small>   
            </div>
        </div>   
        </a>     
    </div> 
    <div class="col-lg-4 m-1 card rep_button" onclick="outofstockreport()">
        <div class="row m-1">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-danger"></i>            
            </div>
            <div class="col">
                <p class="text-danger m-0">Out Of Stock Report </p>
                <small >This report will provide a summary out of stock</small>   
            </div>
        </div>        
    </div>
    <div class="col-lg-4 m-1 card rep_button report_type" title="Recived Products">
        <div class="row m-1 ">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-primary"></i>            
            </div>
            <div class="col">
                <p class="text-primary m-0">Income Inventry </p>
                <small >This report will provide Recived product within date range</small>   
            </div>
        </div>        
    </div>
</div>
                        <!-- --------------- Sales Report-------------- -->
<h4>Sales</h4>


<div class="row">  
    
    <div class="col-lg-4 m-1 card rep_button">
         <a href="#"  class="card-link report_type" title="Order Summery">
        <div class="row m-1 ">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-warning"></i>            
            </div>
            <div class="col">
                <p class="text-warning m-0">Order Summery Report </p>
                <small >This report will provide a summary of Orders</small>   
            </div>
        </div>   
        </a>     
    </div> 
    <div class="col-lg-4 m-1 card rep_button report_type" title="Online Sales">
        <div class="row m-1 " >
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-warning"></i>            
            </div>
            <div class="col">
                <p class="text-warning m-0">Online Sales Report </p>
                <small >This report will provide a summary of Online sales</small>   
            </div>
        </div>        
    </div> 
    <div class="col-lg-4 m-1 card rep_button report_type" title="Offline Sales">
        <div class="row m-1 ">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-danger"></i>            
            </div>
            <div class="col">
                <p class="text-danger m-0">Offline Sales Report </p>
                <small >This report will provide a summary of offline sales</small>   
            </div>
        </div>        
    </div>
    <div class="col-lg-4 m-1 card rep_button report_type" title="Sales by Product">
        <div class="row m-1 ">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-primary"></i>            
            </div>
            <div class="col">
                <p class="text-primary m-0">Sales By Product Report </p>
                <small >This report will provide a summary of product sales </small>   
            </div>
        </div>        
    </div>
</div>

<h4>Purchase</h4>


<div class="row">  
    <div class="col-lg-4 m-1 card  rep_button report_type" title="Purchase Summery" >
        <div class="row m-1" >
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-success"></i>            
            </div>
            <div class="col">
                <p class="text-success m-0">Purchase Summery Report </p>
                <small >This report will provide a summary of all purchase</small>   
            </div>
        </div>        
    </div> 
    <div class="col-lg-4 m-1 card rep_button report_type" title="Purchase Summery By method">
        <div class="row m-1">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-warning"></i>            
            </div>
            <div class="col">
                <p class="text-warning m-0">Purchase report by perchase method </p>
                <small >This report will provide a payment by method</small>   
            </div>
        </div>        
    </div> 
    <div class="col-lg-4 m-1 card rep_button " onclick="funViewIncompletePurchase()">
        <div class="row m-1">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-danger"></i>            
            </div>
            <div class="col">
                <p class="text-danger m-0">Incomplete purchase report </p>
                <small >This report will provide a summary Incomplete Purchase</small>   
            </div>
        </div>        
    </div>
    <div class="col-lg-4 m-1 card rep_button report_type" title="Purchase To Supplier">
        <div class="row m-1">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-primary"></i>            
            </div>
            <div class="col">
                <p class="text-primary m-0">Purchase by supplier Report </p>
                <small >This report will provide a summary of Grn</small>   
            </div>
        </div>        
    </div>
</div>

<h4>Warranty</h4>

<div class="row">  
    <div class="col-lg-4 m-1 card rep_button " onclick='warrantySummery()' title="warranty Summery">
        <div class="row m-1">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-success"></i>            
            </div>
            <div class="col">
                <p class="text-success m-0">All warranty Report </p>
                <small >This report will provide a All Warranty</small>   
            </div>
        </div>        
    </div> 
    <div class="col-lg-4 m-1 card rep_button  "  onclick='incompleteWarrantySummery()' title="Incomplete warranty Summery">
        <div class="row m-1">
            <div class="col-lg-3">
            <i class="fas fa-3x fa-chart-line text-warning"></i>            
            </div>
            <div class="col">
                <p class="text-warning m-0">Incomplete Warranty Report</p>
                <small >This report will provide a summary of incomplete Warranty</small>   
            </div>
        </div>        
    </div> 
</div>

</div>



<div class="modal  fade" id="reportType" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <form id="" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-center" >
                        <div class="row">
                            <h3 id="report_ttitle" style="margin: 0 auto"></h3>
                        </div>
                        
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body"> 
                    
                <div id="daily_section">
                    <div class="card bg-gray-200 my-2">
                        <h4 class="text-center">Daily Reports</h4>                        
                    </div>
                    <div class="row py-3">
                        <div class="col">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">From : </label>
                                <input type="text" class="col-lg-7 form-control form-control-sm" id="sddate" name="sdate" placeholder="YYYY-MM-DD"  value="">
                            </div>                            
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">To : </label>
                                <input type="text" class="col-lg-7 form-control form-control-sm" id="eddate" name="edate" placeholder="YYYY-MM-DD"  value="">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info" id="btn_daily_report">Generate</button>
                        </div>
                        
                    </div>
                     <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">Minimum Income</label>
                                <input type="text" class="col-lg-7 form-control form-control-sm" id="income" name="income"  value="">
                            </div>
                        </div>
            </div>                    
            <div id="month_section">                    
                    

                    <div class="card bg-gray-200 my-2">
                        <h4 class="text-center">Monthly Report</h4>                        
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">Month :</label>
                                <select class="form-control col-lg-7" id="month">
                                    <option value="01_January">January</option>
                                    <option value="02_February">February</option>
                                    <option value="03_March">March</option>
                                    <option value="04_April">April</option>
                                    <option value="05_May">May</option>
                                    <option value="06_June">June</option>
                                    <option value="07_July">July</option>
                                    <option value="08_Augest">Augest</option>
                                    <option value="09_September">September</option>
                                    <option value="10_Octomber">Octomber</option>
                                    <option value="11_November">November</option>
                                    <option value="12_December">December</option>
                                </select>
                                
                            </div>                            
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">Year :</label>
                                <select class="form-control col-lg-7" id=myear>
                                    <?php 
                                        $year = date("Y");
                                        for ($i = 0; $i<5; $i++){
                                                    ?>
                                                     <option value="<?php echo($year) ?>"><?php echo($year) ?></option>

                                                    <?php
                                                    $year--;
                                            }
                                    ?>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info" id="btn_monthly_report">Generate</button>
                        </div>
                        
                    </div>
            </div>
            <div id="year_section">
                    <div class="card bg-gray-200 my-2">
                        <h4 class="text-center">Annual Annalyse</h4>                        
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <div class="form-group row">
                                <label for="" class="col-lg-4 col-form-label">Year :</label>
                                <select class="form-control col-lg-7" id="AnYear">
                                    <?php 
                                        $year = date("Y");
                                        for ($i = 0; $i<5; $i++){
                                                    ?>
                                                     <option><?php echo($year) ?></option>

                                                    <?php
                                                    $year--;
                                            }
                                    ?>
                                   
                                </select>

                            </div>                            
                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info" id="btn_year_report">Generate</button>
                        </div>
                        
                    </div>

                    
                </div>
                <div id="type" class="row d-none">
                    <label class='col-lg-2' >Select Method </label>
                    <select class="custom-select col-lg-3" name="pay_method" id="pay_method">
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                    </select>
                    
                </div>
            </div>
        </div>
        </form>
    </div>
</div> 


<script>
    $(document).ready(function () {
        $(this).scrollTop(0);

        $("#edate, #sdate, #eddate, #sddate").datepicker({
            changeMonth:true,
            changeYear:true,
            dateFormat: 'yy-mm-dd',
            maxDate:"0"

        });
       
        /* ------------------  Only add Dates  and type(daily, mothly yearly)    ------------------*/
        $("#rport_page").on("click",".report_type",function(){
            var title = $(this).attr("title");
            $("#report_ttitle").html(title);
        //sales by product
            if(title=="Recived Products"){
                $("#month_section").addClass('d-none');    //hide month section             
                $("#year_section").addClass('d-none'); // see year section
                $("#daily_section").removeClass('d-none'); // see daily section
                $("#type").addClass('d-none'); // hide payment type
        // purchase summery
            }else if(title=="Sales by Product"){
                $("#month_section").addClass('d-none');    //hide month section             
                $("#year_section").removeClass('d-none'); // see year section
                $("#daily_section").removeClass('d-none'); // see daily section
                $("#type").addClass('d-none'); // hide payment type
        // purchase summery
            }else if(title=="Purchase Summery"){
                $("#month_section").addClass('d-none');
                $("#year_section").addClass('d-none');                
                $("#daily_section").removeClass('d-none');
                $("#type").addClass('d-none');
        //purchase summery method
            }else if(title=="Purchase Summery By method"){
                $("#month_section").addClass('d-none');
                $("#daily_section").removeClass('d-none');
                $("#year_section").addClass('d-none');
                $("#type").removeClass('d-none');
            }else if(title=="Summery of Dilivery"){
                $("#month_section").addClass('d-none');
                $("#daily_section").removeClass('d-none');
                $("#year_section").addClass('d-none');
                $("#type").addClass('d-none');
            }else if(title=="Purchase To Supplier"){
                $("#month_section").removeClass('d-none');
                $("#daily_section").removeClass('d-none');
                $("#year_section").addClass('d-none');
                $("#type").addClass('d-none');
            }else{
                $("#month_section").removeClass('d-none');
                $("#year_section").removeClass('d-none');
                $("#daily_section").removeClass('d-none');
                $("#type").addClass('d-none');
            }
            $("#reportType").modal("show"); 
        });

       
        /*----------------- Daily Reports generation  -----------------------*/
        $("#btn_daily_report ").click(function(){
            var title = $("#report_ttitle").html();
            var sdate = $("#sddate").val();
            var edate = $("#eddate").val();
            var income = $("#income").val();
            income = parseFloat(income).toFixed(2);

            if(sdate =="" || edate =="" ){
                swal("warning","Enter the start date and End date",'warning');
            }else if (sdate>edate){
                swal("warning","Selct a after date of start date",'warning');
            }else{
                $("#reportType").modal("hide");
                 
                if(title=="Recived Products"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/income_inventory.php?sdate="+sdate+"&edate="+edate);
                  }, 250);
                    
                }else if(title=="Order Summery"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/ordersummerybydate.php?sdate="+sdate+"&edate="+edate);
                  }, 250);
                    
                }else if(title=="Online Sales"){
                    //var income = $("#income").val();
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/onlinesalesbydate.php?sdate="+sdate+"&edate="+edate+"&income="+income);
                  }, 250);
                    
                }else if(title=="Offline Sales"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/offlinesalesbydate.php?sdate="+sdate+"&edate="+edate);
                  }, 250);
                    
                }else if(title=="Sales by Product"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/salesByProduct.php?sdate="+sdate+"&edate="+edate);
                  }, 250);
                    
                }else if(title=="Purchase Summery"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/purchasesummerybydate.php?sdate="+sdate+"&edate="+edate);
                  }, 250);
                    
                }else if(title=="Purchase Summery By method"){
                    var pay_method = $("#pay_method").val();
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/purchasesbyMethodbydate.php?sdate="+sdate+"&edate="+edate+"&method="+pay_method);
                  }, 250);
                    
                }else if(title=="Purchase To Supplier"){
                   
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/purchasetoSupplierbyDate.php?sdate="+sdate+"&edate="+edate);
                  }, 250);
                    
                }else if(title=="Summery of Dilivery"){
                   
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/summeryOfDeliverybyDate.php?sdate="+sdate+"&edate="+edate);
                  }, 250);
                    
                }

            }


        });


            /*----------------- Monthly Reports generation  -----------------------*/

        $("#btn_monthly_report").click(function(){
            var title = $("#report_ttitle").html();
            var month = $("#month").val();
            var year = $("#myear").val();
             $("#reportType").modal("hide");
                
                if(title=="Order Summery"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/ordersummerybymonth.php?month="+month+"&year="+year);
                  }, 250);
                    
                }else if(title=="Online Sales"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/onlinesalesbymonth.php?month="+month+"&year="+year);
                  }, 250);
                    
                }else if(title=="Offline Sales"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/offlinesalesbymonth.php?month="+month+"&year="+year);
                  }, 250);
                    
                }else if(title=="Purchase To Supplier"){
                    
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/purchasetoSupplierbyMonth.php?month="+month+"&year="+year);
                  }, 250);
                    
                }

        });

        $("#btn_year_report").click(function(){
            var title = $("#report_ttitle").html();
            var year = $("#AnYear").val();
             $("#reportType").modal("hide");
                
                if(title=="Order Summery"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/ordersummerybyyear.php?year="+year); 
                  }, 250);
                    
                }else if(title=="Online Sales"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/onlinesalesbyyear.php?year="+year); 
                  }, 250);
                    
                }else if(title=="Offline Sales"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/offlinesalesbyyear.php?year="+year); 
                  }, 250);
                    
                }else if(title=="Sales by Product"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/report/salesproductbyyear.php?year="+year); 
                  }, 250);
                    
                }

        });

        /* ------------------------ see incomplete purchase -------------------*/

        



    });
  function funViewIncompletePurchase(){
            //alert("dsd");
            $("#rpanel").load("view/report/incompletepurchase.php"); 
   }
   function outofstockreport(){
            //alert("dsd");
            $("#rpanel").load("view/report/outofstockreport.php"); 
   }


    function  funStockSum() {    // view all reports
        $("#rpanel").load("view/report/stockSummeryReport.php");
    }
    function  funStockLow() {    // view all reports
        $("#rpanel").load("view/report/low_stock.php");
    }
    function  funOrderSum() {    // view all reports
        $("#rpanel").load("view/report/order_summery.php");
    }

    function  warrantySummery() {    // view all reports
        $("#rpanel").load("view/report/warrantySummery.php");
    }
    function  incompleteWarrantySummery(){    // view all reports
        $("#rpanel").load("view/report/incompleteWarrantySummery.php");
    }


</script>