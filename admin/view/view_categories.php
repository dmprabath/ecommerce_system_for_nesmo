<?php
session_start();
$emp_id = $_SESSION["user"]["uid"];

    require ("../lib/mod_categories.php");
    $catid =getCatId();
?>
<style type="text/css">
    .modal-size{
        width: 700px;
    }
    .breadcrumb {


    }
</style>


    <div class="breadcrumb  bg-gray-200 text-uppercase">
        <li><a href="home.php" class="text-dark"> Home </a> <i class="mx-2 fas fa-angle-right text-dark" aria-hidden="true" ></i></li>
        <li><a  class="text-primary"> Category Management</a>

    </div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
    
    <h1 class="h3 mb-0 text-gray-800">View User</h1>
    <a href="#" class="btn btn-primary mb-0 shadow-sm " data-toggle="modal" data-target="#addCat"> Add New Category</a>


</div>
<div class="modal  fade" id="addCat" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Add New Categories</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Category ID</label>
                        <input type="text" class="col-lg-5 form-control form-control-plaintext" id="cat_id" name="cat_id" readonly="readonly" value="<?php echo($catid) ?>">

                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Category Name</label>
                        <input type="text" class="col-lg-7 form-control " name="cat_name" id="cat_name"  >

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"   id="modal_btn_add" data-dismiss="modal"> ADD</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>

                </div>
            </div>
        </form>
    </div>
</div>

<!-- Content Row -->
<div >
		<table id="tblviewcat" class="table table-striped " >
  			<thead>
    		<tr>
      			<th>ID</th>
      			<th>Name</th>


    		</tr>
  			</thead>
  			<tfoot>
    		<tr>
                <th>ID</th>
                <th>Name</th>

    		</tr>
  			</tfoot>
		</table>
    <div><input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none"></div>
</div>


<script>
    $(document).ready(function(){

        var dataTable = $("#tblviewcat").DataTable({
          "processing": true,
          "serverSide": true,

          "ajax":{
            "url":"lib/mod_categories.php?type=viewCategories",
            "type":"POST"
          },
            "columns":[
            {"data":"0"},
            {"data":"1"},

          ]

        });

    $("#tblviewemp tbody").on('click','button',function() {


    });
    $("#modal_btn_add").click(function () {
        var data = $('form').serialize();
        var url = "lib/mod_categories.php?type=AddNewCategories";

        $.ajax({
            method:"POST",
            url:url,
            data:data,
            dataType:"text",
            success:function (result) {
                res = result.split(",");
                if (res[0] == "0") {
                    swal("Error", res[1], "error");

                } else if (res[0] == "1") {
                    swal("Success", res[1], "success");


                    $("#view_cat").click();
                }
            },
            error:function (eobj, err, etxt) {
                console.log(etxt);
            }
        });
    });
  });

</script>

