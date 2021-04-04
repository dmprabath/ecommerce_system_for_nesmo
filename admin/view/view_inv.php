<?php
session_start();
require ("../lib/mod_inv.php");

?>


<div class="breadcrumb  bg-gray-200 text-uppercase">
    <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary" > Invoice Management</a> </li>


</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">


    <h1 class="h3 mb-0 text-gray-800">View Invoice</h1>
    <a href="#" class="btn btn-primary mb-0 shadow-sm " onclick="funAddInv();"> <i class="fas fa-adduser fa-sm text-white-50"></i>New Invoice</a>



</div>

<!-- Content Row -->
<div >
    <table id="tblviewinv" class="table table-striped animated fadeInUp fast"  >
        <thead>
        <tr >
            <th>Id</th>
            <th>Customer name</th>
            <th>Date</th>
            <th>Quantity</th>            
            <th>Net Total</th>
            <th>Paid</th>
            <th>type</th>
            <th ></th>

        </tr>
        </thead>
        <tbody style="">

        </tbody>

    </table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>

<!---------------------------add more payments ---------------------->

<div class="modal  fade" id="newPayment" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form id="newpayForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Add payments</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Inv ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="inv_id" name="inv_id" readonly="readonly" value="">

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Customer Name</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="cus_fname" name="cus_fname" readonly="readonly" value="">

                    </div>               
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Net total</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="net_total" name="net_total" readonly="readonly" value="">
                    </div>                
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Remaining amount</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="rem_amount" name="rem_amount" readonly="readonly" value="">
                    </div>   

                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Date</label>
                        <input type="text" class="col-lg-5 form-control" id="cdate" name="cdate"  value="">

                    </div>            
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Pay amount</label>
                        <input type="text" class="col-lg-5 form-control " id="pay_amount" name="pay_amount"  value="">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success"   id="btn_confirm" > Confirm</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- -------------------------------# Add Product Images modal End --------------------- ---->


<script>
$(document).ready(function(){

    $("#cdate").datepicker({
        changeMonth:true,
        changeYear:true,
        maxDate:"0",
        dateFormat:"yy-mm-dd"
    });
    var dataTable = $("#tblviewinv").DataTable({
        "processing": true,
        "serverSide" : true,
        "ajax":{
            "url":"lib/mod_inv.php?type=viewInvoice",
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
        "order": [[0,"desc"]],
        "columnDefs":[
            {
                "data":null,
                "defaultContent":"<button class='btn btn-primary btn-sm  ' id='inv_detail' >Details</button> <button class='btn btn-success btn-sm  ' id='add_pay' >Add Payments</button>"+
                " <button class='btn btn-primary btn-sm' id='btn_grn_print'><i class='fas fa-print'></i>Print</button>",
                "targets":7
            }

        ]
    });

    $("#tblviewinv tbody").on('click','button',function () {
       var type = $(this).attr('id');
       var data = dataTable.row($(this).parents('tr')).data();
       var inv_id = data[0];
       var cus = data[1];
       var date = data[2];
       var total = data[4];
       var paid = data[5];
       

       if(type == "inv_detail"){
           url ="view/view_inv_details.php?inv_id="+inv_id+"&cus="+cus+"&date="+date;
           $("#rpanel").load(url);
       }else if( type=="add_pay"){
                $("#inv_id").val(inv_id);
                $("#cus_fname").val(cus);
                $("#net_total").val(total);
                var rem = parseFloat(parseFloat(total)-parseFloat(paid)).toFixed(2);
                $("#rem_amount").val(rem)
            $("#newPayment").modal('show');
       }else if(type == "btn_grn_print"){
            
            window.open('view/report/print_invoicePDF.php?invid='+inv_id,'_blank');
       }
    });

    $("#btn_confirm").click(function(){
        var data = $("#newpayForm").serialize();
        var url  ="lib/mod_inv.php?type=addPayments";

        $.ajax({
            method:"POST",
            url:url,
            data:data,
            dataType:'text',
            success:function(result){
                res = result.split(",");
                msg = res[0].trim();
                if(msg =="0"){
                    swal("error",res[1],"error")
                }else{
                    swal("success",res[1],"success")
                }
            },
            error:function(eobj,err,etxt){
                console.log(etxt);
            }
        });
    });
});




</script>