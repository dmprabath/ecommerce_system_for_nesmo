<?php
require ("../lib/mod_supplier.php");
 $supid = getSupId();

?>
<div class="breadcrumb  bg-gray-200 ">
    <li><a href="home.php" class="text-dark text-uppercase"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
    <li><a  class="text-primary text-uppercase" > Suppliers</a> </li>


</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">


    <h1 class="h3 mb-0 text-gray-800 text-uppercase">View Supplier</h1>
    <a href="#" class="btn btn-primary mb-0 shadow-sm "  data-toggle="modal" data-target="#addSup"> <i class="fas fa-adduser fa-sm text-white-50"></i>Add Supplier</a>



</div>

<!-- Content Row -->
<div >
    <table id="tblviewsupplier" class="table table-striped animated fadeInUp fast"  >
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact No</th>
            <th>Email</th>
            <th>Address</th>
            <th></th>


        </tr>
        </thead>
        <tbody style="font-size: 13px">

        </tbody>

    </table>
    <div></div>
</div>
<div class="modal  fade" id="addSup" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form id="addForm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Add New Supplier</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Supplier ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="sup_id" name="sup_id" readonly="readonly" value="<?php echo($supid);  ?>" >

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Supplier Name *</label>
                        <input type="text" class="col-lg-7 form-control " name="sup_name" id="sup_name"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Supplier Contact *</label>
                        <input type="text" class="col-lg-7 form-control " name="sup_mobile" id="sup_mobile"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Supplier Email *</label>
                        <input type="text" class="col-lg-7 form-control " name="sup_email" id="sup_email"  >
                    </div>
                    <div class="form-group row">
                        <label for="sup_address" class="col-lg-4 col-form-label">Supplier Address *</label>
                        <textarea class="col-lg-7 form-control "  name="sup_address" id="sup_address" cols="10" rows="5"></textarea>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"   id="modal_btn_add"> ADD</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>

                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal  fade" id="viewSup" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form id="viewForm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>View Supplier</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Supplier ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="vsup_id" name="vsup_id" readonly="readonly" value="" >

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Supplier Name</label>
                        <input type="text" class="col-lg-7 form-control form-control-plaintext" name="vsup_name" id="vsup_name"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Supplier Contact</label>
                        <input type="text" class="col-lg-7 form-control form-control-plaintext " name="vsup_mobile" id="vsup_mobile"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Supplier Email</label>
                        <input type="text" class="col-lg-7 form-control form-control-plaintext" name="vsup_email" id="vsup_email"  >
                    </div>
                    <div class="form-group row">
                        <label for="sup_address" class="col-lg-4 col-form-label">Supplier Address</label>
                        <textarea class="col-lg-7 form-control form-control-plaintext "  name="vsup_address" id="vsup_address" cols="10" rows="5"></textarea>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"   id="modal_btn_Edit" > EDIT</button>
                    <button type="button" class="btn btn-success d-none"   id="modal_btn_Update" > Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>

                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {

        var dataTable = $("#tblviewsupplier").DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "url": "lib/mod_supplier.php?type=viewSupplier",
                "type": "POST"
            },
            "columns": [
                {"data": "0"},
                {"data": "1"},
                {"data": "2"},
                {"data": "3"},
                {"data": "4"},
                {"data": "5"}

            ],
            "columnDefs": [
                {
                    "data": null,
                    "defaultContent": "<button id='view' title='view' class='btn-sm btn-primary' ><i class='fas fa-user-edit'></i>View</button>  ",
                    "targets": 5
                }
            ]

        });
        $("#tblviewsupplier tbody").on('click','button',function() {
            var type = $(this).attr('title');
            var data = dataTable.row($(this).parents('tr')).data();
            var supid = data[0];
            var supname = data[1];
            var supmobile = data[2];
            var supemail = data[3];
            var supaddress = data[4];


            /* ------------  View Button -------------- */
            if(type=="view"){
               $("#vsup_id").val(supid);
               $("#vsup_name").val(supname);
               $("#vsup_mobile").val(supmobile);
               $("#vsup_email").val(supemail);
               $("#vsup_address").val(supaddress);

               $("#viewSup").modal();
               /* ------------  Chan -------------- */
            }

        });

        $("#modal_btn_Edit").click(function () {
            $(".form-control-plaintext").removeClass('form-control-plaintext');
            $("#modal_btn_Update").removeClass('d-none');
            $("#modal_btn_Edit").addClass('d-none');
        });

        $("#modal_btn_add").click(function () {
            var sup_name = $("#sup_name").val();
            var sup_mobile = $("#sup_mobile").val();
            var sup_email = $("#sup_email").val();
            var sup_address = $("#sup_address").val();


            $email_pat = /[^@]{1,100}@[^@]{4,253}$/;
            $connum = /([1-10])$/;
            if(sup_name==""|| sup_mobile =="" ||sup_email =="" || sup_address==""){
                swal("Error","All Fields must be field","error");
                return;
            }
            if (!sup_mobile.match($connum)) {
                swal("Error","Contact Number is incorrect","error");
                return;
            }
            if (!sup_email.match($email_pat)) {
                swal("Error","Email pattern is incorrect","error");
                return;
            }
                      


            $("#addSup").modal('hide');
            var fdata = $('#addForm').serialize();
            var url = "lib/mod_supplier.php?type=addNewSupplier";

            $.ajax({
                method:"POST",
                url:url,
                data:fdata, 
                dataType:'text',
                success:function (result) {
                    res = result.split(",");
                    if (res[0] == "0") {
                        swal("Error", res[1], "error");
                    }
                    else if (res[0] == "1") {
                        swal("Success", res[1], "success");
                        $("#view_sup").click();
                    }
                } ,
                error:function (eobj, err, etxt) {
                    console.log(etxt);
                }
            });
        });


        $("#modal_btn_Update").click(function () {
            $("#viewSup").modal('hide');
            var fdata = $('#viewForm').serialize();
            var url = "lib/mod_supplier.php?type=updateSupplier";

            $.ajax({
               method:"POST",
               url:url,
               data:fdata,
               dataType:'text',
               success:function (result) {

                   res = result.split(",");
                   if (res[0] == "0") {
                       swal("Error", res[1], "error");
                   }
                   else if (res[0] == "1") {

                       swal("Success", res[1], "success");

                       $("#view_sup").click();
                   }
               } ,
                error:function (eobj, err, etxt) {
                    console.log(etxt);
                }
            });
        });

    });

    </script>