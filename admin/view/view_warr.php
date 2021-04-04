<?php
require ("../lib/mod_warrenty.php");
session_start();
$emp_id = $_SESSION["user"]["uid"];
?>

<div class="breadcrumb  bg-gray-200 text-uppercase">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <li><a  class="text-primary" > Warrenty Management</a> </li>


</div>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">        
        <h1 class="h3 mb-0 text-gray-800">Warrenty Managment</h1>
        
    
    </div>
</div>

<div >
		<table id="tblWarranty" class="table table-striped "  >
  			<thead>
    		<tr>
                <th>ID</th>
                <th>Date</th>
          		<th>Order ID</th>
                <th>Cus Name</th>
          		<th>Claim</th>          		
          		<th>Status</th>
                <th></th>
    		</tr>
  			</thead>
            <tbody style="font-size: 15px">

            </tbody>

		</table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>
<!------------------------- Warrenty Details  ------------------>
<div class="modal  fade" id="viewDetails" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <form id="detaislForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Warranty</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mx-3 row" id="warr_data">
                    
                    
                       
                </div>
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!------------------------- Update Details  ------------------>

<div class="modal  fade" id="updateWarr" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <form id="updateForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Update </h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="mx-3 " id="warr_data">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Warrenty ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="uwarr_id" name="uwarr_id"  value="">

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Solutions</label>
                        <textarea  class="col-lg-7 form-control" id="usolution" name="usolution" rows="6">
                            
                        </textarea>

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Descriptions</label>
                        <textarea  class="col-lg-7 form-control" id="udisc" name="udisc" rows="6">
                            
                        </textarea>

                    </div>
                    
                     
                </div>
                <input type="hidden" name="op_id" id="op_id" value="<?php echo($emp_id) ?>">
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="btn_submit"> Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function(){

    var dataTable = $("#tblWarranty").DataTable({
      "processing": true,
      "serverSide": true,
      "dom": 'Bfrtip',

      "ajax":{
        "url":"lib/mod_warrenty.php?type=viewWarrenty",
        "type":"POST"
      },
        "columns":[
        {"data":"0"},
        {"data":"1"},
        {"data":"2"},
        {"data":"3"},
        {"data":"4"},
        {"data":"5"},
        {"data":"6"}

      ],
      "columnDefs":[
          {
            "data":5,
            "render":function(data,type,row){
                if(data==="0"){
                    return "<p class='bg-warning text-light text-center'>Not Confirm</p>"
                }else if(data==="1"){
                    return "<p class='bg-success text-light text-center'>Complete</p>"
                }else{
                    return "<p class='bg-danger text-light text-center'>Canceled</p>"
                }
            },
            "targets":5
          },
            
            {
                "data":null,
                "defaultContent":"<button id='view' title='view' class='btn-sm btn-primary' >View </button> <button title='update' id='update' class='btn-sm btn-secondary' >Update</button> <button id='cancel' title='cancel' class='btn-sm btn-danger' >Cancel </button> ",
                "targets":6
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


    $("#tblWarranty tbody").on("click","button",function(){
      var type = $(this).attr("title");
      var row = dataTable.row($(this).parents('tr')).data();
      var warrid = row[0];
      if(type=="view"){
        $.ajax({
            method:"POST",
            url:"lib/mod_warrenty.php?type=warrDetails",
            data:{warrid:warrid},
            dataType:"text",
            success:function(result){
           
                $("#warr_data").html(result);

                $("#viewDetails").modal();
            },
            error:function(eobj,err,etxt){
                console.log(etxt);
            }
        });
        
      }else if(type=="update"){
        $("#uwarr_id").val(warrid);
        $("#updateWarr").modal();

      }else if (type=="cancel"){
        swal({
            title: "Are You Sure ?",
            text: "You are trying to cancel The warrety Request",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                var url = "lib/mod_warrenty.php?type=cancelWarrenty";
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {warrid: warrid}, 
                    dataType: "text",
                    success: function (result) {
                        res = result.split(",");
                        msg = res[0].trim();
                        if (msg  == "0") {
                             swal("Error", res[1], "error");
                        }
                        else if (msg  == "1") {
                            swal("Success", res[1], "success");
                            funViewWarrenty();
                        }
                    }
                });
            }
        });           
      }
      
    });
    $("#btn_submit").click(function(){
        var data = $("#updateForm").serialize();
        var url = "lib/mod_warrenty.php?type=UpdateWarrenty";

        $.ajax({
            method:"POST",
            url:url,
            data:data,
            dataType:"text",
            success:function(result){
                res = result.split(",");
                msg = res[0].trim();
                    if (msg  == "0") {
                        swal("Error", res[1], "error");
                    }
                    else if (msg  == "1") {
                        swal("Success", res[1], "success");
                       funViewWarrenty();
                    }

            },
            error:function(eobj,err,etxt){
                console.log(etxt);
            }

        });
    });


  });
    </script>