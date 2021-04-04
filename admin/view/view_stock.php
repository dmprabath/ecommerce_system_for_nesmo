<?php
session_start();
require ("../lib/mod_stock.php");
require ("../lib/common.php");

?>


<div class="breadcrumb  bg-gray-200 text-uppercase">
    <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary" > stock Management</a> </li>


</div>


<div class="row">
    <div class="col-xl-3 col-md-6 my-4">
        <div class="card  border-left-primary bg-light  h-100 py-2 " >
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Products </div>
                        <div class="h5 mb-0 font-weight-bold ">
                            <?php
                            $count = productCount();
                            if($count=="0"){
                                echo ("<p class='text-danger'>0</p>");
                            }else{
                                echo ("<p class='text-success'>".$count."</p>");
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-boxes fa-2x text-primary"></i>

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
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Low Stock Products</div>
                        <div class="h5 mb-0 font-weight-bold text-primary"><?php
                            $level = getProductLevel();
                            if($level=="0"){
                                echo ("0");
                            }else{
                                echo ($level);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-2x fa-box text-primary"></i>
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
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Out OF Stock</div>
                        <div class="h5 mb-0 font-weight-bold ">
                            <?php
                            $stocklevel = getProductOutStock();
                            if($stocklevel=="0"){
                                echo ("<p class='text-danger'>0</p>");
                            }else{
                                echo ($stocklevel);

                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box-open fa-2x text-primary"></i>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">    
    
    <h1 class="h3 mb-0 text-gray-800">View Stock</h1>
    <div class="dropdown show">
      
</div>
</div>

<!-- Content Row -->
<div  class="view_stock">
    <table id="tblviewstock" class="display nowrap table table-striped animated fadeInUp fast "  >
        <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Modal</th>
            <th>Quantity</th>
            <th>Reach Level</th>
            <th>status</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="stockBody" class="">

        </tbody>

    </table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>

<div class="modal fade" id="Change_Reorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formrlevel"> 
            <div class="modal-header">
                                   
                
                <div class="modal-title" >
                    <h5 >Change Reorder Level</h5>                 
                </div>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="msg_body">
                
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Product ID</label>:
                    <input type="email" class="ml-1 col-lg-4 form-control" readonly name="prodid" id="prodid"> 
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Rorder Level</label>:
                    <input type="email" class="ml-1 col-lg-3 form-control" readonly name="rlevel" id="rlevel"> 
                </div>
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">New Level</label>:
                    <input type="text" class="ml-1 col-lg-3 form-control"  name="newlevel" id="newlevel">
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success"  id="rlevel_confirm"> Confirm</button>

            </div>
            </form>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {

       dataTable = $('#tblviewstock').DataTable( {
                "processing": true,
                "serverSide": true,
                "dom": 'Bfrtip',

                "ajax": {
                    "url": "lib/mod_stock.php?type=viewStock",
                    "type": "POST"
                },
                "columns": [
                    {"data": "0"},
                    {"data": "1"},
                    {"data": "2"},
                    {"data": "3"},
                    {"data": "4"},
                    {"data": "5"},
                ],               
                "order": [[2,"asc"]],
                "columnDefs":[
                    {
                        "data": null,
                        "render":function(data,type,row){
                            if(row[2] ==="0"){
                                return "<p class='text-light text-center bg-danger'>Out of Stock</p>"
                            }else if(row[2] >= row[3]){
                                 return "<p class='text-light text-center bg-success'>In Stock</p>"
                            }else if(row[2] < row[3]){
                                return "<p class='text-light text-center bg-warning'>Low Stock</p>"
                            }
                        },
                        "targets":4
                        
                        
                    },
                    {
                        "data": null,
                        "defaultContent":"<button class='btn btn-primary' id='changeReorder'> Change Reorder </button> <button class='btn btn-success' id='view'> Batch </button>  ",
                        "targets":5
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

       
                
      
        $("#tblviewstock tbody").on('click','button',function() {
            var type = $(this).attr('id');
            var data = dataTable.row($(this).parents('tr')).data();
            var prodid = data[0];
            var prodmodal = data[1];
            var qty = data[2];
            var rlevel = data[3];

            if(type =="view"){
                url = "view/view_stock_details.php?prodid="+prodid+"&prodmodal="+prodmodal+"&qty="+qty;
                $("#rpanel").load(url,'','top=500');            
            }else if(type =="changeReorder"){
                $("#prodid").val(prodid);
                $("#rlevel").val(rlevel);
                $("#Change_Reorder").modal();     
            } 


        });
        $("#rlevel_confirm").click(function(){
            var newlevel = $("#newlevel").val();
            var inputPattern = /^[0-9]*$/;
            if(!newlevel.match(inputPattern) || newlevel==""){
                swal("Error","Input is not valid","error");
                return;
            }
            $("#Change_Reorder").modal("hide"); 
            var data = $("#formrlevel").serialize();
             var url= "lib/mod_stock.php?type=changerlevel";
             $.ajax({
                 method:"POST",
                 url:url,
                 data:data,
                 dataType:"text",
                 success:function (result) {
                    res = result.split(",");
                    msg = res[0].trim();
                    if(msg =="0"){
                        swal("error",res[1],"error")
                    }else{
                        swal("success",res[1],"success");
                        setTimeout(function() {
                            funViewStock();
                        }, 300);
                        
                    }
                   
                 },
                 error:function (eobj,err,etxt) {
                     console.log(etxt);
                 }
             });  
        });
        


    });
 </script>