<?php
/*require ("lib/common.php");*/
?>
<div class="">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1></h1>
    
</div>

<!-- Content Row -->

    <div class="container row ">
        <div class="col-lg-12 row  shadow animated fadeInUp ">
                
                <div class="col-xl-3 col-md-6 my-4">
                    <div class="card   border-left-primary bg-light  h-100 py-2 " >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Orders</div>
                                    <div class="h5 mb-0 font-weight-bold text-primary"><?php newOrderCount() ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-cart-arrow-down fa-4x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-xl-3 col-md-6 my-4">
                <div class="card  border-left-primary bg-light  h-100 py-2 " >
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php
                                    $stocklevel = getProductOutStock();
                                    if($stocklevel !="0"){
                                        echo("<div class='text-xs font-weight-bold text-danger text-uppercase mb-1'>Out OF Stock</div> <div class='h5 mb-0 font-weight-bold text-danger '>".$stocklevel."</div>");
                                    }else{                                        
                                        echo("<div class='text-xs font-weight-bold text-primary text-uppercase mb-1'>Out OF Stock</div> <div class='h5 mb-0 font-weight-bold'>".$stocklevel."</div>");
                                    }
                                    ?>                                
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 my-4">
                    <div class="card   border-left-primary bg-light  h-100 py-2 " >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Warranty request</div>
                                    <div class="h5 mb-0 font-weight-bold text-primary"><?php newWarrentyCount() ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-4x text-primary fa-shield-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-xl-3 col-md-6 my-4">
                    <div class="card   border-left-primary bg-light  h-100 py-2 " >
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Your performance this month</div>
                                    <div class="h5 mb-0 font-weight-bold text-primary"><?php yourPerformance() ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-4x text-primary  fa-file-invoice-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





        </div>

    </div>
    

<div  class="">

	

</div>
<div class="card p-3  border-top border-primary ">
    <h3 class="text-center text-dark text-uppercase font-weight-bold"> NEW Orders</h3>


    <table id="tblviewinv" class="table table-striped animated fadeInUp fast"  >
        <thead>
        <tr >
            <th>Date</th>
            <th>Id</th>
            <th>Customer name</th>
            <th>Contact Number</th>
            <th>Total Quantity</th>             
            <th>type</th>
            <th ></th>
            <th ></th>

        </tr>
        </thead>
        <tbody style="">

        </tbody>

    </table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>
</div>
<script>
    
    $(document).ready(function () {
            
            /*--------------------New Order Table ----------------------*/
            var dataTable = $("#tblviewinv").DataTable({
            "processing": true,
            "serverSide" : true,
            "ajax":{
                "url":"lib/mod_inv.php?type=viewNotconfirmInvoice",
                "type":"POST",
            },
            "columns":[
                {"data":"0"},
                {"data":"1"},
                {"data":"2"},
                {"data":"3"},
                {"data":"4"},
                {"data":"5"},
                {"data":"6"},
                {"data":"7"}

            ],
            "columnDefs":[
                {
                    "data":6,
                    "render":function(data,type,row){
                        if(data==="1"){
                            return "<button class='btn btn-danger btn-sm' title='confirm' >Confirm</button>"
                        }else if (data ==="2"){
                            return  "<p class='text-primary' title='diliverd' >Confirmed</p>"
                        }else if(data ==="0"){
                            return  "<p class='text-danger'>Cancled</p>"
                        }else{
                            return  "<p class='bg-success text-light'>Finished</p>"
                        }
                    },
                    "targets":6
                },
                {
                    "data":null,
                    "defaultContent":"<button class='btn btn-primary btn-sm' title='details' >Details</button>",
                    "targets":7
                }

            ],
            "language": {
              "emptyTable": "No New Orders"
            }
        }); 
        $("#tblviewinv tbody").on("click","button",function(){
            var button = $(this).attr("title");
            var data = dataTable.row($(this).parents('tr')).data();
           var date = data[0];
           var invid = data[1];
           var cus = data[2];

           if(button=="confirm"){
                swal({
                         title: "Are you sure ?",
                         text: "You are trying to confirm invoice of " + invid,
                         icon: "warning",
                         button: true,
                         dangerMode: true
                     }).then((willDelete) => {
                         if (willDelete) {
                             var url = "lib/mod_inv.php?type=orderConfirmation";
                             $.ajax({
                                 method: "POST",
                                 url: url,
                                 data: {invid:invid}, 
                                 dataType: "text",
                                 success: function (result) {
                                    
                                     res = result.split(",");
                                     msg = res[0].trim();
                                     if (msg  == "0") {
                                         swal("Error", res[1], "error");
                                     }
                                     else if (msg  == "1") {
                                         swal("Success", res[1], "success");
                                         setTimeout(function() {
                                            location.reload();
                                         }, 600);
                                        
                                     }
                                 }
                             });
                      }
                 });
           }else if(button == "details"){
           url ="view/view_inv_details.php?inv_id="+invid+"&cus="+cus+"&date="+date;
           $("#rpanel").load(url);
       }
        });
        
     
});


</script>